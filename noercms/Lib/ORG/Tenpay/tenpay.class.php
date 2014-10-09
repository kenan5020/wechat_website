<?php
//---------------------------------------------------------
//财付通即时到帐支付请求示例，商户按照此文档进行开发即可
//---------------------------------------------------------

require_once ("RequestHandler.class.php");

class TenpaySubmit {

	var $tenpay_config;

	function __construct($tenpay_config){
		$this->tenpay_config = $tenpay_config;
	}
	function AlipaySubmit($tenpay_config) {
		$this->__construct($tenpay_config);
	}
	


	function __inithandler($reqHandler){
		$reqHandler->setKey($this->tenpay_config['key']);
		$reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");
    	//----------------------------------------
		//设置支付参数
		//----------------------------------------
		$reqHandler->setParameter("partner", $this->tenpay_config['partner']);
		$reqHandler->setParameter("out_trade_no", $this->tenpay_config['out_trade_no']);
		$reqHandler->setParameter("total_fee", $this->tenpay_config['total_fee']);  //总金额
		$reqHandler->setParameter("return_url", $this->tenpay_config['return_url']);
		$reqHandler->setParameter("notify_url", $this->tenpay_config['notify_url']);
		$reqHandler->setParameter("body", $this->tenpay_config['desc']);
		$reqHandler->setParameter("bank_type", "DEFAULT");  	  //银行类型，默认为财付通
		//用户ip
		$reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);//客户端IP
		$reqHandler->setParameter("fee_type", "1");               //币种
		$reqHandler->setParameter("subject",$this->tenpay_config['desc']);          //商品名称，（中介交易时必填）
		
		//系统可选参数
		$reqHandler->setParameter("sign_type", "MD5");  	 	  //签名方式，默认为MD5，可选RSA
		$reqHandler->setParameter("service_version", "1.0"); 	  //接口版本号
		$reqHandler->setParameter("input_charset", "utf-8");   	  //字符集
		$reqHandler->setParameter("sign_key_index", "1");    	  //密钥序号
		
		//业务可选参数
		$reqHandler->setParameter("attach", "");             	  //附件数据，原样返回就可以了
		$reqHandler->setParameter("product_fee", "");        	  //商品费用
		$reqHandler->setParameter("transport_fee", "0");      	  //物流费用
		$reqHandler->setParameter("time_start", date("YmdHis"));  //订单生成时间
		$reqHandler->setParameter("time_expire", "");             //订单失效时间
		$reqHandler->setParameter("buyer_id", "");                //买方财付通帐号
		$reqHandler->setParameter("goods_tag", "");               //商品标记
		$reqHandler->setParameter("trade_mode","1");              //交易模式（1.即时到帐模式，2.中介担保模式，3.后台选择（卖家进入支付中心列表选择））
		$reqHandler->setParameter("transport_desc","");              //物流说明
		$reqHandler->setParameter("trans_type","1");              //交易类型
		$reqHandler->setParameter("agentid","");                  //平台ID
		$reqHandler->setParameter("agent_type","");               //代理模式（0.无代理，1.表示卡易售模式，2.表示网店模式）
		$reqHandler->setParameter("seller_id","");                //卖家的商户号
		return $reqHandler;
	}

//请求的URL
//$reqUrl = $reqHandler->getRequestURL();




function buildRequestForm($method, $button_name) {
	$reqHandler = new RequestHandler();
	$reqHandler->init();
	$reqHandler = $this->__inithandler($reqHandler);
	//待请求参数数组
	$reqHandler->createSign();
    $params = $reqHandler->getAllParameters();
	ksort($params);

	$sHtml = "<form id='tenpaysubmit' name='tenpaysubmit' action='".$reqHandler->getGateUrl()."' method='".$method."'>";
	while (list ($key, $val) = each ($params)) {
		$sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
	}
	//submit按钮控件请不要含有name属性
	$sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";

	$sHtml = $sHtml."<script>document.forms['tenpaysubmit'].submit();</script>";

	return $sHtml;
}

}
?>
