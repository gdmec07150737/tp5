<?php
namespace app\index\controller;
use think\Controller;
class User extends Controller
{
    public function login ()
    {	
    	$user=session('o2o_user','');
    	if($user&&$user->id){
    		$this->redirect(url('index/index'));
    	}
        return $this->fetch();
    }
    public function register()
    {
    	if(request()->isPost()){
	    	$data=input('post.');	   	
	    	//严格校验 逃tp5 validate
	    	$validate=validate('Category');
	    	if(!$validate->scene('register')->check($data)){
            	$this->error($validate->getError());
       		}
       		//验证验证吗
       		if(!captcha_check($data['verifycode'])){
	    		//验证失败
	    		$this->error('验证码不正确');
	    	}
	    	//验证密码
       		if($data['password']!=$data['repassword']){
       			$this->error('两次输入的密码不一样'); 
       		}
       		//自动生成，密码的加盐字符串
       		$data['code']=mt_rand(100,10000);
       		$data['password']=md5($data['password'].$data['code']);
       		//$data=12;//test
       		try{
       			$res=model('User')->add($data);
       		}catch(\Exception $e){
       			$this->error($e->getMessage());
       			/*SQLSTATE[23111]: Integrity constraint violation: 1162 Duplicate entry '彭国朝' for key 'username'*/
       		}
       		if($res){
       			$this->success('注册成功',url('user/login'));
       		}else{
       			$this->error('注册失败');
       		}
    	}else{
    		return $this->fetch();
    	}
    }
    public function logincheck(){
    	if(!request()->isPost()){
    		$this->error('提交不合法');
    	}
    	$data=input('post.');
    	//严格验证 tp valiate
    	$validate=validate('Category2');
    	if(!$validate->scene('logincheck')->check($data)){
        	$this->error($validate->getError());
   		}
   		try{
   			$user=model('User')->getUserByUsername($data['username']);
   		}catch(\Exception $e){
   			$this->error($e->getMessage());
   		}
   		//print_r($user);
   		//判断用户
   		if(!$user || $user->status!=1){
   			$this->error('该用户不存在!');
   		}
   		//判断用户密码是否正确
   		if(md5($data['password'].$user->code)!=$user->password){
   			$this->error('密码不正确');
   		}
   		//登陆成功，更新一些用户登录信息
   		model('User')->updateById(['last_login_time'=>time()],$user->id);
   		//把用户信息记录到session
   		session("o2o_user",$user);
   		$this->success('登录成功',url('index/index'));
    }
    public function logout(){
    	session(null);
    	$this->redirect(url('user/login'));
    }
}