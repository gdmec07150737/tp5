<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;

class Image extends Controller{
	public function upload(){
		$file=Request::instance()->file('file');
		//给定一个目录
		$path = ROOT_PATH . 'public/uploads/';
		$info=$file->move($path);
		//print_r($info);
		if($info && $info->getPathname()){
			return show(1, 'success','/'.$info->getPathname());
		}
		return show(0,'upload error');
	}
}