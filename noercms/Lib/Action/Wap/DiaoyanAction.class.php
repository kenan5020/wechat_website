<?php
//	wap

class DiaoyanAction extends BaseAction{

	public $token;
	public $wecha_id;
	public $diaoyan;
	public $diaoyan_timu;
	public $diaoyan_user;
	public $diaoyan_id;
	public $urlarr;
	public $user_id;
	
	public function __construct(){

		parent::__construct();	
		$this->token=$this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		
		$this->user_id = $this->_get('uid');
		$this->diaoyan_id = $this->_get('id');
		$this->diaoyan=M('diaoyan');
		$this->diaoyan_timu=M('diaoyan_timu');
		$this->diaoyan_user=M('diaoyan_user');
		$this->urlarr =array(
			'token'=>$this->token, 
			'wecha_id'=> $this->wecha_id, 
			'id'=> $this->diaoyan_id,
			'uid'=> $this->user_id
		);
		
		$this->assign('token',$this->token);
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('urlarr',$this->urlarr);
		$this->assign('diaoyan_id',$this->diaoyan_id);
		
		
		
	}
	
	//调研开始界面
	public function index(){
		$where = array(
			'id'=> $this->diaoyan_id,
		);
		$field = array(
			'sinfo',
			'title'
		);
		$data = $this->diaoyan->field($field)->where($where)->find();
		
		$this->assign('data', $data);
		$this->display();
	}
	
	//调研个人信息获取
	public function name(){
		if(IS_POST){
			if($user_id = $this->diaoyan_user->add($_POST)){
				$urlarr = $this->urlarr;
				$urlarr['uid'] = $user_id;
				$urlarr['p'] = 1;
				$url = U("Diaoyan/set",$urlarr);
				$json = array(
					'success'=> true,
					'url'=> $url 
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'success'=> false,
				);
				echo  json_encode($json);
			}
		}else{
			$this->display();
		}
		
	}
	
	//调研题目提交
	public function set(){
	//ajax不实例化类
		$where = array(
			'pid'=> $this->diaoyan_id,
		);
		$count = $this->diaoyan_timu->where($where)->count();
		if(IS_POST){
			$urlarr = array();
			$urlarr['token'] = $_GET['token'];
			$urlarr['wecha_id'] = $_GET['wecha_id'];
			$urlarr['uid'] = $_GET['uid'];
			$urlarr['id'] = $_GET['id'];
			$urlarr['p'] =$_GET['p']+1;
			
			if($urlarr['p']>$count){
				$urlarr['p'] ='';
				$url = U("Diaoyan/Comment",$urlarr);
			}else{
				$url = U("Diaoyan/set", $urlarr);
			}
			
			if($_POST['ans']){
				$arr = array(
					'tid'=>$_POST['qid']
				);
				$ansArr = explode(',',$_POST['ans']);
				foreach($ansArr as $v){
					switch ($v){
						case 1:
							$this->diaoyan_timu->where($arr)->setInc('perca',1);
							break;
						case 2:
							$this->diaoyan_timu->where($arr)->setInc('percb',1);
							break;
						case 3:
							$this->diaoyan_timu->where($arr)->setInc('percc',1);
							break;
						case 4:
							$this->diaoyan_timu->where($arr)->setInc('percd',1);
							break;
						case 5:
							$this->diaoyan_timu->where($arr)->setInc('perce',1);
							
					}
				}
				echo $url;
			}else{
				echo 'fales';
			}
		}else{
			//pid是调研id
			$where = array(
				'pid'=> $this->diaoyan_id,
			);
			
			//获取对应调研的题目的总数
			
			$page = new Page($count,1);
			$show = $page->show();	
			
			//每次输出一条题目
			$data = $this->diaoyan_timu->where($where)->limit($page->firstRow.','.$page->listRows)->select();
			
			$this->p = $_GET['p'];
			$this->uid = $this->user_id;
			$this->assign('page',$show);
			$this->assign('info', $data);
			$this->display();	
		}
		

	}
	
