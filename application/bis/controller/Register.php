<?php
namespace app\bis\controller;
use think\Controller;
class Register extends Controller
{
	public function index(){
		//获取一级城市的数据
		$city=Model('city')->getNormalFirstCity();
		//获取一级栏目的数据
		$categorys=Model('category')->getNormalCategoryByParentId();
		return $this->fetch('',[
				'city'=>$city,
				'categorys'=>$categorys,
			]);
	}
}