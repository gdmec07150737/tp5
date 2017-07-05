<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
	protected $autoWriteTimestamp = true;
	public function add($data){
		$data['status'] = 1;
		//$data['create_time']=time();
		return $this->save($data);
	}
	//一级分类
	public function getNormalFirstCategory(){
		$data = [
			'status' => 1,
			'parent_id' => 0,
		];
		$order = [
			'id' => 'desc',
		];
		return $this->where($data)->order($order)->select();
	}
	//二级分类
	public function getFisrtCategory($parentId){
		$data=[
			'parent_id'=>$parentId,
			'status'=>['neq',-1],
		];
		$order=[
			'listorder'=>'desc',
			'id'=>'desc',
		];
		$result=$this->where($data)->order($order)->paginate();
		//echo $this->getLastSql();
		return $result;
		/*var_dump($result);
		exit();*/
	}
	public function getNormalCategoryByParentId($parent_id=0){
    	$data=[
    		'status'=>1,
    		'parent_id'=>$parent_id,
    	];
    	$order=[
    		'id'=>'desc',
    	];
    	return $this->where($data)->order($order)->select();
    }
    public function getNormalRecommendCategoryByParentId($id=0,$limit=5){
    	$data=[
    		'parent_id'=>$id,
    		'status'=>1,
    	];
    	$order=[
    		'listorder'=>'desc',
    		'id'=>'desc',
    	];
    	$result=$this->where($data)->order($order);
    	if($limit){
    		$result=$result->limit($limit);
    	}
    	return $result->select();
    }
    public function getNormalCategoryIdParentId($ids){
    	$data=[
    		'parent_id'=>['in',implode(',', $ids)],
    		'status'=>1,
    	];
    	$order=[
    		'listorder'=>'desc',
    		'id'=>'desc',
    	];
    	$result=$this->where($data)->order($order)->select();
    	return $result;
    }
}