<?php

namespace app\common\validate;

use think\Validate;

class  Bis extends Validate
{
//    验证规则
    protected $rule = [
        'name' => 'require|max:25',
        'email' => 'email',
        'logo' => 'require',
        'city_id' => 'require',
        'bank_info' => 'require',
        'bank_name' => 'require',
        'bank_user' => 'require',
        'faren' => 'require',
        'faren_tel' => 'require',
    ];
//    规则提示
    protected $message = [
        'name.require' => '名称必须填写',
        'name.max' => '名称最多不能超过25个字符',
        'logo.require' => 'logo必须存在',
        'city_id.require' => '城市必须存在',
        'bank_info.require' => '银行信息必须存在',
        'bank_name.require' => '银行名称必须存在',
        'bank_user.require' => '开户人必须存在',
        'faren.require' => '门店必须存在',
        'faren_tel.require' => '门店电话必须存在',
    ];
//    验证场景设置
    protected $scene = [
        'add' => ['name', 'email', 'logo','city_id','bank_info','bank_name','bank_user','faren','faren_tel'],//添加


    ];
}