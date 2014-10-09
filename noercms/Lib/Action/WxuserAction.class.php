<?php
// +----------------------------------------------------------------------
// | G3weixin [ ALL WHERE,ALL TIME ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://lietouzhe.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

/**
 * 微信账号控制器类库
 */
class WxuserAction extends UserAction{
	protected $wxuserinfo;
	//该构造函数继承父类的当前登陆用户信息、用户组信息及当前微信用户的全信息、 并实现SESSION的微信用户信息
	protected function _initialize(){
		parent::_initialize();
		if($this->_get('token','trim')){
			$wecha=M('Wxuser')->where(array('token'=>$this->_get('token','trim'),'uid'=>session('uid')))->find();
			if($wecha){
				$this->setwxsession($wecha);
				session('wxqueryname',$this->getwxqueryname());
				session('token',session('wxtoken')); //照顾老代码
				$wecha['queryname'] = $this->getwxqueryname();				
			}else{
				$this->error("非法操作,错误代码001",U('User/Index/index'));
			}	
		}else{
			if(!session('token')){
				$this->error('非法操作,错误代码002',U('User/Index/index'));
			}
			$wecha=M('Wxuser')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
			$wecha['queryname'] = $this->getwxqueryname();	
		}				
		$this->wxuserinfo = $wecha;	
		$this->assign('wxuserinfo',$this->wxuserinfo);
		//$this->getpower();	
		
	}
	//功能函数  更新用户SESSION
	protected function setwxsession($wecha){
		foreach($wecha as $key=>$value){
			session('wx'.$key,$value);			
		}
	}
	//功能函数 查询用户的某一个微信号的权限信息
	protected function getwxqueryname(){
		$tkinfo=M('Token_open')->field('id,queryname')->where(array('token'=>session('wxtoken'),'uid'=>session('uid')))->find();
		$queryname=explode(',',strtolower($tkinfo['queryname']));		
		return $queryname;
	}
	//功能函数  控制器权限检测
	protected function getpower(){
		$modulename = strtolower(MODULE_NAME);
		$actionname = strtolower(ACTION_NAME);
		if(in_array($modulename,$this->wxuserinfo['queryname'])){
			$info = M('Function')->where(array('funname'=>$modulename))->find();
			if($info){
				$action = strtolower($info['controlaction']);
				$actionarr = explode('|',strtolower($action));
				if(in_array($actionname,$actionarr)){
					//正常使用
				}else{
					$this->error("您无权使用此功能",U('User/Alipay/upgrade'));
				}
			}else{
				$this->error("您所在的会员组无法使用该功能,请升级您的会员等级",U('User/Alipay/upgrade'));
			}	
		}else{
			if($this->getgrouppower($modulename)){
				$this->error("您所使用功能可能已被您关闭，请到功能管理中开启后再使用！",U('User/Function/index'));
			}else{
				$this->error("您所在的会员组无法使用该功能,请升级您的会员等级",U('User/Alipay/upgrade'));
			}
			
		}
		
	}
	protected function getgrouppower($modulename){
		$where['gid'] =array('elt',$this->userinfo['gid']);
		$func = M('Function')->where($where)->select();
		foreach($func as $key=>$value){
			$str.=strtolower($value['funname']).",";
		}
		$str = strtolower(rtrim($str,','));
		if(!is_int(strpos($str,$modulename))){
			return false;	
		}else{
			return true;
		}
	}
	protected function addchannel($str,$url='url'){
		if(!(($str== '外部链接') || ($str== '联系电话') || ($str== '默认'))){
			switch($this->_post('selecttype')){
				case '刮刮卡':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('guajiang'));
					$_POST['urlid'] = $this->_post('guajiang');
				break;
				case '大转盘':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('dazhuanpan'));
					$_POST['urlid'] = $this->_post('dazhuanpan');
				break;
				case '优惠券':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('youhuiquan'));
					$_POST['urlid'] = $this->_post('youhuiquan');
				break;
				case '订房':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('dingfang'));
					$_POST['urlid'] = $this->_post('dingfang');
				break;
				case '全景':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('quanjing'));
					$_POST['urlid'] = $this->_post('quanjing');
				break;
				case '预约':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('yuyue'));
					$_POST['urlid'] = $this->_post('yuyue');
				break;
				case '微喜帖':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('xitie'));
					$_POST['urlid'] = $this->_post('xitie');
				break;
				case '砸金蛋':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'),$this->_post('jindan'));
					$_POST['urlid'] = $this->_post('jindan');
				break;
				case '首页':
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'));
					$_POST['urlid'] = 0;
				break;
				case '地址':
					if($company = M('Company')->where(array('token'=>session('token'),'isbranch'=>0))->find()){
						if($company['latitude'] && $company['longitude']){
							$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'));
						}else{
							$this->error('您还没有设置公司地图地址，请先设置！', U('User/Company/index',array('token'=>session('token'))));
						}
				
				
					}else{
						$this->error('您还没有设置公司信息，请先设置！', U('User/Company/index',array('token'=>session('token'))));
					}
				break;
				default:
					$_POST[$url] = $this->getlink($this->_post('selecttype'),session('token'));
					$_POST['urlid'] = 0;
				break;
			}
			$_POST['link'] = $_POST[$url];
			
		}else{
			//$_POST['link'] = $_POST['url'];
			$_POST['urlid'] = 0;
			
		}
		
	}
	protected function checkchannel($url='url'){
		if($this->_post('selecttype') == '外部链接'){
			if(!$this->_post($url)){
				$this->error('您没有填写外部链接地址！');
			}
		}
		if($this->_post('selecttype') == '刮刮卡'){
			if(!$this->_post('guajiang')){
				$this->error('您还没有设置刮刮卡活动！',U('User/Guajiang/index',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '大转盘'){
			if(!$this->_post('dazhuanpan')){
				$this->error('您还没有设置大转盘活动！', U('User/Lottery/index',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '优惠券'){
			if(!$this->_post('youhuiquan')){			
				$this->error('您还没有设置优惠券活动！', U('User/Coupon/index',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '订房'){
			if(!$this->_post('dingfang')){			
				$this->error('您还没有设置公司信息！', U('User/Company/index',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '全景'){
			if(!$this->_post('quanjing')){			
				$this->error('您还没有设置全景信息！', U('User/Panorama/add',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '预约'){
			if(!$this->_post('yuyue')){			
				$this->error('您还没有设置预约信息！', U('User/Selfform/add',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '微喜帖'){
			if(!$this->_post('xitie')){			
				$this->error('您还没有设置微喜帖信息！', U('User/Marrycard/add',array('token'=>session('token'))));
			}
		}
		if($this->_post('selecttype') == '砸金蛋'){
			if(!$this->_post('jindan')){			
				$this->error('您还没有设置砸金蛋信息！', U('User/Goldegg/add',array('token'=>session('token'))));
			}
		}
		$company = M('Company')->where(array('token'=>session('token'),'isbranch'=>0))->find();
		if($this->_post('selecttype') == '联系电话'){
			if($company){
				if($company['tel']){
					$_POST[$url] = 'tel:'.$company['tel'];
				}elseif($company['mp']){
					$_POST[$url] = 'tel:'.$company['tel'];
				}else{
					$this->error('您还没有设置公司电话，请先设置！', U('User/Company/index',array('token'=>session('token'))));
				}
				
				
			}else{
				$this->error('您还没有设置公司信息，请先设置！', U('User/Company/index',array('token'=>session('token'))));
			}
		}
		
	}
}
?>