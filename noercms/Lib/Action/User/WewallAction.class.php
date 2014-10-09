<?php
/**
 *互动微信墙 Written by leohoko
**/
class WewallAction extends UserAction{
	public function index(){
		$db=D('Wewall');
		$where['token']=session('token');
		$where['isact']=2;
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('createtime desc')->limit($page->firstRow.','.$page->listRows)->select();
		$where['isact']=array('neq',2);
		$actinfo=$db->where($where)->find();
		if($actinfo!==false)
		$this->assign('actinfo',$actinfo);
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	public function change()
	{
		
		if ($this->_get('actid','intval')==0)
		$data['isact'] = 1;
		elseif($this->_get('actid','intval')==1){
		$data['isact'] = 0;
		}
		elseif($this->_get('actid','intval')==2)
		{
			$data['isact'] = 2;
			$data['endtime'] = time();
			M('Wewalllog')->where(array('token'=>session('token')))->delete();
		}
		$db=M('Wewall');
		$where['token']=session('token');
		$where['id']=$this->_get('id','intval');
		$result = $db->where($where)->save($data);
		if($result!==false){$this->success('修改成功',U('Wewall/index',array('token'=>session('token'))));}
	}
	
	public function add(){
		$db=M('Wewall');
		$where['token']=session('token');
		$where['isact']=array('neq',2);
		$exst=$db->where($where)->select();
		if($exst!=false){$this->error('已存在已激活的活动',U('Wewall/index',array('token'=>session('token'))));}
		else
		$this->display();
	}
	
	public function edit()
	{
		$db=M('Wewall');
		$where['token']=session('token');
		$where['id']=$this->_get('id','intval');
		$info=$db->where($where)->find();
		$this->assign('info',$info);
		$this->display();
	}
	
	public function show()
	{
		$exs=M('Wewall')->where(array('id'=>$this->_get('id','intval'),'token'=>session('token')))->find();
		if($exs!==false){
			$exs['step']=1;
			if($exs['marklog']!=NULL){
				$exs['step']=2;
				$mark=explode(",",$exs['marklog']);
				foreach($mark as $key=>$value){
					if(substr($value,0,1)=='1'){
						$exs['bonu1']=intval($exs['bonu1'])-1;
						}
					elseif	(substr($value,0,1)=='2'){
						$exs['bonu2']=intval($exs['bonu2'])-1;
						}
					elseif	(substr($value,0,1)=='3'){
						$exs['bonu3']=intval($exs['bonu3'])-1;
						}
					}
				}
			$this->assign('info',$exs);
		}
		$this->display();
	}
	
	public function sentMessage()
	{
		$uid=$this->_post('uid');
		$result=M('Wewalllog')->field('content')->where(array('token'=>$this->_post('token'),'uid'=>$uid,'ifsent'=>'0','ifcheck'=>'1'))->order('updatetime desc')->select();
		M('Wewalllog')->where(array('token'=>$this->_post('token'),'uid'=>$uid,'ifsent'=>'0','ifcheck'=>'1'))->save(array('ifsent'=>'1'));
		$json_string=json_encode($result);
		echo $json_string;	
		}
	public function contralGame()
	{
		if($this->_post('act')=='parse')
		{
			M('Wewall')->where(array('token'=>$this->_post('token'),'id'=>$this->_post('id')))->save(array('isact'=>'0'));
			$result=M('Wewalllog')->field('sncode')->where(array('token'=>$this->_post('token'),'uid'=>$this->_post('id'),'ifsent'=>'1','ifcheck'=>'1'))->select();
			echo json_encode($result);
		}
		elseif($this->_post('act')=='go')
		{
			M('Wewall')->where(array('token'=>$this->_post('token'),'id'=>$this->_post('id')))->save(array('isact'=>'1'));
		}
	}
	public function insert()
	{
		$this->all_insert();
	}
	
	public function upsave(){
		$this->all_save();
	}
	public function delold(){
	   	$where['id']=$this->_get('id','intval');
		$a=M('Wewall')->where($where)->delete();
		$b=M('Wewalllog')->where(array('uid'=>$this->_get('id','intval')))->delete();
		if($a && $b){
			
			$this->success('操作成功',U('Wewall'.'/index'));
		}else{
			$this->error('上墙数据未发现或发生删除错误',U('Wewall'.'/index'));
		}
	}	
	
	public function sentcheck(){
		$uid=$this->_post('uid');
		$result=M('Wewalllog')->field('content,id')->where(array('token'=>session('token'),'uid'=>$uid,'ifscheck'=>'0','ifcheck'=>'0'))->order('updatetime desc')->select();
		M('Wewalllog')->where(array('token'=>session('token'),'uid'=>$uid,'ifscheck'=>'0','ifcheck'=>'0'))->save(array('ifscheck'=>'1'));
		$json_string=json_encode($result);
		echo $json_string;	
	}
	public function gocheck(){
		$uid=$this->_get('id');
		$info=M('Wewalllog')->field('content,id')->where(array('token'=>$this->_get('token'),'uid'=>$uid,'ifcheck'=>'0'))->order('updatetime desc')->select();
		$this->assign('info',$info);
		$this->assign('id',$uid);
		$this->display();
		}
		
	public function passlog(){
		M('Wewalllog')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->save(array('ifcheck'=>'1'));
	}
	
	public function dellog(){
		M('Wewalllog')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->save(array('ifsent'=>'1'));
	}
	
	public function savemark(){
		$result=M('Wewall')->field('marklog')->where(array('token'=>$this->_post('token'),'id'=>$this->_post('id')))->find();
		if($result['marklog']==NULL){
			$yu['marklog']=$this->_post('num')."+".$this->_post('sncode');
			}
		else{
			$yu['marklog']=$result['marklog'].",".$this->_post('num')."+".$this->_post('sncode');
			}
		M('Wewall')->where(array('token'=>$this->_post('token'),'id'=>$this->_post('id')))->save($yu);
	}
	
	public function result(){
		$result=M('Wewall')->field('marklog')->where(array('token'=>$this->_get('token'),'id'=>$this->_get('id')))->find();
		if($result['marklog']!==NULL){
			$mark=explode(",",$result['marklog']);
			foreach($mark as $key=>$value)
			{
				$tmplist=explode('+',$value);
				if($tmplist)
				$point[]=array($tmplist[0],$tmplist[1]);		
			}
			$this->assign('point',$point);		
		}
		//echo $point;
		$this->display();
	}
}
?>