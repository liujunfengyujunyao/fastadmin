<?php
namespace app\jf\controller;
use think\Db;
use think\Controller;
use app\jf\model\User;
class Index extends Controller
{
    public function index()
    {
        $list = model('User')->paginate(2);

//       halt($list);
        $this->assign('list',$list);
        return $this->fetch();
    }
}
