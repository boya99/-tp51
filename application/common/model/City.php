<?php

namespace app\common\model;

use think\Model;

class City extends Model
{
    //
    public function getNormalCitysByParentId($parendId = 0){
        $data = [
            'status'=>1,
            'parent_id'=>$parendId,
        ];
        $order = [
            'id'=>'desc'
        ];
        return $this->where($data)->order($order)->select();

    }



    public function getNormalCitys() {
        $data = [
            ['status','=', 1],
            ['parent_id' ,'>', 0],
        ];

        $order = ['id'=>'desc'];

        return $this->where($data)
            ->order($order)
            ->select();

    }
}
