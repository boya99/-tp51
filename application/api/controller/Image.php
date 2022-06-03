<?php
namespace app\api\controller;

use think\Controller;

class Image extends Controller
{
    public function upload()
    {
        // 获取表单上传文件
        $file = request()->file('file');
 ;
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( './uploads');


        if($info && $info->getFilename()){
           $getSaveName =  str_replace("\\","/",$info->getSaveName());
            $fileUrl = '/uploads/'.$getSaveName;
            // 成功上传后 获取上传信息
          return show(1,'success',$fileUrl);
//            $data = [
//                'status'=>1,
//                'message'=>'success',
//                'data'=>$fileUrl,
//            ];
//
//          return json($data);
        }else{
            // 上传失败获取错误信息
//            echo $file->getError();
            return show(0,'error',$file->getError());
        }
    }

}