	//调研建议采集
	public function Comment(){
		$where = array(
			'id'=> $this->diaoyan_id,
		);
		$field = array(
			'title',
		);
		$data = $this->diaoyan->field($field)->where($where)->find();
		
		$this->assign('data', $data);
		$this->display();
	}
	
	//调研结束
	public function end(){
		// dump($_POST);die;
		$where = array(
				'id'=> $this->diaoyan_id,
		);
		$field = array(
				'einfo',
				'title',
				'stime',
				'etime'
		);
		$data = $this->diaoyan->field($field)->where($where)->find();
		$this->diaoyan_user->where(array('id'=>$_GET['uid']))->save($_POST);
		$this->assign('data', $data);
		$this->display();
	}
	
	//预约列表
	// public function index(){
		// $where = array('token'=> $this->_get('token'), 'id'=>$this->_get('id'));

		// $cast = array(
			// 'token'=> $this->_get('token'),
			// 'wecha_id'=> $this->_get('wecha_id')
		// );

		// $data = $this->Yuyue_model->where($where)->find();
		// $data['count'] = $this->yuyue_order->where($cast)->count();
		// $data['token'] = $this->_get('token');
		// $data['wecha_id'] = $this->_get('wecha_id');
		// $this->assign('data', $data);
		// $this->display();
	// }
	
	// //添加订单
	// public function add(){ 		
		
		// if(IS_POST){
			// $url = U('Yuyue/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']));
			// if($this->yuyue_order->add($_POST)){
				// $json = array(
					// 'error'=> 1,
					// 'msg'=> '添加成功！',
					// 'url'=> $url
				// );
				// echo  json_encode($json);
			// }else{
				// $json = array(
					// 'error'=> 0,
					// 'msg'=> '添加失败！',
					// 'url'=> $url
				// );
				// echo  json_encode($json);
			// }
		// }
	// }
	
	// //订单列表
	// public function order(){
		// $token = $this->_get('token');
		// $wecha_id = $this->_get('wecha_id');
		// $where = array(
			// 'wecha_id'=> $wecha_id
		// );
		// $data = $this->yuyue_order->where($where)->select();
		// $this->assign('data',$data);
		// $this->display();
	// }
	
	// //修改订单视图
	// public function set(){
		// $id = $this->_get('id');
		// $pid = $this->_get('pid');
		// $data = M('yuyue_order')->find($id);
		// $data['pid'] = $pid;
		// $data['id'] = $id;
		// $this->assign('data',$data);
		// $this->display();
	// }
	
	// //修改订单
	// public function runSet(){
	
		// $id = $_GET['id']; 
		// if(IS_POST){
			// $url = U('Yuyue/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']));
			// if($this->yuyue_order->add($_POST)){
				// $json = array(
					// 'error'=> 1,
					// 'msg'=> '添加成功！',
					// 'url'=> $url
				// );
				// echo  json_encode($json);
			// }else{
				// $json = array(
					// 'error'=> 0,
					// 'msg'=> '添加失败！',
					// 'url'=> $url
				// );
				// echo  json_encode($json);
			// }
		// }
		
	// }
	
	// //删除订单
	// public function del(){
		// if(IS_POST){
			// //$url = U('Yuyue/set',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'pid'=>$_POST['pid'],));
			// $where = array(
				// 'id' =>$_POST['id']
			// );
			// if($this->yuyue_order->where($where)->delete()){
				// $json = array(
					// 'error'=> 1,
					// 'msg'=> '删除成功！',
					// 'url'=> $url
				// );
				// echo  json_encode($json);
			// }else{
				// $json = array(
					// 'error'=> 0,
					// 'msg'=> '删除失败！',
					// 'url'=> $url
				// );
				// echo  json_encode($json);
			// }
		// }
	// }
	
}


?>