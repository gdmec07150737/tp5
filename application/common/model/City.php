<?php

namespace app\common\model;

use think\Model;

class City extends Model
{
	/*城市列表*/
    public function getNormalFirstCity($parent_id=0){
    	$data=[
    		'status'=>1,
    		'parent_id'=>$parent_id,
    	];
    	$order=[
    		'id'=>'desc',
    	];
    	return $this->where($data)->order($order)->select();
    }
    public function getNormalCity($parent_id=0){
        $data1=[
            'status'=>1,
            'parent_id'=>$parent_id,
        ];
        $ress=$this->where($data1)->select();
        foreach ($ress as $res) {
            $res=$res->toArray();
            //print_r($res);
        }
        //exit;
        $parent_id=$res['id'];
        $data=[
            'status'=>1,
            'parent_id'=>$parent_id,
        ];
        $order=[
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->select();
    }
}
