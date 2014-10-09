<?php
class ServiceUserAction extends UserAction{
    public $token;
    private $data;
    private $openid;
    public function _initialize(){
        parent :: _initialize();
        $this -> openid = $this -> _get('openid', 'htmlspecialchars');
        if($this -> openid == false){
        }
        $this -> token = session('token');
        $this -> data = D('Service_user');
    }
    public function index(){
        $where['token'] = session('token');
        $count = $this -> data -> where($where) -> count();
        $page = new Page($count, 25);
        $list = $this -> data -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
        $this -> assign('page', $page -> show());
        $this -> assign('list', $list);
        $this -> assign('type', 'list');
        $this -> display();
    }
    public function add(){
        if(IS_POST){
			$_POST['token']=session('token');
			$_POST['userPwd']=md5($_POST['userPwd']);
            $db = D("Service_user");
            if($db -> create() === false){
                $this -> error($db -> getError());
            }else{
                $id = $db -> add();
                if($id == true){
                    M('Users') -> where(array('id' => session('uid'))) -> setInc('serviceUserNum');
                    $this -> success('操作成功',U('ServiceUser/index',array('token'=>$token)));
                }else{
                    $this -> error('操作失败');
                }
            }
        }else{
            $this -> display();
        }
    }
    public function edit(){
        if(IS_POST){
            if(empty($_POST['userPwd'])){
                unset($_POST['userPwd']);
            }else{
				$_POST['userPwd']=md5($_POST['userPwd']);
			}
            $_POST['id'] = $this -> _get('id', 'intval');
            $this -> all_save('Service_user', '/index');
        }else{
            $where['id'] = $this -> _get('id', 'intval');
            $where['session'] = session('session');
            $info = M('ServiceUser') -> where($where) -> find();
            $this -> assign('serviceUser', $info);
            $this -> display('add');
        }
    }
    public function chat_log(){
        $data = M('service_logs');
        $wehre['token'] = session('token');
        $count = $data -> where($where) -> count();
        $page = new Page($count, 25);
        $list = $data -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
        foreach($list as $key => $vo){
            $list[$key]['name'] = D('Service_user') -> getServiceUser($vo['pid']);
        }
        $this -> assign('page', $page -> show());
        $this -> assign('list', $list);
        $this -> assign('type', 'list');
        $this -> display();
    }
    public function del (){
        M('Users') -> where(array('id' => session('uid'))) -> setDec('serviceUserNum');
        $this -> del_id('',U('ServiceUser/index',array('token'=>$token)));
    }
    public function chat_log_del (){
        $this -> del_id('service_logs', 'Service/chat_log');
    }
}
?>