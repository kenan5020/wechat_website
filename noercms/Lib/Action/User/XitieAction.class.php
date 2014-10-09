<?php
class XitieAction extends UserAction{
	public function index(){
		$db=D('Xitie');
		//$where['uid']=session('uid');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('taxis ASC')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('list',$info);	
		$this->display();
		
	}	
	public function add(){
	    $token	  =  $this->_get('token');
	    $uid=intval($_GET['id']);
		if(IS_POST){			
			$data=D('Xitie');
			$_POST['token']=session('token');		
			if($data->create()!=false){				
				if($id=$data->add()){
					$data1['pid']=$id;
					$data1['module']='Xitie';
					$data1['token']=session('token');
					$data1['keyword']=$_POST['keyword'];
					M('Keyword')->add($data1);
					$this->success('添加成功',U('Xitie/index'));
				}else{
					$this->error('服务器繁忙,请稍候再试');
				}
			}else{
				$this->error($data->getError());
			}
		}else{
			$this->assign('Token',$token);
		    $this->assign('uid',$uid);
			$this->display();
		}
		
	}	
	public function set(){
		if(IS_POST){
			$data=D('Xitie');
		    $token	  =  $this->_get('token');
	        $uid=intval($_GET['id']);
			$_POST['id']=$this->_get('id');
			$_POST['token']=session('token');
			$where=array('id'=>$_POST['id'],'token'=>$_POST['token']);			
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($data->create()){				
				if($id=$data->where($where)->save($_POST)!==false){
					$data1['pid']=$_POST['id'];
					$data1['module']='Xitie';
					$data1['token']=session('token');
					$da['keyword']=$_POST['keyword'];
					M('Keyword')->where($data1)->save($da);
					$this->success('修改成功');
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($data->getError());
			}
			
		}else{
			$id=$this->_get('id');
			$where=array('id'=>$id,'token'=>session('token'));
			$data=M('Xitie');
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			$xitie=$data->where($where)->find();		
			$this->assign('xitie',$xitie);
		    $this->assign('Token',$token);
		    $this->assign('uid',$uid);
			$this->display();
		}
	}
	public function delete(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data=M('Xitie');
		$check=$data->where($where)->find();
		if($check==false)$this->error('非法操作');
		$back=$data->where($wehre)->delete();
		if($back==true){
			M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Xitie'))->delete();
			$this->success('删除成功');
		}else{
			$this->error('操作失败');
		}
	}

	public function zhufu(){
		$token	  =  $this->_get('token');
		$uid 	  = $this->_get('id');	
		$db=D('Xitiebbs');
		$where['uid']=$uid;
		$where['token']=session('token');
		$where['type']='2';
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->assign('Token',$token);
		$this->assign('uid',$uid);
		$this->display();

	}
	
   public function fuyan(){
		$token	  =  $this->_get('token');
		$uid 	  = $this->_get('id');	
		$db=D('Xitiebbs');
		$where['uid']=$uid;
		$where['token']=session('token');
		$where['type']='1';
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->assign('Token',$token);
		$this->assign('uid',$uid);
		$this->display();

	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=$this->_get('uid','intval');
		if(D('Xitiebbs')->where($where)->delete()){
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}
	}
	
}



?>