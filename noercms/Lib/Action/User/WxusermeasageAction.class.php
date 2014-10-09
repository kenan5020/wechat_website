<?php
// +----------------------------------------------------------------------
// | G3weixin [ ALL WHERE,ALL TIME ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://lietouzhe.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
class WxusermeasageAction extends WxuserAction{
//文本回复管理
	public function index(){
		
		$where['ToUserName']=$this->wxuserinfo['wxid'];
		$order['id']='desc';
		$count=D('Wxuser_message')->where($where)->count();
		$page=new Page($count,C('page_count'));
		$info=D('Wxuser_message')->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		//print_r($info);
		$this->display();
	}
	public function answer(){
		$message=M('Wxuser_message')->where(array('id'=>$this->_get('id'),'ToUserName'=>$this->wxuserinfo['wxid']))->find();
		$this->assign('message',$message);
		$this->display();
	}
	public function more(){
		$where['id']=$this->_get('id','intval');
		$where['ToUserName']=$this->wxuserinfo['wxid'];
		$order['id']='desc';
		$count=D('Wxuser_message')->where($where)->count();
		$page=new Page($count,C('page_count'));
		$info=D('Wxuser_message')->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D('Text')->where($where)->delete()){
			M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Text'))->delete();
			$this->success('操作成功',U('User/Text/index'));
		}else{
			$this->error('操作失败',U('User/Text/index'));
		}
	}
	public function post(){
		$message=M('Wxuser_message')->where(array('id'=>$this->_post('id'),'ToUserName'=>$this->wxuserinfo['wxid']))->find();
		
		
		$api=M('Diymen_set')->where(array('token'=>session('token')))->find();
		$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$api['appid'].'&secret='.$api['appsecret'];
		$json=json_decode($this->curlGet($url_get));		
		$data='{"touser":"'.$message['FromUserName'].'","msgtype":"text","text":{"content":"'.$this->_post('text').'"}}';
		$url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$json->access_token;
		if($this->api_notice_increment($url,$data)==false){
			$this->error('操作失败');
		}else{
			$this->success('操作成功');
		}
		
		
	}
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
	function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch)) {
			return false;
		}else{

			return true;
		}
	}
	

}
?>