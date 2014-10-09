<?php
class HekaAction  extends UserAction{
	public $Heka;
	public $token;
	public function _initialize() {
		parent::_initialize();	
		
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'api')){$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));}
		
		$this->Heka = M('heka');
		$this->token=session('token');
		$this->assign('token',$this->token);
	}
	public function index(){
		$url=$_SERVER['SERVER_NAME'];
		$count      = $this->Heka->count();
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$where=array('token'=>$this->token);
		$data = $this->Heka->where($where)->order('id desc')->select();
		foreach($data as $k=>$v){
			if($v['show']== 0 ){
				$data[$k]['forwards'] ="不显示";
			}
		}
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->assign('url',$url);
		$this->display();
	}
	public function add(){
		
		$_POST['token'] = $this->token;
		//print_r($_POST);die;
		if(IS_POST){
			if(empty($_POST['sub'])){
				$_POST['sub'] = "转发贺卡";
			}
			if($id=$this->Heka->add($_POST)){
				$keyword_model=M('Keyword');
				$key = array(
					'keyword'=>$_POST['keyword'],
					'pid'=>$id,
					'token'=>$this->token,
					'module'=>'Heka'
				);
				$keyword_model->add($key);
				$this->success('添加成功！',U('Heka/index',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！',U('Heka/index',array('token'=>$this->token)));
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('set');
		}
	}
	public function set(){
		$id = intval($this->_get('id'));
		$checkdata = $this->Heka->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Heka/add'));
        }
		if(IS_POST){ 
            $id = $this->_post('id');
			$where=array('id'=>$id,'token'=>$this->token);
			$check=$this->Heka->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Heka->create()){
				if($this->Heka->where($where)->save($_POST)!==false){
					
					$keyword_model=M('Keyword');
					$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Heka'))->save(array('keyword'=>$_POST['keyword']));
					$this->success('修改成功',U('Heka/index',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Heka->getError());
			}
		}else{
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	public function del(){
		if($this->_get('token')!=$this->token){
			$this->error('非法操作!');
		}
        $id = intval($this->_get('id'));
        if(IS_GET){
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Heka->where($where)->find();
            if($check==false)$this->error('非法操作');
            $back = $this->Heka->where($where)->delete();
			if($back==true){
				$this->success('操作成功',U('Heka/index',array('token'=>$this->token)));
			}else{
				$this->error('服务器繁忙,请稍后再试',U('Heka/index',array('token'=>$this->token)));
			}
			
        }
	}
	
}

?>