<?php
class UsersAction extends BaseAction{
	public function index(){
		header("Location: /");
	}

	/**
	*测试邮箱
	*/
	public function test(){
		  date_default_timezone_set('PRC');
        require_once 'noercms/Lib/Action/wap/class.phpmailer.php';
        include("noercms/Lib/Action/wap/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
        $mail = new PHPMailer();
        $mail->IsSMTP();
        // telling the class to use SMTP
        $mail->Host = 'smtp.163.com';
        // SMTP server
        $mail->SMTPDebug = '1';
        // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true;

        // enable SMTP authentication
        $mail->Port = 25;
        // set the SMTP port for the GMAIL server
        $mail->Username = "";
        // SMTP account username
        $mail->Password = "";
        // SMTP account password
		$mail->From = "";      // 发件人邮箱    
		$mail->FromName =  "管理员";  // 发件人    
		//$mail->AddAddress($to_email, '商户');
        $mail->AddReplyTo("",'微订餐11');
        $mail->Subject = "subject";
        $mail->IsHTML(true);  // send as HTML    
        // optional, comment out and test
        $mail->MsgHTML("body");
		$to_email_arr=explode(",","");
        foreach($to_email_arr as $k => $v){ 
        	$mail->AddAddress($v, '商户'); 
    	}
        var_dump($mail->Send());
	}
	public function checklogin(){
		$db=D('Users');
		$where['username']=$this->_post('username','trim');
		
		// if($db->create()==false)
			// $this->error($db->getError());
		$pwd=$this->_post('password','trim,md5');
		$res=$db->where($where)->find();
		if($res&&($pwd===$res['password'])){
			
			if($res['status']==0){
				$this->error('请联系在线客户，为你人工审核帐号');exit;
			}
			session('uid',$res['id']);
			session('gid',$res['gid']);
			session('uname',$res['username']);
			$info=M('user_group')->find($res['gid']);
			session('diynum',$res['diynum']);
			session('connectnum',$res['connectnum']);
			session('activitynum',$res['activitynum']);
			session('viptime',$res['viptime']);
			session('gname',$info['name']);
			//每个月第一次登陆数据清零
			$now=time();
			$month=date('m',$now);
			if($month!=$res['lastloginmonth']&&$res['lastloginmonth']!=0){
				$data['id']=$res['id'];
				$data['imgcount']=0;
				$data['diynum']=0;
				$data['textcount']=0;
				$data['musiccount']=0;
				$data['connectnum']=0;
				$data['activitynum']=0;
				$db->save($data);
				//
				session('diynum',0);
				session('connectnum',0);
				session('activitynum',0);
			}
			//登陆成功，记录本月的值到数据库
			
			//
			$db->where(array('id'=>$res['id']))->save(array('lasttime'=>$now,'lastloginmonth'=>$month,'lastip'=>$_SERVER['REMOTE_ADDR']));//最后登录时间
			$this->success('登录成功',U('User/Index/index'));
		}else{
			$this->error('帐号密码错误',U('Index/login'));
		}
	}
	
	public function checkreg(){
		$db=D('Users');
		$info=M('User_group')->find(C('reg_groupid'));
		if($db->create()){
			$id=$db->add();
			if($id){				
				if(C('ischeckuser')!='true'){
					$this->success('注册成功,请联系在线客服审核帐号',U('User/Index/index'));exit;
				}
				$viptime=time()+10*365*24*3600;
				$db->where(array('id'=>$id))->save(array('viptime'=>$viptime));
				session('uid',$id);
				session('gid',C('reg_groupid'));
				session('uname',$_POST['username']);
				session('diynum',0);
				session('connectnum',0);
				session('viptime',$viptime);
				session('activitynum',0);
				session('gname',$info['name']);
				/*
				 $smtpserver = C('email_server'); 
				 $port = C('email_port');
				 $smtpuser = C('email_user');
				 $smtppwd = C('email_pwd');
				 $mailtype = "TXT";
				 $sender = C('email_user');
				 $smtp = new Smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
				 $to = $list['email']; 
				 $subject = C('reg_email_title');
				 $code = C('site_url').U('User/Index/checkFetchPass?uid='.$list['id'].'&code='.md5($list['id'].$list['password'].$list['email']));
				 $fetchcontent = C('reg_email_content');
				 $fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
				 $fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
				 $fetchcontent = str_replace('{code}',$code,$fetchcontent);
				 $body=$fetchcontent;
				$body = iconv('UTF-8','gb2312',$fetchcontent);
				 $send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
			    */
				$this->success('注册成功',U('User/Index/index'));
			}else{
				$this->error('注册失败',U('Index/reg'));
			}
		}else{
			$this->error($db->getError(),U('Index/reg'));
		}
	}
	
	public function checkpwd(){

		$where['username']=$this->_post('username');
		$where['email']=$this->_post('email');
		$db=D('Users');
		$list=$db->where($where)->find();
		if($list==false) $this->error('邮箱和帐号不正确',U('Index/regpwd'));
		
		$smtpserver = C('email_server'); 
		$port = C('email_port');
		$smtpuser = C('email_user');
		$smtppwd = C('email_pwd');
		$mailtype = "TXT";
		$sender = C('email_user');
		$smtp = new Smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
		$to = $list['email']; 
		$subject = C('pwd_email_title');
		$code = C('site_url').U('Index/resetpwd',array('uid'=>$list['id'],'code'=>md5($list['id'].$list['password'].$list['email']),'resettime'=>time()));
		$fetchcontent = C('pwd_email_content');
		$fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
		$fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
		$fetchcontent = str_replace('{code}',$code,$fetchcontent);
		$body=$fetchcontent;
		//$body = iconv('UTF-8','gb2312',$fetchcontent);
		$send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
		$this->success('请访问你的邮箱 '.$list['email'].' 验证邮箱后登录!<br/>');
		
	}
	
	public function resetpwd(){
		$where['id']=$this->_post('uid','intval');
		$where['password']=$this->_post('password','md5');
		if(M('Users')->save($where)){
			$this->success('修改成功，请登录！',U('Index/login'));
		}else{
			$this->error('密码修改失败！',U('Index/index'));
		}
	}
	
}
