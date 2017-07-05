<?php

namespace app\common\model;

use think\Model;

class User extends BaseModel
{
	//注册用户信息
	 public function add($data=[]){
        if(!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status']=1;
            return $this->data($data)->allowField(true)->save();
     }
     //根据用户名获取用户信息
     public function getUserByUsername($username){
     	if(!$username){
     		exception('用户不不合法');
     	}
     	$data=['username'=>$username];
     	return $this->where($data)->find();
     }
}
