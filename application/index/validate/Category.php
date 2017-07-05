<?php
namespace app\index\validate;
use think\Validate;
class Category extends Validate {
	protected $rule= [
		['username','require|max:20','用户名必须填写!|用户名不能超过十个字符!'],
		['email','email','必须是电子邮箱'],
		['password','require|max:20','密码不能为空'],
		['repassword','require|max:20','验证密码不能为空'],
		['verifycode','require|alphaNum','验证码不能为空'],
	];
	/*protected $scene= [
		'add'=>['name','parent_id'],//添加
		'listorder'=>['id','listorder'],//排序
		'status'=>['id','status'],
	];*/
}
