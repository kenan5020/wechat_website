<?php

class ReservationAction extends UserAction
{
    public function index()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where = array('token' => session('token'));
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
     public function estateindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'estate';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function meirongindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'meirong';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
     public function lvyouindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'lvyou';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function jianshenindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'jianshen';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function zhengwuindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'zhengwu';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function wuyeindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'wuye';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function ktvindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'ktv';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function jiubaindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'jiuba';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function hunqingindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'hunqing';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function zhuangxiuindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'zhuangxiu';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function jiaoyuindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function huadianindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'huadian';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function qicheindex()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        $data = M('Reservation');
        $where['token'] = session('token');
        $where['thetype'] = 'qiche';
        $reslist = $data->where($where)->select();
        $this->assign('reslist', $reslist);
        $this->display();
    }
    
    public function add()
    {
        if (session('gid') == 1) {
            $this->error('您的级别不够无法使用抽奖活动,请充值后再使用');
        }
        if (IS_POST) {
            $data = D('Reservation');
            
            $_POST['token'] = session('token');
            $_POST['thetype'] = $_REQUEST['thetype'];
            if ($data->create() != false) {
                if ($id = $data->data($_POST)->add()) {
                    $data1['pid'] = $id;
                    $data1['module'] = 'Reservation';
                    $data1['token'] = session('token');
                    $data1['keyword'] = trim($_POST['keyword']);
                    M('Keyword')->add($data1);
                    $theurl="Reservation/".$_REQUEST['thetype']."index";
                    $this->success('添加成功', U($theurl, array('token' => session('token'))));
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $this->error($data->getError());
            }
        } else {
            $this->display();
        }
    }
    public function edit()
    {
        if (IS_POST) {
            $data = D('Reservation');
            $where = array('id' => $_GET['id'], 'token' => session('token'));
            $check = $data->where($where)->find();
            if ($check == false) {
                $this->error('非法操作');
            }
            if ($data->create()) {
                if ($data->where($where)->save($_POST)!==false) {
                    $data1['pid'] = $_POST['id'];
                    $data1['module'] = 'Reservation';
                    $data1['token'] = session('token');
                    $da['keyword'] = trim($_POST['keyword']);
                    M('Keyword')->where($data1)->save($da);
                    $this->success('修改成功', U('Reservation/index', array('token' => session('token'))));
                } else {
                    $this->error('操作失败');
                }
            } else {
                $this->error($data->getError());
            }
        } else {
            $id = $this->_get('id');
            $where = array('id' => $id, 'token' => session('token'));
            $data = M('Reservation');
            $check = $data->where($where)->find();
            if ($check == false) {
                $this->error('非法操作');
            }
            $reslist = $data->where($where)->find();
            $this->assign('reslist', $reslist);
            $this->display('add');
        }
    }
    public function del()
    {
        $id = (int) $this->_get('id');
        $_POST['thetype'] = $_REQUEST['thetype'];
        $res = M('Reservation');
        $find = array('id' => $id, 'token' => $this->_get('token'));
        $result = $res->where($find)->find();
        if ($result) {
            $res->where('id=' . $result['id'])->delete();
            $where = array('pid' => $result['id'], 'module' => 'Reservation', 'token' => session('token'));
            M('Keyword')->where($where)->delete();
            $theurl="Reservation/".$_REQUEST['thetype']."index";
            $this->success('删除成功', U($theurl, array('token' => session('token'))));
            die;
        } else {
            $this->error('非法操作！');
            die;
        }
    }
    public function manage()
    {
        $t_reservebook = M('Reservebook');
        $rid = $this->_get('id');
        $where = array('token' => session('token'), 'rid' => $rid);
        $books = $t_reservebook->where($where)->select();
        $this->assign('books', $books);
        $this->assign('count', $t_reservebook->count());
        $this->assign('ok_count', $t_reservebook->where('remate=1')->count());
        $this->assign('lose_count', $t_reservebook->where('remate=2')->count());
        $this->assign('call_count', $t_reservebook->where('remate=0')->count());
        $this->display();
    }
    public function reservation_uinfo()
    {
        $id = $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token);
        $t_reservebook = M('Reservebook');
        $userinfo = $t_reservebook->where($where)->find();
        $this->assign('userinfo', $userinfo);
        if (IS_POST) {
            $id = $this->_post('id');
            $token = session('token');
            $where = array('id' => $id, 'token' => $token);
            $ok = $t_reservebook->where($where)->save($_POST);
            if ($ok!==false) {
                $this->assign('ok', 1);
            } else {
                $this->assign('ok', 2);
            }
        }
        $this->display();
    }
    public function manage_del()
    {
        $id = $this->_get('id');
        $t_reservebook = M('Reservebook');
        $where = array('id' => $id, 'token' => $this->_get('token'));
        $check = $t_reservebook->where($where)->find();
        if (!empty($check)) {
            $t_reservebook->where(array('id' => $check['id']))->delete();
            $this->success('删除成功', U('Reservation/index', array('token' => session('token'))));
            die;
        } else {
            $this->error('非法操作！');
            die;
        }
    }
    public function total()
    {
        $this->display();
    }
}
?>