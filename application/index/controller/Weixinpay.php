<?php
namespace app\index\controller;
use think\Controller;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\NativePay;
use wxpay\WxPayConfig;
use wxpay\WxPayApi;
use wxpay\WxPayNotify;
use wxpay\PayNotifyCallBack;
class Weixinpay extends controller
{
    public function notify ()
    {
    	//测试
        $weixinData=file_get_contents("php://input");
        file_put_contents('/tmp/2.txt', $weixinData,FILE_APPEND);
    }
    public function wxpayQCode($id){
    	$notify=new NativePay();
    	$input = new WxPayUnifiedOrder();
		$input->setBody("支付 0.01元");
		$input->setAttach("支付 0.01元");
		$input->setOutTradeNo(WxPayConfig::MCHID.date("YmdHis"));
		$input->setTotalFee("1");
		$input->setTimeStart(date("YmdHis"));
		$input->setTimeExpire(date("YmdHis", time() + 600));
		$input->setGoodsTag("test");
		$input->setNotifyUrl("/index.php/index/weixinpay/notify");
		$input->setTradeType("NATIVE");
		$input->setProductId($id);
		$result = $notify->getPayUrl($input);
		if(empty($result["code_url"])){
			$url='';
		}else{
			$url=$result["code_url"];
		}
		return '<img alt="扫码支付" src="/weixin/example/qrcode.php?data='.urlencode($url).'" style="width:300px;height:300px;"/>';
    }
}
