<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
//    自动写入创建和更新的时间戳字段（默认关闭) 自动写入create_time和update_time两个字段的值，默认为整型（int）
    protected $autoWriteTimestamp = true;


    public function add($data)
    {
        $data['status'] = 1;
//        $data['create_time'] = time();
        return $this->save($data);

    }

    public function getNormalFirstCategory(){
        $data = [
            'status'=>1,
            'parent_id'=>0,

        ];
        $order = [
            'id'=>'desc'
        ];
        return $this->where($data)
                    ->order($order)
                    ->select();
    }

    public function getFirstCategorys($parentId = 0 ){
        $data = [
            ['parent_id','=',$parentId],
            ['status','<>',-1],
        ];
        $order = [
            'listorder'=>'desc',
            'id'=>'desc',
        ];
        $result =  $this->where($data)->order($order)->paginate();
        return $result;
    }
    public function getCategoryByParentId($parendId = 0){
        $data = [
            'status'=>1,
            'parent_id'=>$parendId,
        ];
        $order = [
            'id'=>'desc'
        ];
        return $this->where($data)->order($order)->select();

    }
    public function getNormalCategoryByParentId($parentId=0) {
        $data = [
            ['status','=', 1],
            ['parent_id' ,'=', $parentId],
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }



    public function getNormalRecommendCategoryByParentId($id=0, $limit=5) {
        $data = [
            'parent_id' => $id,
            'status' => 1,
        ];

        $order = [
            'listorder' => 'asc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order);
        if($limit) {
            $result = $result->limit($limit);
        }

        return $result->select();

    }

    public function getNormalCategoryIdParentId($ids) {
        $data = [
            ['status' ,'=', 1],
            ['parent_id' ,'in',  implode(',', $ids)],
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order)
            ->select();

        return $result;
    }
}