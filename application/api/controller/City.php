<?php
namespace app\api\controller;
use think\App;
use think\Controller;

class City extends Controller
{
    private $obj;
    public function __construct()
    {
        $this->obj=new \app\common\model\City();
    }

    public function getCitysByParentId(){
        $id = input('post.id');
        if(!$id){
            $this->error('ID不合法');
        }
        //通过id 获取二级城市
        $citys = $this->obj->getNormalCitysByParentId($id);
        if(!$citys){
            return show(0,'error');
        }
        return show(1,'success',$citys);
    }

}
