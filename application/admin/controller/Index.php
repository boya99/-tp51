<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\facade\Log;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function t1(){
        $data = [
            'name'=>'sah',
            'age'=>'23',
            'like'=>[
                1,2,3
            ],
        ];
        $url = 'http://tp51.cn/admin/Index/test';
        $body = json_encode($data);
        $res = http_request($url,$body,$method='POST');
        dump($res);
    }
    public function test(){
//        $data = input('post.');
//        Log::write('测试日志信息，这是警告级别，并且实时写入','notice');
//        $this->result($data,200,'success','json');
//       echo  Env::get('database_username');
//       echo "<br/>";
//
//       echo "<br/>";
//       echo  config('app.default_return_type');
//       echo "<hr/>";
//       echo  config('common.app');
//       var_dump(\config('map.ak'));
//       dump(\config());

//       echo "<hr/>";
//       \Map::getLngLat('北京市海淀区上地十街10号');
//       echo "<hr/>";
       return \Map::staticimage('北京市昌平区沙河地铁站');

//        echo '234';
//        $this->disply();
    }
    public function welcome(){
        return '欢迎来到后台首页';
    }
}
