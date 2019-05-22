<?php

namespace app\admin\controller\pay;

use app\common\controller\Backend;
use think\Db;
/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Order extends Backend
{
    
    /**
     * Order模型对象
     * @var \app\admin\model\Order
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Order;
        $this->view->assign("typeList", $this->model->getTypeList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        $user_id = $_SESSION['think']['admin']['id'];
        $group_id = DB::name('auth_group_access')->where(['uid'=>$user_id])->value('group_id');
        $rule=$group_id==1?"1=1":['user_id'=>$user_id];
        $ws_user = DB::name('wk_user')->where(['id'=>$user_id])->value('id');
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->with(['wkuser'])
                    ->where($where)
                    ->where($rule)
                    ->order($sort, $order)
                    ->count();
            $list = $this->model
//                    ->hasWhere('wkuser',$build_where)
                    ->with(['wkuser'])
                    ->where($where)
                    ->where($rule)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();
            foreach ($list as $row) {
                
                $row->getRelation('wkuser')->visible(['id','type','user_name']);
            }
            $list = collection($list)->toArray();//$list是个对象  转化为数组
            foreach($list as $key => &$value){
                $value['last_time'] = $value['update_time']+7200;
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

        return $this->view->fetch();
    }

    public function refund()
    {
        $order_id = request()->param('ids');
        if ($this->request->isPost()) {

            $params = request()->param();


            if ($params) {

                $params = $this->preExcludeFields($params);//过滤
//                $result = false;
                Db::startTrans();
//                $api = ;//调用接口
                $order = $this->model->where(['id'=>$params['ids']])->find();
                if($order['order_amount']<$params['refund_amount'] || $order['order_status'] !== 2){
                    $this->error("退款金额过大");
                }
                $result = $this->model->where(['id'=>$params['ids']])->update(['order_status'=>3,'update_time'=>time()]);
                if ($result !== false) {
                    $this->success('退款成功','admin/pay/order');
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign('order_id',$order_id);
        return $this->view->fetch();
    }

    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();//开始事物
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    Db::commit();//提交事物
                } catch (ValidateException $e) {
                    Db::rollback();//回滚事物
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    public function test()
    {

    }
}
