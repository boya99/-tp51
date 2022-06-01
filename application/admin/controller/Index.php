<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function test(){
        echo '234';
//        $this->disply();
    }
    public function welcome(){
        return '欢迎来到后台首页';
    }
}
