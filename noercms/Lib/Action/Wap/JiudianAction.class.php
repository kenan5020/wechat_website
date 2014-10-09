<?php
//wap
class JiudianAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $Yuyue_model;
	public $yuyue_order;
	public function __construct(){
		
		parent::__construct();
		$this->token=session('token');
		// $this->token = $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		$this->assign('wecha_id',$this->wecha_id);
		$this->Yuyue_model=M('yuyue');
		$this->yuyue_order=M('yuyue_order');
		$this->type='Jiudian';

	}

	
	//预约列表
	public function index(){
		$pid = $this->_get('id');
		$wecha_id = $this->_get('wecha_id');
		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		$data = $this->Yuyue_model->where($where)->find();
		$info = M('yuyue_setcin')->where(array('pid'=>$pid,'type'=>$this->type))->select();
		//print_r($info);die;
		$data['count'] = $this->yuyue_order->where(array('wecha_id'=> $wecha_id,'pid'=>$pid))->count();
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $wecha_id;
		//print_r($str);die;
		$this->assign('data', $data);
		$this->assign('info', $info);
		$this->display();
	}
	
	public function info(){
		$pid = $this->_get('id');
		$id = $this->_get('aid');
		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);
		$info = M('yuyue_setcin')->where(array('id'=>$id))->find();
		$info['sheng']=intval($info['yuanjia']-$info['youhui']);
		$info['yuanjia']=intval($info['yuanjia']);
		$info['youhui']=intval($info['youhui']);
		$data = $this->Yuyue_model->where($where)->find();
		for($i=1;$i<6;$i++){
			if(!empty($info['pic'.$i])){
				$info['pic'][]=$info['pic'.$i];
				unset($info['pic'.$i]);
			}
		}
		//print_r($data);print_r($info);die;
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$wap= M('setinfo')->where(array('pid'=>$pid))->select();
		$str=array();
		//print_r($wap);die;
		foreach($wap as $v){

			if($v['kind']==5){
				$str["message"]=$v["name"];
			}else{
				$str[$v["name"]]=$v["value"];
			}		
		}
		//print_r($str);die;
		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid,'token'=>$this->_get('token')))->select();
		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid,'token'=>$this->_get('token')))->select();
		$i=0;
		foreach($list as $v){
			$list[$i]['value']= explode("|",$v['value']);
			$i++;
		}
		//print_r($list);die;
		
		$this->assign('str', $str);
		$this->assign('arr',$arr);
		$this->assign('list',$list);
		$this->assign('data', $data);
		$this->assign('info', $info);
		$this->display();
	}
	
	//添加订单
	public function add(){
		
		if(IS_POST){
			$url = U($this->type.'/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
			$url = substr($url,1);
			//$url = U($this->type.'/order',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']));
			$_POST['date']= date("Y-m-d H:i:s",time());
			if($this->yuyue_order->add($_POST)){
				// 给客户发送短信
					$info=M('wxuser')->where(array('token'=>$_POST['token']))->find();
					
					$user=$info['smsuser'];//短信平台帐号
					$pass=md5($info['smspassword']);//短信平台密码
					$smsstatus=$info['smsstatus'];//短信平台状态
					//$content =姓名 电话  入住时间 和 房型
					$content = "姓名:".$_POST['name'].'电话:'.$_POST['phone'].'入住日期:'.date("Y-m-d",strtotime($_POST['date'])).' '.$_POST['time'].'房型:'.$_POST['kind'];

					if ($user && $smsstatus == 1 && $content) {
						$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$info['phone'].'&c='.urlencode($content));
					}
				$json = array(
					'error'=> 1,
					'msg'=> '添加成功！',
					'url'=> $url
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'error'=> 0,
					'msg'=> '添加失败！',
					'url'=> U($this->type.'/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']))
				);
				echo  json_encode($json);
			}
		}
	}
	
	
	//订单列表
	public function order(){
		$id = $this->_get('id');
		$token = $this->_get('token');
		$wecha_id = $this->_get('wecha_id');
		$where = array(
			'wecha_id'=> $wecha_id,
			'pid'=> $id
		);
		$data = $this->yuyue_order->where($where)->order('id desc')->select();
		$info= $this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$id))->find();
		//print_r($data);die;
		$this->assign('data',$data);
		$this->assign('info',$info);
		$this->display();
	}
	
	//修改订单视图
	public function set(){
		$id = $this->_get('id');
		$pid = $this->_get('pid');
		
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);
		$data = M('yuyue_order')->where(array('id'=>$id))->find();
		$info = M('yuyue_setcin')->where(array('name'=>$data['kind']))->find();
		$info['sheng']=$info['yuanjia']-$info['youhui'];
		
		//print_r($data);print_r($info);die;
		$copyright=$this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$pid))->find();
		$data['copyright']=$copyright['copyright'];
		//print_r($copyright);die;
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$wap= M('setinfo')->where(array('pid'=>$pid))->select();
		$str=array();
		foreach($wap as $v){
			if($v['kind']==5){
				$str["message"]=$v["name"];
			}
			else{
				$str[$v["name"]]=$v["value"];
			}
		}
		//print_r($str);die;
		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid))->select();
		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid))->select();
		$list_arr =array();
		$i=0;
		foreach($list as $v){
			$list[$i]['value']= explode("|",$v['value']);
			$i++;
		}
		//print_r($list);die;

		$text=$data['fieldsigle'];
		$down=$data['fielddownload'];
		$text=substr($text,1);
		$down=substr($down,1);
		$text=explode('$',$text);
		$down=explode('$',$down);
		$detail=array();
		$i=1;
		foreach($text as $v){
			$detail['text'][$i]=explode('#',$v);
			$i++;
		}
		$i=1;
		foreach($down as $v){
			$detail['down'][$i]=explode('#',$v);	
		}
		//print_r($detail);die;

		$this->assign('detail', $detail);
		
		$this->assign('str', $str);
		$this->assign('arr',$arr);
		$this->assign('list',$list);
		$this->assign('list_arr',$list);
		$this->assign('data', $data);
		$this->assign('info', $info);
		$this->display();
	}
	
	//修改订单
	public function runSet(){
	
		$id = $_GET['id']; 
		if(IS_POST){
			$url = U($this->type.'/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
			$url = substr($url,1);
			$where = array(
				'id' =>$id
			);
			if($this->yuyue_order->where($where)->save($_POST)!==false){
				$json = array(
					'error'=> 1,
					'msg'=> '修改成功！',
					'url'=> $url
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'error'=> 0,
					'msg'=> '修改失败！',
					'url'=> $url
				);
				echo  json_encode($json);
			}
		}
		
	}
	
	//删除订单
	public function del(){
		if(IS_POST){
			$url = U($this->type.'/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
			$url = substr($url,1);
			$where = array(
				'id' =>$_POST['id']
			);
			if($this->yuyue_order->where($where)->delete()){
				$json = array(
					'error'=> 1,
					'msg'=> '删除成功！',
					'url'=> $url
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'error'=> 0,
					'msg'=> '删除失败！',
					'url'=> $url
				);
				echo  json_encode($json);
			}
		}
	}
	
}


?>