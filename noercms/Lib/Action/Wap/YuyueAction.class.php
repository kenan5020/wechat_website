<?php
//wap
class YuyueAction extends BaseAction{
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
		

	}

	
	//预约列表
	public function index(){
		$where = array('token'=> $this->_get('token'));
		$pid = $this->_get('id');
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);

		$data = $this->Yuyue_model->where($where)->find();
		$data['count'] = $this->yuyue_order->where($cast)->count();
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$wap= M('setinfo')->where(array('token'=> $this->token,'type'=>'yuyue','pid'=>$pid))->select();
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
		$arr= M('setinfo')->where(array('token'=>$this->token,'kind'=>'3','type'=>'yuyue','pid'=>$pid))->select();
		$list= M('setinfo')->where(array('token'=>$this->token,'kind'=>'4','type'=>'yuyue','pid'=>$pid))->select();
		$list_arr =array();
		$i=0;
		foreach($list as $v){
			$list[$i]['value']= explode("|",$v['value']);
			$i++;
		}
		//print_r($data);die;
		
		$this->assign('str', $str);
		$this->assign('arr',$arr);
		$this->assign('list',$list);
		$this->assign('list_arr',$list);
		$this->assign('data', $data);
		$this->display();
	}
	
	//添加订单
	public function add(){
		//print_r($_POST());die;
		if(IS_POST){
			$url = U('Yuyue/order',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']));
			if($this->yuyue_order->add($_POST)){
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
					'url'=> U('Yuyue/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']))
				);
				echo  json_encode($json);
			}
		}
	}
	
	//订单列表
	public function order(){
		$token = $this->_get('token');
		$wecha_id = $this->_get('wecha_id');
		$where = array(
			'wecha_id'=> $wecha_id
		);
		$data = $this->yuyue_order->where($where)->select();
		
		$this->assign('data',$data);
		$this->display();
	}
	
	//修改订单视图
	public function set(){
		$id = $this->_get('id');
		$pid = $this->_get('pid');
		$data = M('yuyue_order')->find($id);
		$data['pid'] = $pid;
		$data['id'] = $id;
		$this->assign('data',$data);
		$this->display();
	}
	
	//修改订单
	public function runSet(){
	
		$id = $_GET['id']; 
		if(IS_POST){
			//$url = U('Yuyue/set',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'pid'=>$_POST['pid'],));
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
			//$url = U('Yuyue/set',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'pid'=>$_POST['pid'],));
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