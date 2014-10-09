<?php
class WifiAction extends UserAction{
	public function _initialize() {
		parent::_initialize();
		$function=M('Function')->where(array('funname'=>'wifi'))->find();
		//$this->canUseFunction('wifi');
	}
	//Wifi配置
	public function index(){
		$wifi=M('wifi');
		$where['token']=session('token');
		$count=$wifi->where($where)->count();
		$page=new Page($count,25);
		$list=$wifi->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('wifi',$list);
		$this->display();
	}
	public function add(){
		if(IS_POST){			$_POST['token']=session('token');
			$_POST['time']=strtotime($this->_post('time'));
			$this->all_insert('Wifi','/index');
		}else{
			$this->display();
		}
	}
	public function edit(){
		$wifi=M('wifi')->where(array('token'=>session('token'),'id'=>$this->_get('id','intval')))->find();
		if(IS_POST){
			$_POST['time']=strtotime($this->_post('time'));
			$_POST['id']=$wifi['id'];
			$keyword_model=M('Keyword');
			$keyword_model->where(array('token'=>$this->token,'pid'=>$wifi['id'],'module'=>'wifi'))->save(array('keyword'=>$_POST['keyword']));
			$this->all_save('Wifi','/index');	
		}else{
			$this->assign('wifi',$wifi);
			$this->display('add');
		}
	
	}

	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['token']=session('token');
		if(D('wifi')->where($where)->delete()){
			$keyword_model=M('Keyword');
            $keyword_model->where(array('token'=>$this->token,'pid'=>$this->_get('id','intval'),'module'=>'wifi'))->delete();
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
}



?>