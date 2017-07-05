<?php
namespace app\admin\controller;
use think\Controller;
class Category extends Base
{
    private $obj;
    public function _initialize(){
        $this->obj=model("Category");
    }
    public function index()
    {
        $parentId=input('get.parent_id',0,'intval');
        $categorys=$this->obj->getFisrtCategory($parentId);
        //var_dump($categorys);
        //exit();
        /**/return $this->fetch('',[
                'categorys'=>$categorys,
            ]);

    }
    public function add(){
        $categorys = $this->obj->getNormalFirstCategory();
    	return $this->fetch('',[
                'categorys'=>$categorys,
            ]);
    }
    public function save(){
    	//print_r($_POST);
    	//print_r(input('post.'));
    	//print_r(request()->post());
        //做一下严格判定
        if(!request()->isPost()){
            $this->error('请求失败!');
        }
        $data=input('post.');
        //$data['status']=10;//状态不合法
        //validate验证
        $validate=validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        /*else{
            print_r(input('post.'));
        }*/
        //判断是否是更新
        //empty()检测一个变量是否为空
        //echo $data['id'];exit();
        if(!empty($data['id'])){
            return $this->update($data);
        }else{
            return '检测不到id';
        }
        //把$data提交model层
        $rel=$this->obj->add($data);
        if($rel){
            $this->success('新增成功!');
        }else{
            $this->error();
        }
    }
    public function edit($id){
        if($id<1){
            $this->error('参数不合法');
        }
        $category = $this->obj->get($id);/*var_dump($category);exit();*/
        $categorys = $this->obj->getNormalFirstCategory();
        return $this->fetch('',[
                'categorys'=>$categorys,
                'category'=>$category,
            ]);

    }
    //修改/更新
    public function update($data){
        $res=$this->obj->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success('更新成功!');
        }else{
            $this->error('更新失败2!');
        }
    }
//排序逻辑
    public function listorder($id,$listorder){
        $res=$this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
        }
    }
    //修改状态
    /*public function status(){
        //print_r(input('get.'));
        $data=input('get.');
        //validate验证
        $validate=validate('Category');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res=$this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }*/
}