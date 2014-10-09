<?php

//---------------------------------------------------------
//财付通即时到帐支付页面回调示例，商户按照此文档进行开发即可
//---------------------------------------------------------
require_once ("ResponseHandler.class.php");

class payReturnUrl{
	function getresult(){
		$resHandler = new ResponseHandler();
		$resHandler->setKey($key);
		//判断签名
		if($resHandler->isTenpaySign()) {
			//通知id
			$result_config['notify_id'] = $resHandler->getParameter("notify_id");
			//商户订单号
			$result_config['out_trade_no'] = $resHandler->getParameter("out_trade_no");
			//财付通订单号
			$result_config['transaction_id'] = $resHandler->getParameter("transaction_id");
			//金额,以分为单位
			$result_config['total_fee'] = $resHandler->getParameter("total_fee");
			//如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
			$result_config['discount'] = $resHandler->getParameter("discount");
			//支付结果
			$result_config['trade_state'] = $resHandler->getParameter("trade_state");
			//交易模式,1即时到账
			$result_config['trade_mode'] = $resHandler->getParameter("trade_mode");
			
			return $result_config;

		} else {
			return null;
		}
		
	}
	
}



/* 创建支付应答对象 */


?>