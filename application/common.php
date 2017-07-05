<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
 function status($status){
	if($status==1){
		$str="<span class='label label-success radius'>正常</span>";
	}else if($status==0){
		$str="<span class='label label-danger radius'>待审</span>";
	}else{
		$str="<span class='label label-danger radius'>删除</span>";
	}
	return $str;
}
function doCurl($url,$type=0,$data=[]){
	$ch=curl_init(); //初始化
	//设置选项
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	if($type==1){
		//post
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	}
	//执行并获取内容
	$output=curl_exec($ch);
	//释放curl句柄
	curl_close($ch);
	return $output;
}
function countLocation(){
	if (!$ids) {
		return 1;
	}
	if(preg_match('/,/', $ids)){
		$arr=explode(',', $ids);
		return count($arr);
	}
}
//设置订单号
function setOrderSn(){
	//dump(microtime());exit;
	list($t1,$t2)=explode(' ', microtime());
	//echo $t1."<br/>";
	//echo $t2."<br/>";exit;
	$t3=explode('.', $t1*10000);
	return $t2.$t3[0].(rand(10000,99999));
}