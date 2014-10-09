<?php
/**
 *分组管理
**/
class GroupAction extends UserAction{
	public function index(){
		$db=D('Group');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,10);
		$info=$db->where($where)->order("id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	public function sync(){
		$wxuser=D('wxuser')->where(array("token"=>session('token')))->find();
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wxuser['appid']}&secret={$wxuser['appsecret']}";
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx470e8c86f2e865e8&secret=292f80589040459ca57592f752bf2c34";
		$content = ihttp_get($url);
		$token = @json_decode($content['content'], true);
		if($token['errcode']){
			$this->error('返回码:'.$token['errcode'].' 说明:'.$token['errmsg'],U('Qrcode/index'));
		}
		$url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token=".$token['access_token'];
		$content = ihttp_get($url);
		if($content['code']=='200'){
			$token2 = @json_decode($content['content'], true);
			$tmp=array();
			foreach($token2['groups'] as $v){
				$group=M('group')->where(array("token"=>session('token'),"gid"=>$v['id']))->find();
				array_push($tmp,$group['id']);
				if(empty($group)){
					$data['gid']=$v['id'];
					$data['name']=$v['name'];
					$data['count']=$v['count'];
					$data['token']=session('token');
					M('group')->add($data);
				}else{
					//更新分组名到微信服务端
					$data='{"group":{"id":'.$group['id'].',"name":"'.$group['name'].'"}}';
					$url='https://api.weixin.qq.com/cgi-bin/groups/update?access_token='.$token['access_token'];
					$content =ihttp_post($url,$data);
				}
			}

			//本地新加的上传到微信服务端
			$localgroup=M('group')->where(array("token"=>session('token')))->select();
			foreach($localgroup as $g){
				if(in_array($g['id'],$tmp)){
					continue;
				}else{
					$data='{"group":{"name":"'.$g['name'].'"}}';
					$url='https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.$token['access_token'];
					$returncontent =ihttp_post($url,$data);
					$token3 = @json_decode($returncontent['content'], true);
					$data3['gid'] = $token3['group']['id'];
					M("Group")->where('id='.$g['id'])->save($data3);
				}
			}
			$this->success('修改成功',U('Group/index'));
		}else{
			$this->error('修改失败',U('Group/index'));
		}

	}
	public function add(){
		$this->display();
	}
	public function edit(){
		$where['id']=$this->_get('id','intval');
		$res=D('Group')->where($where)->find();

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
		$_POST['nums']=0;
		$_POST['count']=0;
		$_POST['token']=session('token');
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}
	public function get_code(){
		$where['id']=$this->_get('id','intval');
		$wxuser=D('wxuser')->where(array("token"=>session('token')))->find();
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$_W['appid']}&secret={$_W['appsecret']}";
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