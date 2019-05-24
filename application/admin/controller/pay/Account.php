<?php

namespace app\admin\controller\pay;

use app\common\controller\Backend;
use app\admin\model\Admin;
use think\Db;
/**
 * 
 *
 * @icon fa fa-circle-o
 */
//用户端查账
class Account extends Backend
{
    
    /**
     * Account模型对象
     * @var \app\admin\model\pay\Account
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\pay\Account;
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
        //当前是否为关联查询
        $this->relationSearch = false;
        $admin = Admin::get($this->auth->id);
        $wk_id = $admin['wk_id'];
        $rule['user_id'] = ['eq',$wk_id];
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
                    ->where($rule)
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->where($rule)
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                $row->visible(['id','order_id','order_status','unique_order_id','type','order_amount','update_time']);
                
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
    //退款
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
                    $this->success('退款成功','admin/pay/account');
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign('order_id',$order_id);
        return $this->view->fetch();
    }

    //收款页面
    public function pos()
    {
        if ($this->request->isAjax())
        {

        }

        return $this->view->fetch();
    }
}
