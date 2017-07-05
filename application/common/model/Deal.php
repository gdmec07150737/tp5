<?php
namespace app\common\model; 
use think\Model; 

class Deal extends BaseModel {
	public function getNormalDeals($data=[]){
		$data['status']=1;
		$order=['id'=>'desc'];
		$result = $this->where($data)->order($order)->paginate();
		return $result;
	}
	//根据分类以及城市来获取商品数据
	public function getNormalDealByCategoryCityId($id,$cityId,$limit=10){
		$data=[
			'end_time'=>['gt',time()],
			'category_id'=>$id,
			'city_id'=>$cityId,
			'status'=>1,
		];
		$order=[
			'listorder'=>'desc',
			'id'=>'desc',
		];
		$result = $this->where($data)->order($order);
		if($limit){
			$result=$result->limit($limit);
		}
		return $result->select();
	}

}