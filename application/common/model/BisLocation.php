<?php
namespace app\common\model;

use think\Model;

class BisLocation extends BaseModel
{
    protected $autoWriteTimestamp = true;
    public function getNormalLocationByBisId($bisId) {
        $data = [
            'bis_id' => $bisId,
            'status' => 1,
        ];

        $result = $this->where($data)
            ->order('id', 'desc')
            ->select();
        return $result;
    }

    public function getNormalLocationsInId($ids) {
        $data = [
            ['status','=', 1],
            ['id','in', $ids],
        ];
        return $this->where($data)
            ->select();
    }

}