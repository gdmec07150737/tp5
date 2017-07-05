<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
	public $city='';
	public $account='';
    public function _initialize(){
    	//城市的数据
    	$citys=model('City')->getNormalCity();
    	//用户的数据
    	$this->getCity($citys);
    	//获取首页分类的数据
    	$cats=$this->getRecommendCats();
    	$this->assign('citys',$citys);
    	$this->assign('city',$this->city);
        $this->assign('cats',$cats);
    	$this->assign('deal',['id'=>1]);
        $this->assign('controller',strtolower(request()->controller()));
    	$this->assign('user',$this->getLoginUser());
    }
    public function getCity($citys){
    	foreach ($citys as $city) {
    		$city=$city->toArray();
    		if($city['is_default']==1){
    			$defaultuname=$city['uname'];
    			break;
    		}
    	}
		$defaultuname=$defaultuname ? $defaultuname : 'guangzhou';
		if(session('cityuname',$defaultuname)&&!input('get.city')){
			$cityuname=session('cityuname','');
		}else{
			$cityuname=input('get.city',$defaultuname,'trim');
			session('cityuname',$cityuname);
		}
		$this->city=model('City')->where(['uname'=>$cityuname])->find();    		   	
    }
    public function getLoginUser(){
    	if (!$this->account) {
    		$this->account=session('o2o_user','');
    	}
    	return $this->account;
    }
    /*获取首页推荐当中的商品分类数据*/
    public function getRecommendCats(){
    	$parentIds=$sencatArr=$recomCats=[];
    	$cats=model('Category')->getNormalRecommendCategoryByParentId(0,5);
    	//print_r($cats);
    	foreach ($cats as $cat) {
    		$parentIds[]=$cat->id;
    	}
    	//获取二级分类呃数据
    	$sedCats=model('Category')->getNormalCategoryIdParentId($parentIds);
    	foreach ($sedCats as $sedcat) {
    		$sedcatArr[$sedcat->parent_id][]=[
    			'id'=>$sedcat->id,
    			'name'=>$sedcat->name,
    		];
    	}
    	foreach ($cats as $cat) {
    		//recomCats代表是一级和二级的数据，[]第一个参数是 一级分类的name，第二个参数是这一级分类下面的所有二级分类数据
    		$recomCats[$cat->id]=[$cat->name,empty($sedcatArr[$cat->id])?[]:$sedcatArr[$cat->id]];
    	}
    	return $recomCats;
    }
}
