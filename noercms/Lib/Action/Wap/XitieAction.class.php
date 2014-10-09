<?php
class XitieAction extends BaseAction{
	public function index(){
		// $agent = $_SERVER['HTTP_USER_AGENT']; 
		// if(!strpos($agent,"MicroMessenger")) {
			// echo '此功能只能在微信浏览器中使用';
	     	// exit;
		// }
		$token	  =  $this->_get('token');
		$id 	  = $this->_get('id');
		if ($id == false) {
			$reply_info_db=M('Reply_info');
			$replyInfo=$reply_info_db->where(array('token'=>$token,'infotype'=>'Xitie'))->find();
			$this->assign('replyInfo',$replyInfo);
			//
			$where=array('token'=>$token);
			$list=M('Xitie')->where($where)->order('taxis ASC')->select();
			$this->assign('list',$list);
			//dump($list);
			$this->display('indexall');
		}else{
			$Xitie = M('Xitie')->where(array('id'=>$id,'token'=>$token,'type'=>1))->find(); 
			$this->assign('Xitie',$Xitie);
			$this->assign('Token',$token);
			$this->assign('id',$id);
			$this->display();
		}	
	}

	public function add(){
		if($_POST['action'] =='add'){
			$data=array();
			$data['uid'] 		= $this->_post('id');
			$data['token'] 		= $this->_post('token');
			$data['userName'] = $this->_post('userName');
			$data['telephone'] = $this->_post('telephone');
			$data['count'] = $this->_post('count');
			$data['content'] = "";
			$data['type']="1";
			$result=M('Xitiebbs')->add($data);
			echo'提交成功';
			exit;
		}else{

			echo'提交失败';
		}

	}
	public function add2(){
		if($_POST['action'] =='add2'){
			$data=array();
			$data['uid'] 		= $this->_post('id');
			$data['token'] 		= $this->_post('token');
			$data['userName'] = $this->_post('userName');
			$data['telephone'] = $this->_post('telephone');
			$data['content'] = $this->_post('content');
			$data['type']="2";
			$result=M('Xitiebbs')->add($data);
			echo'提交成功';
			exit;
		}else{

			echo'提交失败';
		}

	}
	
}
?>