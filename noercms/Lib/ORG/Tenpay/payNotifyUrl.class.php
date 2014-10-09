
<?php

//---------------------------------------------------------
//财付通即时到帐支付后台回调示例，商户按照此文档进行开发即可
//---------------------------------------------------------

require ("ResponseHandler.class.php");
require ("RequestHandler.class.php");
require ("ClientResponseHandler.class.php");
require ("TenpayHttpClient.class.php");

class payNotifyUrl{
	function getresult($pay_config){
		/* 创建支付应答对象 */
		$resHandler = new ResponseHandler();
		$resHandler->setKey($pay_config['key']);
		
		//判断签名
		if($resHandler->isTenpaySign()) {
			//通知id
			$notify_id = $resHandler->getParameter("notify_id");
			
			//通过通知ID查询，确保通知来至财付通
			//创建查询请求
			$queryReq = new RequestHandler();
			$queryReq->init();
			$queryReq->setKey($pay_config['key']);
			$queryReq->setGateUrl("https://gw.tenpay.com/gateway/simpleverifynotifyid.xml");
			$queryReq->setParameter("partner", $pay_config['partner']);
			$queryReq->setParameter("notify_id", $notify_id);
			
			//通信对象
			$httpClient = new TenpayHttpClient();
			$httpClient->setTimeOut(5);
			//设置请求内容
			$httpClient->setReqContent($queryReq->getRequestURL());
			
			//后台调用
			if($httpClient->call()) {
				$queryRes = new ClientResponseHandler();
				$queryRes->setContent($httpClient->getResContent());
				$queryRes->setKey($pay_config['key']);
				
				if($resHandler->getParameter("trade_mode") == "1"){
					if($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0" && $resHandler->getParameter("trade_state") == "0") {
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
					}else {
						return null
					}
				}
			}else{
				return null
			} 
		}else{
			return null
		}			
	}
}

?>