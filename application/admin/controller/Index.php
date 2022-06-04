<?php
namespace app\admin\controller;

use mail\Mail;
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
    public function sendMail(){
        //不带附件

        $mail = new Mail();
//        $res = $mail->sendEMail(['3*****7@qq.com'], '测试邮件主题'. time(), '<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s'),'如果邮件客户端不支持HTML则显示此内容');
//        var_dump($res);

        //带附件
        $Attachment = [
            //直接添加附件
            Env::get("root_path") . "test.jpg",
            //添加附件并重命名
            'change_name.png' => Env::get("root_path") . "test.jpg"
        ];
//        dump($Attachment);exit;
        $res = $mail->sendEMail(
            ['34****7@qq.com'],
            '测试邮件主题'. time(),
            '<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s'),
            '如果邮件客户端不支持HTML则显示此内容',
            $Attachment);
        var_dump($res);


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

       echo "<hr/>";
      $res =   \Map::getLngLat('北京市海淀区上地十街10号');
      var_dump($res);
       echo "<hr/>";
//       return \Map::staticimage('北京市昌平区沙河地铁站');

//        echo '234';
//        $this->disply();
    }
    //自己用百度上传插件上传，成功上传
    public function upload(){
        return $this->fetch();
    }
    //用uploadify插件上传，成功上传
    public function up(){
        return $this->fetch();
    }
    public function welcome(){
        return '欢迎来到后台首页';
    }
}
