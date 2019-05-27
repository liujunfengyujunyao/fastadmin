<?php

namespace app\admin\controller\check;

use app\common\controller\Backend;
use think\Db;
/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Wait extends Backend
{
    
    /**
     * Wait模型对象
     * @var \app\admin\model\check\Wait
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\check\Wait;
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
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        $status['status'] = ['eq',0];
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }

            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->where($status)
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->where($status)
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                $row->visible(['id','uid','name','mobile','email','id_card','type','add_time']);
                
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function detail()
    {
        $check_id = request()->param('ids');//check_info的主键
        $check_info = DB::name('check_info')->where(['id'=>$check_id])->value('info');
        $type = DB::name('check_info')->where(['id'=>$check_id])->value('type');
        $info = json_decode($check_info,true);
//        halt($check_info);
        if ($this->request->isAjax()) {

            $params = request()->param();


            if ($params) {
                if($params['cost'] > 0.06){
                    $this->error(__('费率过大'));
                }

                $status = $params['status'];

                $params = $this->preExcludeFields($params);//过滤

                $check = $this->model->where(['id'=>$params['check_id']])->find();

                $result = $this->model->where(['id'=>$check['id']])->update(['status'=>$status,'update_time'=>time(),'cost'=>$params['cost']]);

                if(!empty($params['del'])){//驳回
                    $sql = DB::name('admin')->where(['id'=>$check['uid']])->update(['check_status'=>5]);
                }elseif(!empty($params['update'])){//修正
                    $sql = DB::name('admin')->where(['id'=>$check['uid']])->update(['check_status'=>3]);
                }else{
                    $sql = DB::name('admin')->where(['id'=>$check['uid']])->update(['check_status'=>2]);
                    
                    //调用接口发送info
                }

                if ($result !== false && $sql !== false) {
                    $this->success('操作完成','admin/check/wait');
                } else {
                    $this->error(__('网络错误'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign('type',$type);
        $this->view->assign('row',$info);
        return $this->view->fetch();
    }
}
