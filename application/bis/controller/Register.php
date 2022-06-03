<?php
namespace app\bis\controller;

use think\Controller;

class Register extends  Controller
{
    public function index()
    {
        //获取一级城市数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级分类
        $categorys = model('Category')->getCategoryByParentId();

        $this->assign('citys',$citys);
        $this->assign('categorys',$categorys);
        return $this->fetch();
    }

}