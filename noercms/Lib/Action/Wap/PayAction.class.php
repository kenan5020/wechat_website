<?php
class PayAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $pay_config;
	public $orders_url;
	public $wapalipay_config;
	public $zfalipay_config;
	public $wxpay_config;
	
	public function _initialize() {
		parent::_initialize();
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		$this->orderid	= $this->_get('orderid');
		
		$order = M('product_cart')->where(array('orderid'=>$this->orderid))->find();
		if (!$order){
			$this->error('订单信息不正确');
		}else{
			//获得订单产品
			$products=M('product_cart_list')->where(array('cartid'=>$order['id'],'token'=>$this->token))->select();
			$order_name='';
			foreach($products as $v){
				if($v['productid']=='dining'){
					$product_name = M('dining')->where(array('id'=>$v['productid']))->getField('name');
				}else{
					$product_name = M('product')->where(array('id'=>$v['productid']))->getField('name');
				}
				$order_name .=$product_name.'|';
			}
			$order['ordername']= rtrim($order_name,'|');
			if($order['dining'] ==1){
				$this->orders_url=U('Dining/dingdan',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
			}else{
				$this->orders_url=U('Product/my',array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'success'=>1));
			}
		}
		$this->order=$order;
		$payment =M('payment')->where(array('token'=>$this->token,'pay_code'=>ACTION_NAME))->find();
		if(!$payment || $payment['enabled'] !=1){
			echo "<script>alert('支付配置有误，请与管理员联系！');location.href='".$url."';</script>";
		}
		$pay_config = unserialize($payment['pay_config']);
		
		//手机支付配置
		$wapalipay_config['seller_email'] = trim($pay_config['account']);
		$wapalipay_config['partner']		= trim($pay_config['pid']);
		$wapalipay_config['key']			= trim($pay_config['key']);
		$wapalipay_config['sign_type']    = strtoupper('MD5');
		$wapalipay_config['input_charset']= strtolower('utf-8');
		$wapalipay_config['cacert']    = EXTEND_PATH.'Vendor\\Malipay\\cacert.pem';
		$wapalipay_config['transport']    = 'http';
		$this->wapalipay_config = $wapalipay_config;
		//免签支付宝配置
		$zfalipay_config['seller_email'] = C('alipay_name');
		$zfalipay_config['partner']		= C('alipay_pid');
		$zfalipay_config['key']			= C('alipay_key');
		$zfalipay_config['sign_type']    = strtoupper('MD5');
		$zfalipay_config['input_charset']= strtolower('utf-8');
		$zfalipay_config['cacert']    = getcwd().'\\zhifeng\\Lib\\ORG\\Alipay\\cacert.pem';
		$zfalipay_config['transport']    = 'http';
		$zfalipay_config['royalty_email'] = trim($pay_config['account']);
		$this->zfalipay_config = $zfalipay_config;
		
	}
	//手机支付宝
	public function wapalipay(){
        vendor('Malipay.alipay_submit','','.class.php');
		$alipay_config=$this->wapalipay_config;
		$order = $this->order;
		//返回格式
		$format = "xml";
		$v = "2.0";
		$req_id = date('Ymdhis');
		$notify_url=C('site_url').'/index.php/Wap/Pay/wapalipay_notify_url';
		$call_back_url=C('site_url').'/index.php/Wap/Pay/wapalipay_call_back_url';
		$seller_email = $alipay_config['seller_email'];
		$out_trade_no = $order['orderid'];
		$subject = $order['ordername'];
		$total_fee = $order['price'];
		
		//请求业务参数详细
		$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee></direct_trade_create_req>';
		
		//构造要请求的参数数组，无需改动
		$para_token = array(
				"service" => "alipay.wap.trade.create.direct",
				"partner" => trim($alipay_config['partner']),
				"sec_id" => trim($alipay_config['sign_type']),
				"format"	=> $format,
				"v"	=> $v,
				"req_id"	=> $req_id,
				"req_data"	=> $req_data,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestHttp($para_token);

		//URLDECODE返回的信息
		$html_text = urldecode($html_text);

		//解析远程模拟提交后返回的信息
		$para_html_text = $alipaySubmit->parseResponse($html_text);

		//获取request_token
		$request_token = $para_html_text['request_token'];


		/**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/

		//业务详细
		$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
		//必填

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "alipay.wap.auth.authAndExecute",
				"partner" => trim($alipay_config['partner']),
				"sec_id" => trim($alipay_config['sign_type']),
				"format"	=> $format,
				"v"	=> $v,
				"req_id"	=> $req_id,
				"req_data"	=> $req_data,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '正确为您跳转到支付宝支付界面!');
		echo $html_text;	
	}
	//免签支付宝
	public function zfalipay(){
		import("@.ORG.Alipay.AlipaySubmit");
		$alipay_config=$this->zfalipay_config;
		$order = $this->order;
		
		//即时到帐支付类型
		$payment_type = "1";
		$notify_url=C('site_url').'/index.php/Wap/Pay/zfalipay_notify_url';
		$return_url=C('site_url').'/index.php/Wap/Pay/zfalipay_return_url';
		//付款金额
		$total_fee =floatval($order['price']);
		//计算分润
		$royalty_money= round($total_fee*0.985,2);
		$royalty_type = "10";
		$royalty_parameters = $alipay_config['royalty_email']."^".$royalty_money."^".$order['ordername'];
		
		$seller_email = $alipay_config['seller_email'];
		$out_trade_no = $order['orderid'];
		$subject = $order['ordername'];
		$partner	=  $alipay_config['partner'];
		$body = $order['ordername'];
		//商品展示地址
		$show_url = 'http://'.$_SERVER['HTTP_HOST'].U('Wap/index',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
		$anti_phishing_key = "";
		$exter_invoke_ip = "";

		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service" => "create_direct_pay_by_user",
			"partner" =>$partner,
			"payment_type"	=> $payment_type,
			"notify_url"	=> $notify_url,
			"return_url"	=> $return_url,
			"royalty_type"=> $royalty_type,
			"royalty_parameters"=>$royalty_parameters,
			"seller_email"	=> $seller_email,
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"show_url"	=> $show_url,
			"anti_phishing_key"	=> $anti_phishing_key,
			"exter_invoke_ip"	=> $exter_invoke_ip,
			"_input_charset"	=>trim(strtolower('utf-8'))
		);
		//print_r($parameter);exit;
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "进行支付");
		echo '正在跳转到支付宝进行支付...<div style="display:none">'.$html_text.'</div>';
	}
	//微信支付
	public function wxpay(){
		$this->success('下单成功，微信支付即将推出', $this->orders_url);
	}
	public function wapalipay_call_back_url(){
        vendor('Malipay.alipay_notify','','.class.php');
		$alipay_config=$this->wapalipay_config;
		
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		
		$out_trade_no = $this->_get('out_trade_no');//商户订单号
		$trade_no = $this->_get('trade_no');//支付宝交易号
		$result = $this->_get('result');//交易状态
		
		$order_db = M('Product_cart');
		$order = $order_db->where(array('orderid'=>$out_trade_no))->find();
		$order_token = $order['token'];
		$order_wecha_id = $order['wecha_id'];
		if($order['dining']==1){
			$back_url = U('Dining/dingdan',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		}else{
			$back_url = U('Product/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		}
		if($verify_result){//验证成功
			
			if($result == "success") {
				$order_db->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				$this->success('支付成功', $back_url);
			}
			else {
				$this->error('支付失败', $back_url);
			}
		}else{
			$this->error('支付验证失败！', $back_url);
		}
	}
	public function wapalipay_notify_url()
	{	
		vendor('Malipay.alipay_notify','','.class.php');
		$alipay_config=$this->wapalipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			$trade_status   = $_POST['trade_status']; //交易状态
			$out_trade_no = $_POST['out_trade_no']; //商户订单号
			$trade_no = $_POST['trade_no']; //支付宝交易号
			$trade_status = $_POST['trade_status']; //交易状态
			$total_fee =$_POST['total_fee']; //交易金额
			
			$order =  M('Product_cart')->where(array('orderid'=>$out_trade_no))->find();
			if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
				M('Product_cart')->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				echo "success";	
			}	
		}else {
			exit('付款失败');
		}
	}
	public function zfalipay_return_url(){
		import("@.ORG.Alipay.AlipayNotify");
		$alipay_config=$this->zfalipay_config;
		
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		
		$out_trade_no = $this->_get('out_trade_no');//商户订单号
		$trade_no = $this->_get('trade_no');//支付宝交易号
		$result = $this->_get('result');//交易状态
		
		$order_db = M('Product_cart');
		$order = $order_db->where(array('orderid'=>$out_trade_no))->find();
		$order_token = $order['token'];
		$order_wecha_id = $order['wecha_id'];
		if($order['dining']==1){
			$back_url = U('Dining/dingdan',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		}else{
			$back_url = U('Product/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		}
		if($verify_result){//验证成功
			
			if($result == "success") {
				$order_db->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				$this->success('支付成功', $back_url);
			}
			else {
				$this->error('支付失败', $back_url);
			}
		}else{
			$this->error('支付验证失败！', $back_url);
		}
	}
	public function zfalipay_notify_url(){	
		import("@.ORG.Alipay.AlipayNotify");
		$alipay_config=$this->zfalipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			$trade_status   = $_POST['trade_status']; //交易状态
			$out_trade_no = $_POST['out_trade_no']; //商户订单号
			$trade_no = $_POST['trade_no']; //支付宝交易号
			$trade_status = $_POST['trade_status']; //交易状态
			$total_fee =$_POST['total_fee']; //交易金额
			
			$order =  M('Product_cart')->where(array('orderid'=>$out_trade_no))->find();
			if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
				M('Product_cart')->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				echo "success";	
			}	
		}else {
			exit('付款失败');
		}
	}
}
?>