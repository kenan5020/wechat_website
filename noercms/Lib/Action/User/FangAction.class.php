<?php
class FangAction extends BaseAction{
	public $token;
	public $Fang_model;
	public $Fang_zi;
	public $Fang_dianping;
	public $Fang_photo;
	public $Fang_hu;
	public $Fang_effect;
	protected $Fang_yuyue;
	protected $Fang_yuyue_order;
	protected $type;
	public function _initialize() {
		parent::_initialize();
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'Fang')){
            	$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
		}

		$this->Fang_model=M('fang');
		$this->Fang_zi = M('fang_zi');
		$this->Fang_dianping = M('fang_dianping');
		$this->Fang_photo = M('fang_photo');
		$this->Fang_hu = M('fang_hu');
		$this->Fang_effect = M('fang_effect');
		$this->Fang_yuyue = M('yuyue');
		$this->Fang_yuyue_order=M('yuyue_order');
		$this->type='Fang';
		$this->token=session('token');
		$this->assign('token',$this->token);
		$this->assign('module','Fang');
		$this->assign('type',$this->type);
		
	}
	//楼盘简介主页
	public function index(){
		//print_r($_POST);die;
		$_POST['token'] = $this->token;
		$checkdata = $this->Fang_model->where(array('token'=>$_POST['token']))->find();
		if(IS_POST){
				$id=$_POST['id'];
				$where=array('id'=>$id,'token'=>$_POST['token']);
				if($this->Fang_model->where($where)->save($_POST)!==false){
					
					$wh=array('token'=>$this->token,'pid'=>$id,'module'=>'Fang');
					//print_r($wh);die;
					
					$keyword_model=M('Keyword');
					$keyword_model->where($wh)->save(array('keyword'=>$_POST['keyword']));
					$this->success('修改成功!',U('Fang/index',array('token'=>$this->token)));
				}else{
					$check = $this->Fang_model->where(array('token'=>$_POST['token']))->find();
					if(empty($check)){
						$id = $this->Fang_model->add($_POST);
						$keyword_model=M('Keyword');
						
						$key = array(
							'keyword'=>$_POST['keyword'],
							'pid'=>$id,
							'token'=>$this->token,
							'module'=> 'Fang'
							);
						
						$keyword_model->add($key);

						$this->success('添加成功!',U('Fang/index',array('token'=>$this->token)));
						}else{
							$this->error('操作失败');
						}
				//echo '0022';die;
				}

		}else{
			$this->assign('isUpdate',1);
			
			$this->assign('set',$checkdata);
			$this->display();
		}
	}
	//子楼盘管理主页
	public function zindex(){
		$where = array('token'=> $this->token);
		$count = $this->Fang_zi->where($where)->count();
		//echo $count;die;
		$Page       = new Page($count,10);
		$show       = $Page->show();
		$data = $this->Fang_zi->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('show_order desc')->select();
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	}
	//添加子楼盘
	public function add(){
		$_POST['token'] = $this->token;
		$pid = $this->Fang_model->where(array('token'=>$this->token))->field('id')->find();
		$_POST['pid'] = $pid['id'];
		if(IS_POST){
			if($this->Fang_zi->add($_POST)){
				$this->success('添加成功！',U('Fang/zindex',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('zset');
		}
	}
	//删除子楼盘
	public function del(){
		if($this->_get('token')!=$this->token){
			echo'000';die;
			$this->error('非法操作!');
		}
        $id = intval($this->_get('id'));
        if(IS_GET){                            
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Fang_zi->where($where)->find();
            if($check==false)$this->error('非法操作');
            $back = $this->Fang_zi->where($where)->delete();
			if($back==true){
				$this->success('操作成功',U('Fang/zindex',array('token'=>$this->token)));
			}else{
				$this->error('服务器繁忙,请稍后再试',U('Fang/index',array('token'=>$this->token)));
			}
			
        }
	}
	//修改子楼盘
	public function set(){
		$id = intval($this->_get('id')); 
		$checkdata = $this->Fang_zi->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Fang/zadd',array('token'=>$this->token)));
        }	
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Fang_zi->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Fang_zi->create()){
				if($this->Fang_zi->where($where)->save($_POST)!==false){
					$this->success('修改成功',U('Fang/zindex',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Fang_zi->getError());
			}
		}else{
		
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display('zset');	
		
		}
	}
	//楼盘户型显示列表
	public function hu_index(){
		
		$where = array('token'=> $this->token);
		$count = $this->Fang_hu->where($where)->count();
		$Page       = new Page($count,10);
		$show       = $Page->show();
		$data = $this->Fang_hu->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	}
	//楼盘户型添加
	public function hu_add(){
		$_POST['token'] = $this->token;
		$pid = $this->Fang_model->where(array('token'=>$this->token))->field('id')->find();
		$_POST['pid'] = $pid['id'];
		$arr=$this->Fang_zi->where(array('token'=>$this->token))->field('id,name')->select();
		$this->assign('arr',$arr);
		//print_r($_POST);die;
		
		if(IS_POST){
			
			if($this->Fang_hu->add($_POST)){
				$this->success('添加成功！',U('Fang/hu_index',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$su=array(1,2,3,4,5);
			$this->assign('su',$su);
			$this->assign('set',$set);
			$this->display('hu_set');
		}
	}
	//楼盘户型修改
	public function hu_set(){
		$id = intval($this->_get('id'));
		$checkdata = $this->Fang_hu->where(array('id'=>$id))->find();
		
		$arr=$this->Fang_zi->where(array('token'=>$this->token))->field('id,name')->select();
		$this->assign('arr',$arr);
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Fang/hu_add'));
        }	
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Fang_hu->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Fang_hu->create()){
				if($this->Fang_hu->where($where)->save($_POST)!==false){
					$this->success('修改成功',U('Fang/hu_index',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Fang_hu->getError());
			}
		}else{
			$su=array(1,2,3,4,5);
			$this->assign('su',$su);
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display();
		
		}
	}
	//楼盘户型删除
	public function hu_del(){
		if($this->_get('token')!=$this->token){
			$this->error('非法操作!');
		}
        $id = intval($this->_get('id'));
        if(IS_GET){                            
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Fang_hu->where($where)->find();
            if($check==false)$this->error('非法操作');
            $back = $this->Fang_hu->where($where)->delete();
			if($back==true){
				$this->success('操作成功',U('Fang/hu_index',array('token'=>$this->token)));
			}else{
				$this->error('服务器繁忙,请稍后再试',U('Fang/hu_index',array('token'=>$this->token)));
			}
			
        }
	}
		//专家点评显示列表
	public function dianping_index(){

		$where = array('token'=> $this->token);
		$count = $this->Fang_dianping->where($where)->count();
		
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = $this->Fang_dianping->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('show_order desc')->select();
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	}
	//专家点评添加
	public function dianping_add(){
		$_POST['token'] = $this->token;
		$pid = $this->Fang_model->where(array('token'=>$this->token))->field('id')->find();
		$_POST['pid'] = $pid['id'];
		if(IS_POST){
			if($this->Fang_dianping->add($_POST)){
				$this->success('添加成功！',U('Fang/dianping_index',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('dianping_set');
		}
	}
	//专家点评修改
	public function dianping_set(){
		$id = intval($this->_get('id')); 
		$checkdata = $this->Fang_dianping->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Fang/dianping_add'));
        }	
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Fang_dianping->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Fang_dianping->create()){
				if($this->Fang_dianping->where($where)->save($_POST)!==false){
					$this->success('修改成功',U('Fang/dianping_index',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Fang_dianping->getError());
			}
		}else{
		
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	//专家点评删除
	public function dianping_del(){
		if($this->_get('token')!=$this->token){
			$this->error('非法操作!');
		}
        $id = intval($this->_get('id'));
        if(IS_GET){                            
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Fang_dianping->where($where)->find();
            if($check==false)$this->error('非法操作');
            $back = $this->Fang_dianping->where($where)->delete();
			if($back==true){
				$this->success('操作成功',U('Fang/dianping_index',array('token'=>$this->token)));
			}else{
				$this->error('服务器繁忙,请稍后再试',U('Fang/dianping_index',array('token'=>$this->token)));
			}
			
        }
	}

	//房友印象显示列表
	public function effect_index(){

		$where = array('token'=> $this->token);
		$count = $this->Fang_effect->where($where)->count();
		
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = $this->Fang_effect->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('show_order desc')->select();
		foreach($data as $key=> $val){
			if($val['show']==1){	
				$data[$key]['show']='显示';
			}else{
				$data[$key]['show']='不显示';
			}
		}
		//print_r($data);die;
		$this->assign('page',$show);
		$this->assign('data',$data);

		$this->display();
	}
	//房友印象添加
	public function effect_add(){
		$_POST['token'] = $this->token;
		$pid = $this->Fang_model->where(array('token'=>$this->token))->field('id')->find();
		$_POST['pid'] = $pid['id'];
		if(IS_POST){
			if($this->Fang_effect->add($_POST)){
				$this->success('添加成功！',U('Fang/effect_index',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('effect_set');
		}
	}
	//房友印象修改
	public function effect_set(){
		$id = intval($this->_get('id')); 
		$checkdata = $this->Fang_effect->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Fang/effect_add'));
        }	
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Fang_effect->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Fang_effect->create()){
				if($this->Fang_effect->where($where)->save($_POST)!==false){
					$this->success('修改成功',U('Fang/effect_index',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Fang_effect->getError());
			}
		}else{
		
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	//房友印象删除
	public function effect_del(){
		if($this->_get('token')!=$this->token){
			$this->error('非法操作!');
		}
        $id = intval($this->_get('id'));
        if(IS_GET){                            
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Fang_effect->where($where)->find();
            if($check==false)$this->error('非法操作');
            $back = $this->Fang_effect->where($where)->delete();
			if($back==true){
				$this->success('操作成功',U('Fang/effect_index',array('token'=>$this->token)));
			}else{
				$this->error('服务器繁忙,请稍后再试',U('Fang/effect_index',array('token'=>$this->token)));
			}
			
        }
	}

	//楼盘相册显示列表
	public function photo_index(){
		
		$where = array('token'=> $this->token);
		$count = $this->Fang_photo->where($where)->count();
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = $this->Fang_photo->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('show_order desc')->select();
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	}
	//楼盘相册添加
	public function photo_add(){
		
		$_POST['token'] = $this->token;
		$pid = $this->Fang_model->where(array('token'=>$this->token))->field('id')->find();
		
		$_POST['pid'] = $pid['id'];
		//print_r($_POST);die;
		if(IS_POST){
			if($this->Fang_photo->add($_POST)){
				$this->success('添加成功！',U('Fang/photo_index',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('photo_set');
		}
	}
	//楼盘相册修改
	public function photo_set(){

		$id = intval($this->_get('id')); 
		$checkdata = $this->Fang_photo->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Fang/photo_add'));
        }	
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Fang_photo->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Fang_photo->create()){
				if($this->Fang_photo->where($where)->save($_POST)!==false){
					$this->success('修改成功',U('Fang/photo_index',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Fang_photo->getError());
			}
		}else{
		
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	//楼盘相册删除
	public function photo_del(){
		if($this->_get('token')!=$this->token){
			$this->error('非法操作!');
		}
        $id = intval($this->_get('id'));
        if(IS_GET){                            
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Fang_photo->where($where)->find();
            if($check==false)$this->error('非法操作');
            $back = $this->Fang_photo->where($where)->delete();
			if($back==true){
				$this->success('操作成功',U('Fang/photo_index',array('token'=>$this->token)));
			}else{
				$this->error('服务器繁忙,请稍后再试',U('Fang/photo_index',array('token'=>$this->token)));
			}
			
        }
	}
	//预约列表
	public function yuyue_index(){
		$where = array('token'=> $this->token,'type'=>$this->type);//2013-12-21
		$count      = $this->Fang_yuyue->where($where)->count();
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = $this->Fang_yuyue->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('type',$this->type);
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	
	}
	//添加预约
	public function yuyue_add(){
		
		$_POST['token'] = $this->token;
		$_POST['type']=$this->type;
		$lbs=M("Company")->where(array('token'=>$this->token))->select();
		//print_r($_POST);die;
		$arr=array();
		foreach($lbs as $v){
			$arr[$v['catid']]=array('catid'=>$v['catid'],'address'=>$v['address'],'phone'=>$v['tel'],'latitude'=>$v['latitude'],'longitude'=>$v['longitude']);
		}
		//print_r($arr);die;
		if(IS_POST){	
			if($_POST["lbs"]==1){
				$cid=$_POST['cid'];
				$_POST['phone']=$arr[$cid]['phone'];
				$_POST['address']=$arr[$cid]['address'];
				$_POST['longitude']=$arr[$cid]['longitude'];
				$_POST['latitude']=$arr[$cid]['latitude'];
				//print_r($_POST);die;
			}
			if($id = $this->Fang_yuyue->add($_POST)){
				$keyword_model=M('Keyword');
				$key = array(
					'keyword'=>$_POST['keyword'],
					'pid'=>$id,
					'token'=>$this->token,
					'module'=> $this->type
				);
				$keyword_model->add($key);
				$this->success('添加成功！',U($this->type.'/yuyue_index',array('token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->assign('arr',$arr);
			$this->display('yuyue_set');
		}
		
	}
		//修改预约
	public function yuyue_set(){
		
        $id = intval($this->_get('id')); 
		$checkdata = $this->Fang_yuyue->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U($this->type.'/add'));
        }
		$lbs=M("Company")->where(array('token'=>$this->token))->select();
		$arr=array();
		foreach($lbs as $v){
			$arr[$v['catid']]=array('catid'=>$v['catid'],'address'=>$v['address'],'phone'=>$v['tel'],'latitude'=>$v['latitude'],'longitude'=>$v['longitude']);
		}
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Fang_yuyue->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Fang_yuyue->create()){
				if($_POST["lbs"]==1){
					$cid=$_POST['cid'];
					$_POST['phone']=$arr[$cid]['phone'];
					$_POST['address']=$arr[$cid]['address'];
					$_POST['longitude']=$arr[$cid]['longitude'];
					$_POST['latitude']=$arr[$cid]['latitude'];
				}
				//print_r($_POST);die;
				if($this->Fang_yuyue->where($where)->save($_POST)!==false){
					$this->success('修改成功',U($this->type.'/yuyue_index',array('token'=>$this->token,'pid'=>$this->_get('pid'))));
					$keyword_model=M('Keyword');
					$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>$this->type))->save(array('keyword'=>$_POST['keyword']));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Fang_yuyue->getError());
			}
		}else{
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->assign('arr',$arr);
			$this->assign('act',$id);
			$this->display();	
		
		}
	}
	//删除预约
	public function yuyue_del(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
			$wher=array('pid'=>$id,'token'=>$this->token);
            $check=$this->Fang_yuyue->where($where)->find();
            if($check==false)   $this->error('非法操作');
            $back=$this->Fang_yuyue->where($where)->delete();
            if($back==true){
				M('yuyue_order')->where($wher)->delete();
				M('setinfo')->where($wher)->delete();
            	M('Keyword')->where(array('token'=>$this->token,'pid'=>$id,'module'=>$this->type))->delete();
                $this->success('操作成功',U($this->type.'/yuyue_index',array('token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U($this->type.'/yuyue_index',array('token'=>$this->token)));
            }
        }        
	}
	//订单列表显示
	public function yuyue_infos(){
		$where = array('token'=> $this->token,'type'=>$this->type,'pid'=>$this->_get('id'));
		
		$count = $this->Fang_yuyue_order->where($where)->count();	
		$Page = new Page($count,20);
		$show = $Page->show();
		$data = $this->Fang_yuyue_order->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);
		$this->assign('data', $data);
		
		$this->display();
	
	}
	
	//订单详细信息
	public function yuyue_infos_detail(){
		$where = array('token'=> $this->token,'id'=>$this->_get('id'));
		$data = $this->Fang_yuyue_order->where($where)->order('id desc')->select();
		$info=$data[0]['fieldsigle'].$data[0]['fielddownload'];
		$info=substr($info,1);
		$info=explode('$',$info);
		$detail=array();
		foreach($info as $v){
			$detail['info'][]=explode('#',$v);	
		}
		$detail['all']=$data[0];

		$this->assign('detail', $detail);
		$this->display();
	}
	
	//删除订单
	public function yuyue_delinfos(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Fang_yuyue_order->where($where)->find();
            if($check==false)   $this->error('非法操作');
            $back=$this->Fang_yuyue_order->where($where)->delete();
            if($back==true){
                $this->success('操作成功',U($this->type.'/infos',array('token'=>$this->token,'id'=>$check['pid'])));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U($this->type.'/infos',array('token'=>$this->token,'id'=>$check['xid'])));
            }
        }        
	}
	
	//处理订单
	public function yuyue_setType(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
		$type = intval($this->_get('type'));
		$pid = intval($this->_get('pid'));
        if(IS_GET){                              
			$where = array(
				'id'=> $id,
				'token'=> $this->token,
			);
			$data = array(
				'type'=> $type
			);
			if($this->Fang_yuyue_order->where($where)->setField($data)){
				$this->success('修改成功！',U($this->type.'/infos',array('id'=>$pid,'token'=>$this->token)));
			}else{
				$this->error('修改失败！');
			}
        }
	}
	
	//类型设置
	public function setcin(){
		$id = $this->_get('id');
		$cin=M('yuyue_setcin');
		$data=$cin->where(array('type'=>$this->type,'pid'=>$id))->select();
		//print_r($data);die;
		$this->assign('id',$id);
		$this->assign('data',$data);
		$this->display();
	}
	
	//增加类型
	public function addcin(){
		$id = $this->_get('id');
		$cin=M('yuyue_setcin');
		$arr_hu = $this->Fang_hu->where(array('token'=>$this->token))->field('id,name')->select();
		if(IS_POST){
			$_POST['pid']=$id;
			$_POST['type']=$this->type;
			if($cin->add($_POST)){
				//print_r($_POST);die;
				$this->success('添加成功！',U($this->type.'/setcin',array('id'=>$id,'token'=>$this->token)));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$this->assign('arr_hu',$arr_hu);
			$this->assign('id',$id);
			$this->display();
		}
		
	}
	
	//修改类型
	public function updatecin(){
		$id = $this->_get('id');
		$pid = $this->_get('aid');
		$cin=M('yuyue_setcin');
		$arr_hu = $this->Fang_hu->where(array('token'=>$this->token))->field('id,name')->select();
		$data=$cin->where(array('id'=>$id))->find();
		
		if(IS_POST){
			//print_r($_POST);die;
			if($cin->where(array('id'=>$id))->save($_POST)!==false){
				$this->success('修改成功！',U($this->type.'/setcin',array('id'=>$pid,'token'=>$this->token)));
			}else{
				$this->error('修改失败！');
			}
		}else{
			$this->assign('arr_hu',$arr_hu);
			$this->assign('data',$data);
			$this->assign('id',$pid);
			$this->display('addcin');
		}
	}
	
	//删除类型
	public function delcin(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
		$id = intval($this->_get('id'));
		$pid = intval($this->_get('aid'));
		$cin=M('yuyue_setcin');

        if(IS_GET){                              
            $where=array('id'=>$id);
            $check=$cin->where($where)->find();
            if($check==false)   $this->error('非法操作');
            $back=$cin->where($where)->delete();
            if($back==true){
                $this->success('操作成功',U($this->type.'/setcin',array('id'=>$pid,'token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试');
            }
        }   
			
	}
		
	//订单设置
	 public function yuyue_setinfo(){ 
		$_POST['token'] = $this->token;
		$pid = $this->_get('id');
		//print_r($_POST);die;
		//$setinfo=M('setinfo');
		$setinfo=M('setinfo');
		$data=$setinfo->where(array('token'=>$this->token,'type'=>$this->type,'pid'=>$pid))->select();
		//$nums=$setinfo->where(array('token'=>$_GET["token"]))->count();
		$str=array();
		if(!empty($data)){
			foreach($data as $v){
				$str[$v["name"]]=$v["value"];
			}
		}else{
			$str=array("person" => 1 ,"phone" => 1 ,"date" => 1 ,"time" => 1,);
			$setinfo->add(array('token'=>$this->token,'name'=>'person','value'=>1,'kind'=>1,'type'=>$this->type,'pid'=>$pid));
			$setinfo->add(array('token'=>$this->token,'name'=>'phone','value'=>1,'kind'=>1,'type'=>$this->type,'pid'=>$pid));
			$setinfo->add(array('token'=>$this->token,'name'=>'date','value'=>1,'kind'=>2,'type'=>$this->type,'pid'=>$pid));
			$setinfo->add(array('token'=>$this->token,'name'=>'time','value'=>1,'kind'=>2,'type'=>$this->type,'pid'=>$pid));
			$setinfo->add(array('token'=>$this->token,'name'=>'留言','kind'=>5,'type'=>$this->type,'pid'=>$pid));
		}
		$this->assign('data',$str);
		$arr=$setinfo->where(array('token'=>$this->token,'kind'=>'3','type'=>$this->type,'pid'=>$pid))->select();
		/* if(empty($arr[0][name])){
			$arr[0][name]="您要预约的医师";
			$arr[0][value]="请输入您要预约的医师名字";
		} */
		//print_r($arr);die;
		$this->assign('arr',$arr);
		$list=$setinfo->where(array('token'=>$this->token,'kind'=>'4','type'=>$this->type,'pid'=>$pid))->select();
		/*
		if(empty($list[0][name])){
			$list[0][name]="看房户型";
			$list[0][value]=$name;
		}*/
		//print_r($list);die;
		$this->assign('list',$list);
		$line=$setinfo->where(array('token'=>$this->token,'kind'=>'5','type'=>$this->type,'pid'=>$pid))->select();
		//print_r($line);die;
		//echo $line[0]['id'];die;
		$this->assign('line',$line);
		$check=0;
		//print_r($_POST["person"]);die;
		if(IS_POST){
		//print_r($_POST);die;
			foreach($arr as $key=> $val){
				$id[]=$val['id'];
			}
			foreach($list as $key=> $val){
				$id[]=$val['id'];
			}
			for($i=0;$i<11;$i++){
				 //echo $_POST['name'.$i];
				 
				 if($_POST['name'.$i]!=""){
				 
					//echo "/3333";
					$count=$setinfo->count('id');
					$add['value'] = 1;
					$add['token'] = $_POST['token'];
					$add['type'] = $this->type;
					$add['id']=$_POST['id'.$i];
					if(!empty($add['id'])&&in_array($add['id'],$id)){
						//echo $add['id']."kk";
						$setinfo->where(array('id'=>$add['id']))->save(array('name'=>$_POST['name'.$i],'value'=>$_POST['content'.$i]));
						$check++;
					}else{
						if($i<6){
							//$add['orderid'] = $count;
							$add['name']= $_POST['name'.$i];
							$add['value'] = $_POST['content'.$i];
							$add['kind']= '3';
							$add['pid']=$pid;
							//echo "die;";die;
							$setinfo->add($add);
							$check++;
						}else{
							$add['name']= $_POST['name'.$i];
							$add['value'] = $_POST['content'.$i];
							$add['kind']= '4';
							$add['pid']= $pid;
							$add['type'] = $this->type;
							$setinfo->add($add);
							$check++;
							
						}
					}
					
				 }else{
					$add['id']=$_POST['id'.$i];
					if(in_array($add['id'],$id)){
						$setinfo->where(array('id'=>$add['id']))->delete();
						$check++;
					}
				 }

			}
			
			if(!empty($_POST['id'])){
					$setinfo->where(array('id'=>$_POST['id']))->save(array('name'=>$_POST['textname'],'value'=>$_POST['text'],'pid'=>$pid));
					$check++;
			}
		
		}
		if($check != 0 ){
			$setinfo->where(array('token'=>$this->token,'name'=>'person','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['person']));
			$setinfo->where(array('token'=>$this->token,'name'=>'phone','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['phone']));
			$setinfo->where(array('token'=>$this->token,'name'=>'date','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['date']));
			$setinfo->where(array('token'=>$this->token,'name'=>'time','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['time']));

			$this->success('修改成功！',U($this->type.'/yuyue_index',array('token'=>$this->token)));die;
		}
		$this->assign('type',$this->type);
		$this->display();
	}

	

}
?>