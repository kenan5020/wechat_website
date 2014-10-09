<?php
/* *
 * 功能：即时到账免签交易接口接入页
 * 版本：3.3
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */
class Alipay_freeAction extends UserAction
{
	public function __construct()
	{
		vendor('Malipay.CoreFunction');
		vendor('Malipay.RsaFunction');
        vendor('Malipay.Md5Function');
        vendor('Malipay.Notify');
        vendor('Malipay.Submit');
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		$this->price	= $this->_get('price');
		$this->orderid	= $this->_get('orderid');
		$this->out_trade_no	= $this->_get('sn');
		$this->ordername	= $this->_get('orderName');
		$this->productid	= $this->_get('productid');
		$product_cart_model=M('product_cart');
		$orderid = $this->orderid;
		$this->order = $product_cart_model->where(array('orderid'=>$orderid))->find();
		$this->alipay_m_config = M('Alipay_config')->where(array('token'=>$this->token))->find();
		$this->product = M('Product')->where(array('id'=>$this->productid))->find();
		

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		
		//合作身份者id，以2088开头的16位纯数字
		$alipay_config['partner']		= '2088902827853028';

		//安全检验码，以数字和字母组成的32位字符
		//如果签名方式设置为“MD5”时，请设置该参数
		$alipay_config['key']			= 'jxop8gzzdurn5enrz0q9wrhlflt9s0ow';
		//商户的私钥（后缀是.pen）文件相对路径
		//如果签名方式设置为“0001”时，请设置该参数
		//$alipay_config['private_key_path']	= EXTEND_PATH.'Vendor\\Malipay\\key\\rsa_private_key.pem';

		//支付宝公钥（后缀是.pen）文件相对路径
		//如果签名方式设置为“0001”时，请设置该参数
		//$alipay_config['ali_public_key_path']= EXTEND_PATH.'Vendor\\Malipay\\key\\alipay_public_key.pem';


		//签名方式 不需修改
		$alipay_config['sign_type']    = 'MD5';

		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= 'utf-8';

		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = EXTEND_PATH.'Vendor\\Malipay\\cacert.pem';

		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';
		
		$this->alipay_config = $alipay_config;
		
    }
	
	public function pay()
	{
		if (!$this->token){
			echo 'token不能为空';
			exit;
		}
		if (!$this->order){
			$name = "Product";
			$back = U($name."/my",array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
			$this->error('订单不能为空', U($name . $back));
		}
		$order               = $this->order;
		$product             = $this->product;
		$alipay_config       = $this->alipay_config;
		$ordername           = $this->ordername;

		//返回格式
		$format = "xml";
		//必填，不需要修改

		//返回格式
		$v = "2.0";
		//必填，不需要修改

		//请求号
		$req_id = date('Ymdhis');
		//必填，须保证每次请求都是唯一

		//服务器异步通知页面路径
		$notify_url ='http://127.0.0.1:80'.U('Wap/Alipay_free/notify_url');
		//$notify_url =  C('site_url').U('Wap/Alipay_free/notify_url');
		//$notify_url = C('site_url').'/api/alifree/notify_url.php';
		//需http://格式的完整路径，不允许加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		$call_back_url ='http://127.0.0.1:80'.U('Wap/Alipay_free/call_back_url');
		//$call_back_url = C('site_url').U('Wap/Alipay_free/call_back_url');
		//$call_back_url = C('site_url').'/api/alifree/call_back_url.php';
		//需http://格式的完整路径，不允许加?id=123这类自定义参数
		//卖家支付宝帐户
		$je= round($total_fee*0.85,2);
		$royalty_type = "10";
		$royalty_parameters=$this->alipay_m_config['name']."^".$je."^".$order['orderid'];
		//$seller_email = $_POST['WIDseller_email'];
		$seller_email = '79401468@qq.com';//必须使用我们提示的支付接口，不能更改。防止造成经济损失。
		//必填

		//商户订单号
		//$out_trade_no = $_POST['WIDout_trade_no'];
		$out_trade_no = $order['orderid'];
		//商户网站订单系统中唯一订单号，必填

		//订单名称
		//$subject = $_POST['WIDsubject'];
		$subject = $ordername;
		//必填

		//付款金额
		//$total_fee = $_POST['WIDtotal_fee'];
		$total_fee = $order['price'];
		//必填

		//请求业务参数详细
		$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee></direct_trade_create_req>';
		//必填

		/************************************************************/

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
	
	public function call_back_url()
	{
		$alipay_config       = $this->alipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功

			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
		
			//商户订单号
			$out_trade_no = $_GET['out_trade_no'];
			//支付宝交易号
			$trade_no = $_GET['trade_no'];

			//交易状态
			$result = $_GET['result'];
		
		
			//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
				
			echo "验证成功<br />";
		
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
		}
		else {
			//验证失败
			//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}
		/*zfedit  $call_back = array();
		$call_back['out_trade_no'] = $this->_get('out_trade_no');
		$call_back['request_token'] = $this->_get('request_token');
		$call_back['result'] = $this->_get('result');
		$call_back['trade_no'] = $this->_get('trade_no');
		$call_back['sign'] = $this->_get('sign');
		$call_back['sign_type'] = $this->_get('sign_type');
		
		$alipay_config       = $this->alipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		
		$out_trade_no = $call_back['out_trade_no'];//商户订单号
		$trade_no = $call_back['trade_no'];//支付宝交易号
		$result = $call_back['result'];//交易状态
		$order_db = M('Product_cart');
		$order = $order_db->where('sn = '.$out_trade_no)->find();
		$order_token = $order['token'];
		$order_wecha_id = $order['wecha_id'];
		$back_url = U('Product/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		if($verify_result && $result == "success") {
			if(!$this->checkorderstatus($out_trade_no)){
				$order['paid'] = 1;
				$order_db->where('sn = '.$out_trade_no)->save($order);
            }
			$this->success('支付成功', $back_url);
		}
		else {
			$this->error('支付成功', $back_url);
		}*/
	}
	
	public function notify_url()
	{
		//
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		if($verify_result) {//验证成功
		$doc = new DOMDocument();
		$doc->loadXML($notify_data);
	
			if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
				//商户订单号
				$out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
				echo $out_trade_no." notify";
				//支付宝交易号
				$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
				echo $trade_no." notify";
				//交易状态
				$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
				//echo $trade_status." notify";exit;
				if($_POST['trade_status'] == 'TRADE_FINISHED') {
					
					echo "success";		//请不要修改或删除
				}
				else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
					//判断该笔订单是否在商户网站中已经做过处理
						//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
						//如果有做过处理，不执行商户的业务程序
					echo "success";		//请不要修改或删除
				}
			}
		}
		else {
			//验证失败
			echo "fail";
		
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}

	}
	
	public function checkorderstatus($out_trade_no)
	{
		$order_db = M('Product_cart');
		$ordstatus = $order_db->where('sn = '.$out_trade_no)->getField('paid');
		if($ordstatus==1){
			return true;
		}else{
			return false;    
		}
	}
}
?>