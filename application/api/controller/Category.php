<?php
namespace app\api\controller;
use think\Controller;

class Category extends Controller
{
    private $obj;
    public function __construct()
    {
        $this->obj=new \app\common\model\Category();
    }

    public function getCategoryByParentId(){
        $id = input('post.id');
        if(!$id){
            $this->error('ID不合法');
        }
        //通过id 获取二级城市
        $categorys = $this->obj->getCategoryByParentId($id);
        if(!$categorys){
            return show(0,'error');
        }
        return show(1,'success',$categorys);
    }

}
