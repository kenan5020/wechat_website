<?php
class HekaAction extends BaseAction{
	public $token;
	public $Heka;
	public $wecha_id;
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
		$this->Heka=M('heka');
		

	}

	public function index(){
		
		$id= $this->_get('id');
		$where = array('id'=>$id);
		$data = $this->Heka->where($where)->find();
		//print_r($data);die;
		if($data){
			$this->Heka->where(array('id'=>$id))->setInc('see');
		}
		$this->assign('data', $data);
		$this->display();
	}
	public function get(){
		//print_r($_GET);die;
		if(IS_GET){
			$id = $_GET['id'];
			$data=$this->Heka->where(array('id'=>$id))->field('id,bg_topic,bg_music,banquan,sub,forwards,title,see')->find();
			if($data){
				$this->Heka->where(array('id'=>$id))->setInc('see');
			}
			if($_GET['from']=='app'){
				$this->Heka->where(array('id'=>$id))->setInc('forwards');
			}
			$data['name'] = $_GET['name'];
			$data['content'] = $_GET['info'];
			$data['bg_action'] = $_GET['bg_action'];
			$this->assign('data', $data);
			$this->display('index');
		}
	
	}

}
?>