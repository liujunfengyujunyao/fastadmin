<?php

namespace app\admin\controller\general;

use app\admin\model\Admin;
use app\common\controller\Backend;
use fast\Random;
use think\Session;
use think\Db;

/**
 * 个人配置
 *
 * @icon fa fa-user
 */
class Profile extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        $admin_id = Session::get('admin.id');
        $phone = DB::name('admin')->where("id",$admin_id)->value('phone');
        $group_id = DB::name('auth_group_access')->where('uid',$admin_id)->value('group_id');

        if ($this->request->isAjax())
        {

            $model = model('AdminLog');
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $total = $model
                    ->where($where)
                    ->where('admin_id', $this->auth->id)
                    ->order($sort, $order)
                    ->count();

            $list = $model
                    ->where($where)
                    ->where('admin_id', $this->auth->id)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

        $this->view->assign('phone',$phone);
        $this->view->assign('group_id',$group_id);
        return $this->view->fetch();
    }

    /**
     * 更新个人信息
     */
    public function update()
    {
        if ($this->request->isPost())
        {
            $admin = Admin::get($this->auth->id);//获取当前管理员数据(对象)
            $params = $this->request->post("row/a");
            $params = array_filter(array_intersect_key($params, array_flip(array('email', 'nickname', 'password', 'avatar'))));//找出改动过的数据
            unset($v);

            if (isset($params['password']))
            {
                if($params['password'] !== $params['check_password']){
                    $this->error('两次输入密码不一致');
                }
                if( md5(md5($params['old_password']) . $admin['salt']) !== $admin['password']){
                    $this->error('密码错误');
                }
                $params['salt'] = Random::alnum();//加盐
                $params['password'] = md5(md5($params['password']) . $params['salt']);

            }
            if ($params)
            {
//                $admin = Admin::get($this->auth->id);//获取当前管理员数据(对象)
                $admin->save($params);
                //因为个人资料面板读取的Session显示，修改自己资料后同时更新Session
                Session::set("admin", $admin->toArray());
                $this->success();
            }
            $this->error();
        }
        return;
    }

}
