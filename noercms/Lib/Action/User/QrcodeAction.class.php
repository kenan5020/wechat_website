<?php
/**
 *渠道二维码
**/
class QrcodeAction extends UserAction{
	public function index(){
		$db=D('Qrcode');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,10);
		$info=$db->where($where)->order("id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function edit(){
		$where['id']=$this->_get('id','intval');
		$res=D('Qrcode')->where($where)->find();
		$this->assign('info',$res);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		//$where['uid']=session('uid');
		if(D('Qrcode')->where($where)->delete()){
			$this->success('操作成功',U('Qrcode/index'));
		}else{
			$this->error('操作失败',U('Qrcode/index'));
		}
	}
	public function insert(){
		$_POST['add_time']=time();
		$_POST['token']=session('token');
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}
	public function get_code(){
		$where['id']=$this->_get('id','intval');
		$wxuser=D('wxuser')->where(array("token"=>session('token')))->find();
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wxuser['appid']}&secret={$wxuser['appsecret']}";
		//$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx470e8c86f2e865e8&secret=292f80589040459ca57592f752bf2c34";
		$content = ihttp_get($url);
		$token = @json_decode($content['content'], true);
		if($token['errcode']){
			$this->error('返回码:'.$token['errcode'].' 说明:'.$token['errmsg'],U('Qrcode/index'));
		}
		$url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$token['access_token'];
		$info=D('Qrcode')->where($where)->find();
		$data='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$info['title'].'}}}';
		$content =ihttp_post($url,$data);
		$token = @json_decode($content['content'], true);
		$d['ticket']=$token['ticket'];
		if(M('Qrcode')->where(array("id"=>$info['id']))->save($d)!==false){
			$this->success('修改成功',U('Qrcode/index'));
		}else{
			$this->error('修改失败',U('Qrcode/index'));
		}
	}
	public function status(){
		$where['id']=$this->_get('id','intval');
		$type['status']=$this->_get('type');
		if(M('Qrcode')->where($where)->save($type)!==false){
			$this->success('修改成功',U('Qrcode/index'));
		}else{
			$this->error('修改失败',U('Qrcode/index'));
		}
	}
}
?>