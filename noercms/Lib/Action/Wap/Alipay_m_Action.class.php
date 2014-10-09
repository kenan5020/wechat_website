<?php
/* *
 * 功能：即时到账交易接口接入页
 * 版本：3.3
 * 修改日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*************************
 * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 * 1、商户服务中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申请集成协助，我们会有专业的技术工程师主动联系您协助解决
 * 2、商户帮助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
 * 3、支付宝论坛（http://club.alipay.com/read-htm-tid-8681712.html）
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */
class Alipay_m_Action extends UserAction
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
		$this->out_trade_no	= $this->_get('orderid');
		$this->ordername	= $this->_get('orderName');
		$this->productid	= $this->_get('productid');				
		$this->alipay_m_config = M('Alipay_config')->where(array('token'=>$this->token))->find();
		
		$orderid = $this->orderid;	
		$product_cart_model=M('product_cart');
		$this->order = $product_cart_model->where(array('orderid'=>$orderid))->find();
		//合作身份者id，以2088开头的16位纯数字
		$alipay_config['partner']		= $this->alipay_m_config['pid'];

		//安全检验码，以数字和字母组成的32位字符
		//如果签名方式设置为“MD5”时，请设置该参数
		$alipay_config['key']			= $this->alipay_m_config['key'];

		//商户的私钥（后缀是.pen）文件相对路径
		//如果签名方式设置为“0001”时，请设置该参数
		//$alipay_config['private_key_path']	= EXTEND_PATH.'Vendor\\Malipay\\key\\rsa_private_key.pem';

		//支付宝公钥（后缀是.pen）文件相对路径
		//如果签名方式设置为“0001”时，请设置该参数
		//$alipay_config['ali_public_key_path']= EXTEND_PATH.'Vendor\\Malipay\\key\\alipay_public_key.pem';


		//签名方式 不需修改
		$alipay_config['sign_type']    = strtoupper('MD5');

		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= strtolower('utf-8');

		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = EXTEND_PATH.'Vendor\\Malipay\\cacert.pem';

		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';
		
		$this->alipay_config = $alipay_config;
		
    }
	
	public function pay()
	{	
		$this->modelname	= $this->_get('modelname');
		//判断类型
		if (!empty($this->modelname)){
			$modelname=$this->modelname;
			$this->product = M($modelname)->where(array('id'=>$this->productid))->find();
		}else{
			$modelname="Product";
			$this->product = M('Product')->where(array('id'=>$this->productid))->find();
		}
		
		
		if (!$this->token){
			echo 'token不能为空';
			exit;
		}
		if (!$this->order){
			$name = $modelname;
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
		$notify_url=C('site_url').'/index.php/Wap/Alipay_m_/notify_url';
		//echo($notify_url);exit;
		//$notify_url = C('site_url').'/api/wapali/notify_url.php';
		//需http://格式的完整路径，不允许加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		$call_back_url=C('site_url').'/index.php/Wap/Alipay_m_/call_back_url';
		//$call_back_url = C('site_url').'/api/wapali/call_back_url.php';
		//需http://格式的完整路径，不允许加?id=123这类自定义参数
		//卖家支付宝帐户
		//$seller_email = $_POST['WIDseller_email'];
		$seller_email = $this->alipay_m_config['name'];
		//必填

		//商户订单号
		//$out_trade_no = $_POST['WIDout_trade_no'];
		$out_trade_no = $order['orderid'];
		//商户网站订单系统中唯一订单号，必填

		//订单名称
		//$subject = $_POST['WIDsubject'];
		//$subject = charsetEncode($ordername,'',$alipay_config['input_charset']);
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
	
	/*public function call_back_url()
	{
		$call_back = array();
		$call_back['out_trade_no'] = $this->_get('out_trade_no');
		$call_back['request_token'] = $this->_get('request_token');
		$call_back['result'] = $this->_get('result');
		$call_back['trade_no'] = $this->_get('trade_no');
		$call_back['sign'] = $this->_get('sign');
		$call_back['sign_type'] = $this->_get('sign_type');
		
		$alipay_config       = $this->alipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		//echo($verify_result);exit;
		
		$out_trade_no = $call_back['out_trade_no'];//商户订单号
		$trade_no = $call_back['trade_no'];//支付宝交易号
		$result = $call_back['result'];//交易状态
		$order_db = M('Product_cart');
		$order = $order_db->where(array('orderid'=>$out_trade_no))->find();
		$order_token = $order['token'];
		$order_wecha_id = $order['wecha_id'];
		if($order['dining']==1){
		$back_url = U('Dining/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		}else{
		$back_url = U('Product/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
		}
		if($verify_result && $result == "success") {
			if(!$this->checkorderstatus($out_trade_no)){
				//$order['paid'] = 1;
				$order_db->where(array('orderid'=>$out_trade_no))->setField('paid',1);
            }
			$this->success('支付成功', $back_url);
		}
		else {
			$this->error('支付失败', $back_url);
		}
	}*/
	public function call_back_url()
	{
		
		$alipay_config       = $this->alipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		//if($verify_result){//验证成功
			$out_trade_no = $this->_get('out_trade_no');//商户订单号
			$trade_no = $this->_get('trade_no');//支付宝交易号
			$result = $this->_get('result');//交易状态
			$request_token = $this->_get('request_token');//fanhuishuj
			$sign = $this->_get('sign');//qm
			$sign_type = $this->_get('sign_type');
			
			$order_db = M('Product_cart');
			$order = $order_db->where(array('orderid'=>$out_trade_no))->find();
			$order_token = $order['token'];
			$order_wecha_id = $order['wecha_id'];
			if($order['dining']==1){
			$back_url = U('Dining/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
			}else{
			$back_url = U('Product/my',array('token'=>$order_token,'wecha_id'=>$order_wecha_id));
			}
			if( $result == "success") {
				if(!$this->checkorderstatus($out_trade_no)){
					//$order['paid'] = 1;
					$order_db->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				}
				$this->success('支付成功', $back_url);
			}
			else {
				$this->error('支付失败', $back_url);
			}
		//}else{
			// echo "验证失败";
		//}
	}
	public function notify_url()
	{	
		vendor('Malipay.Notify');
		$alipay_config       = $this->alipay_config;
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代

			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			
			//解密（如果是RSA签名需要解密，如果是MD5签名则下面一行清注释掉）
			//$notify_data = $alipayNotify->decrypt($_POST['notify_data']);
			
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
				$trade_status   = $_POST['trade_status']; //交易状态
				$out_trade_no = $_POST['out_trade_no']; //商户订单号
				$trade_no = $_POST['trade_no']; //支付宝交易号
				$trade_status = $_POST['trade_status']; //交易状态
				$total_fee =$_POST['total_fee']; //交易金额
				
				$order =  M('Product_cart')->where(array('orderid'=>$out_trade_no))->find();
			//解析notify_data
			//注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
		//	$doc = new DOMDocument();
			//$doc->loadXML($notify_data);
			
			//if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
				//商户订单号
				//$out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
				//支付宝交易号
				//$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
				//交易状态
				//$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
				//交易类型
				//$modelname = $doc->getElementsByTagName( "modelname" )->item(0)->nodeValue;
				if($_POST['trade_status'] == 'TRADE_FINISHED') {
					//判断该笔订单是否在商户网站中已经做过处理
					if(!$this->checkorderstatus($out_trade_no)){
						$order['paid'] = 1;
						$order_db->where(array('orderid'=>$out_trade_no))->setField('paid',1);
					}
					//调试用，写文本函数记录程序运行情况是否正常
					//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
					
					echo "success";		//请不要修改或删除
				}
				else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
					//判断该笔订单是否在商户网站中已经做过处理
					if(!$this->checkorderstatus($out_trade_no)){
						$order['paid'] = 1;
						$order_db->where(array('orderid'=>$out_trade_no))->setField('paid',1);
					}
					
					echo "success";		//请不要修改或删除
				}
			

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
		$ordstatus = $order_db->where(array('orderid'=>$out_trade_no))->getField('paid');
		if($ordstatus==1){
			return true;
		}else{
			return false;    
		}
	}
}
?>