<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function test(){
        print_r(\Map::getLngLat('北京昌平沙河地铁'));
    	return 'singwa';
    }
    public function map(){
        return \Map::staticimage('广州人和地铁站');
    }
    public function welcome(){
        /*\phpmailer\Email::send('1354105797@qq.com','PHPMailer SMTP testd','彭国朝-test-email-太坑了');
        return '发送邮件成功';*/
    	return '欢迎来到o2o主后台首面<center><a href="http://www.miitbeian.gov.cn/">粤ICP备17076211号-1</a></center>';
    }
}
