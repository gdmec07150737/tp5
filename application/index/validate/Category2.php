<?php
namespace app\index\validate;
use think\Validate;
class Category2 extends Validate {
	protected $rule= [
		['username','require|max:20','用户名必须填写!|用户名不能超过十个字符!'],
		['password','require|max:20','密码不能为空'],
	];
	/*protected $scene= [
		'add'=>['name','parent_id'],//添加
		'listorder'=>['id','listorder'],//排序
		'status'=>['id','status'],
	];*/
}
