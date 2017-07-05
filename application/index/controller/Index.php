<?php
namespace app\index\controller;
use think\Controller;
class Index extends Base
{
    public function index ()
    {
    	//获取首页大图  相关数据
    	//获取广告相关的数据
    	//商品分类 数据-美食 推荐的数据
    	$datas=model('Deal')->getNormalDealByCategoryCityId(1,$this->city->id);
    	//获取4个字分类
    	$meishicates = model('Category')->getNormalRecommendCategoryByParentId(1,4);
        return $this->fetch('',[
        	'datas'=>$datas,
        	'meishicates'=>$meishicates,
            //'controller'=>'ms',
        ]);
    }
}
