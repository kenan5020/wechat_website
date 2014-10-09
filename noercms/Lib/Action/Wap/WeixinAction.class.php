<?php
class WeixinAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $payConfig;
	public function __construct(){
		
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->token){
			//
			$product_cart_model=M('product_cart');
			$out_trade_no = $this->_get('out_trade_no');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
			if (!$order){
				$order=$product_cart_model->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
			}
			$this->token=$order['token'];
		}
		//读取支付宝配置
		$pay_config_db=M('Alipay_config');
		$this->payConfig=$pay_config_db->where(array('token'=>$this->token))->find();
	}
	public function pay(){
		import("@.ORG.Weixinpay.CommonUtil");
		import("@.ORG.Weixinpay.WxPayHelper");
		$commonUtil = new CommonUtil();
		//var_export($this->payConfig);
		//exit();
		$wxPayHelper = new WxPayHelper($this->payConfig['appid'],$this->payConfig['paysignkey'],$this->payConfig['partnerkey']);

		$wxPayHelper->setParameter("bank_type", "WX");
		$wxPayHelper->setParameter("body", $_GET['single_orderid']);
		$wxPayHelper->setParameter("partner", $this->payConfig['partnerid']);
		$wxPayHelper->setParameter("out_trade_no",$_GET['single_orderid']);
		$wxPayHelper->setParameter("total_fee", floatval($_GET['price'])*100);
		$wxPayHelper->setParameter("fee_type", "1");
		$wxPayHelper->setParameter("notify_url", C('site_url').'/index.php?g=Wap&m=Weixin&a=return_url');
		//$wxPayHelper->setParameter("notify_url", 'http://www.baidu.com');
		$wxPayHelper->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);
		$wxPayHelper->setParameter("input_charset", "GBK");
		$url=$wxPayHelper->create_biz_package();
		$this->assign('url',$url);
		$this->assign('returnUrl','?g=Wap&m=Product&a=my&token='.$this->token.'&wecha_id='.$this->wecha_id);//................
		$this->display();
	}
	//同步数据处理
	public function return_url (){
		F('pay',$_GET);
		$out_trade_no = $this->_get('out_trade_no');
		if(intval($_GET['total_fee'])&&!intval($_GET['trade_state'])) {
			$product_cart_model=M('product_cart');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
			F('order',$order);
			if (!$this->wecha_id){
				$this->wecha_id=$order['wecha_id'];
			}
			$sepOrder=0;
			if (!$order){
				$order=$product_cart_model->where(array('id'=>$out_trade_no))->find();
				$sepOrder=1;
			}
			if($order){
				if($order['paid']==1){exit('该订单已经支付,请勿重复操作');}
				if (!$sepOrder){
					$product_cart_model->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				}else {
					$product_cart_model->where(array('id'=>$out_trade_no))->setField('paid',1);
				}
				/************************************************/
				$member_card_create_db=M('Member_card_create');
				$userCard=$member_card_create_db->where(array('token'=>$order['token'],'wecha_id'=>$order['wecha_id']))->find();
				$member_card_set_db=M('Member_card_set');
				$thisCard=$member_card_set_db->where(array('id'=>intval($userCard['cardid'])))->find();
				$set_exchange = M('Member_card_exchange')->where(array('cardid'=>intval($thisCard['id'])))->find();
				//
				$arr['token']=$order['token'];
				$arr['wecha_id']=$order['wecha_id'];
				$arr['expense']=$order['price'];
				$arr['time']=time();
				$arr['cat']=99;
				$arr['staffid']=0;
				$arr['score']=intval($set_exchange['reward'])*$order['price'];
				M('Member_card_use_record')->add($arr);
				$userinfo_db=M('Userinfo');
				$thisUser = $userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->find();
				$userArr=array();
				$userArr['total_score']=$thisUser['total_score']+$arr['score'];
				$userArr['expensetotal']=$thisUser['expensetotal']+$arr['expense'];
				$userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->save($userArr);
				/************************************************/
				//if($back!=false&&$add!=false){
				//$this->redirect(U('Product/my',array('token'=>$order['token'],'wecha_id'=>$order['wecha_id'],'success'=>1)));
				//}else{
				//$this->error('充值失败,请在线客服,为您处理',U('User/Index/index'));
				//}
			}else{
				exit('订单不存在：'.$out_trade_no);
			}
		}else {
			exit('付款失败');
		}
	}
	public function notify_url(){
		echo "success"; 
		eixt();
	}
}
?>