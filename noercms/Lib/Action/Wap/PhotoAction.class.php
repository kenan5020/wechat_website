<?php
class PhotoAction extends BaseAction{
	public function index(){

		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$homeInfo=M('home')->where(array('token'=>$token))->find();//调取商家信息
		$this->homeInfo=$homeInfo;//调取商家信息
        $cardset = M('Member_card_set')->where(array('token'=>$token))->find(); //获取banner的logo
		$photo=M('Photo')->where(array('token'=>$token,'status'=>1))->order('id desc')->select();
		if($photo==false){ }
		$this->assign('photo',$photo);
                $this->assign('cardset',$cardset);
		$this->display();
	}
	public function plist(){

		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$homeInfo=M('home')->where(array('token'=>$token))->find();//调取商家信息
		$this->homeInfo=$homeInfo;//调取商家信息
        $cardset = M('Member_card_set')->where(array('token'=>$token))->find(); //获取banner的logo
		$info=M('Photo')->field('title')->where(array('token'=>$token,'id'=>$this->_get('id')))->find();
		$photo_list=M('Photo_list')->where(array('token'=>$token,'pid'=>$this->_get('id'),'status'=>1))->select();
		//dump($photo);
		$this->assign('info',$info);
		$this->assign('photo',$photo_list);
                $this->assign('cardset',$cardset);
		$this->display();
		
	
	}
}
?>