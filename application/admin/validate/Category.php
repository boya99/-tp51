<?php
namespace app\admin\validate;
use think\Validate;

class  Category extends Validate{
//    验证规则
    protected $rule = [
        'name'  =>  'require|max:25',
        'parent_id' =>  'number',
        'id' =>  'number',
        'status' =>  'number|in:-1,0,1',
        'listOrder' =>  'number',
    ];
//    规则提示
    protected $message  =   [
        'name.require' => '名称必须填写',
        'name.max'     => '名称最多不能超过25个字符',
        'parent_id.number'   => '年龄必须是数字',
        'id.number'  => '年龄只能在1-120之间',
        'status.number'        => '邮箱格式错误',
        'status.in'        => '范围不合法',
    ];
//    验证场景设置
    protected $scene = [
        'add'  =>  ['name','parent_id','id'],//添加
        'listorder'  =>  ['id','listOrder'],//排序
        'status'  =>  ['id','status'],

    ];
}