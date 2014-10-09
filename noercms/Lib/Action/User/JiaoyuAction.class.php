<?php

class JiaoyuAction extends UserAction
{
    public function _initialize()
    {
        parent::_initialize();
        $function = M('Function')->where(array('funname' => 'estate'))->find();
        if (intval($this->user['gid']) < intval($function['gid'])) {
      //      $this->error('您还开启该模块的使用权,请到功能模块中添加', U('Function/index', array('token' => $this->token)));
        }
    }
    public function index()
    {
    	if(session('gid')==1){
			$this->error('您的级别不够,无法进入,请升级产品后再使用');
		}
        $data = M('Estate');
         $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $es_data = $data->where($where)->find();
        $panorama = M('Panorama')->where($where)->field('id as pid,name,keyword')->select();
        $this->assign('panorama', $panorama);
        $classify = M('Classify')->where($where)->field('id as cid,name')->select();
        $this->assign('classify', $classify);
        $reslist = M('Reservation')->where($where)->field('id as rid ,title')->select();
        $this->assign('reslist', $reslist);
        if (IS_POST) {
            if ($es_data == null) {
                if ($id = $data->add($_POST)) {
                    $data1['pid'] = $id;
                    $data1['token'] = session('token');
                    $data1['module'] = 'Jiaoyu';
                    $data1['keyword'] = trim($_POST['keyword']);
                    M('Keyword')->add($data1);
                    $this->success('添加成功', U('Jiaoyu/index', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($data->where($wh)->save($_POST)!==false) {
                    $data1['pid'] = (int) $this->_post('id');
                    $data1['module'] = 'Jiaoyu';
                    $data1['token'] = session('token');
                    $da['keyword'] = trim($this->_post('keyword'));
                    M('Keyword')->where($data1)->save($da);
                    $this->success('修改成功', U('Jiaoyu/index', array('token' => session('token'))));
                } else {
                    $this->error('操作失败');
                }
            }
        } else {
            $this->assign('es_data', $es_data);
            $this->display();
        }
    }
    public function son()
    {
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $this->assign('pid', M('Estate')->where($where)->getField('id'));
        $estate_son = M('Estate_son');
        $son_data = $estate_son->where($where)->order('sort desc')->select();
        $this->assign('son_data', $son_data);
        $this->display();
    }
    public function son_add()
    {
        $t_son = M('Estate_son');
        $id = (int) $this->_get('id');
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $this->assign('pid', M('Estate')->where($where)->getField('id'));
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token);
        $check = $t_son->where($where)->find();
        if ($check != null) {
            $this->assign('son', $check);
        }
        if (IS_POST) {
            if ($check == null) {
                $_POST['token'] = session('token');
                if ($t_son->add($_POST)) {
                    $this->success('添加成功', U('Jiaoyu/son', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($t_son->where($wh)->save($_POST)!==false) {
                    $this->success('修改成功', U('Jiaoyu/son', array('token' => session('token'))));
                } else {
                    $this->error('操作失败');
                }
            }
        }
        $this->display();
    }
    public function son_del()
    {
        $t_son = M('Estate_son');
        $id = (int) $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token,'thetype' => 'jiaoyu');
        $check = $t_son->where($where)->find();
        if ($check == null) {
            $this->error('操作失败');
        } else {
            $isok = $t_son->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jiaoyu/son', array('token' => session('token'))));
            } else {
                $this->error('删除失败', U('Jiaoyu/son', array('token' => session('token'))));
            }
        }
    }
    public function housetype()
    {
        $t_housetype = M('Estate_housetype');
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $housetype = $t_housetype->where($where)->order('sort desc')->select();
        foreach ($housetype as $k => $v) {
            $son_type[] = M('Estate_son')->where(array('id' => $v['son_id']))->field('id as sid,title')->find();
        }
        foreach ($son_type as $key => $value) {
            foreach ($value as $k => $v) {
                $housetype[$key][$k] = $v;
            }
        }
        $this->assign('housetype', $housetype);
        $this->display();
    }
    public function housetype_add()
    {
        $t_housetype = M('Estate_housetype');
        $id = (int) $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token,'thetype' => 'jiaoyu');
        $check = $t_housetype->where($where)->find();
        $son_data = M('Estate_son')->where(array('token' => session('token'),'thetype' => 'jiaoyu'))->field('id as sid,title')->select();
        $this->assign('son_data', $son_data);
        $panorama = M('Panorama')->where(array('token' => session('token')))->field('id as pid,name,keyword')->select();
        $this->assign('panorama', $panorama);
        if ($check != null) {
            $this->assign('housetype', $check);
        }
        if (IS_POST) {
            if ($check == null) {
                $_POST['token'] = session('token');
                if ($t_housetype->add($_POST)) {
                    $this->success('添加成功', U('Jiaoyu/housetype', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($t_housetype->where($wh)->save($_POST)!==false) {
                    $this->success('修改成功', U('Jiaoyu/housetype', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('操作失败');
                }
            }
        }
        $this->display();
    }
    public function housetype_del()
    {
        $housetype = M('Estate_housetype');
        $id = (int) $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token);
        $check = $housetype->where($where)->find();
        if ($check == null) {
            $this->error('操作失败');
        } else {
            $isok = $housetype->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jiaoyu/housetype', array('token' => session('token'))));
            } else {
                $this->error('删除失败', U('Jiaoyu/housetype', array('token' => session('token'))));
            }
        }
    }
    
    
    public function album()
    {
        $Photo = M('Photo');
        $t_album = M('Estate_album');
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $album = $t_album->where($where)->field('id,poid')->select();
        foreach ($album as $k => $v) {
            $list_photo[] = $Photo->where(array('token' => session('token'), 'id' => $v['poid']))->order('id desc')->find();
        }
        $this->assign('album', $list_photo);
        $this->display();
    }
    public function album_add()
    {
        $po_data = M('Photo');
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $list = $po_data->where($where)->field('id,title')->select();
        $this->assign('photo', $list);
        $t_album = M('Estate_album');
        $poid = (int) $this->_get('poid');
        $check = $t_album->where(array('token' => session('token'), 'poid' => $poid,'thetype' => 'jiaoyu'))->find();
        $this->assign('album', $check);
        if (IS_POST) {
            if ($check == NULL) {
                $check_ex = $t_album->where(array('token' => session('token'), 'poid' => $this->_post('poid'),'thetype' => 'jiaoyu'))->find();
                if ($check_ex) {
                    $this->error('您已经添加过改相册，请勿重复添加。');
                    die;
                }
                $_POST['token'] = session('token');
                if ($t_album->add($_POST)) {
                    $this->success('添加成功', U('Jiaoyu/album', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($t_album->where($wh)->save($_POST)!==false) {
                    $this->success('修改成功', U('Jiaoyu/album', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('操作失败');
                }
            }
        }
        $this->display();
    }
    
    public function album_del()
    {
        $housetype = M('Estate_album');
        $poid = (int) $this->_get('id');
        $token = $this->_get('token');
        $where['token'] = session('token');
        $where['thetype'] = 'jiaoyu';
        $where['poid'] = $poid;
        $check = $housetype->where($where)->find();
        if ($check == null) {
            $this->error('操作失败');
        } else {
            $isok = $housetype->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jiaoyu/album', array('token' => session('token'))));
            } else {
                $this->error('删除失败', U('Jiaoyu/album', array('token' => session('token'))));
            }
        }
    }
    
    public function impress()
    {
        $t_impress = M('Estate_impress');
        $impress = $t_impress->order('sort desc')->select();
        $this->assign('impress', $impress);
        $this->display();
    }
    public function impress_add()
    {
        $t_impress = M('Estate_impress');
        $id = $this->_get('id');
        $where = array('id' => $id);
        $check = $t_impress->where($where)->find();
        if ($check != null) {
            $this->assign('impress', $check);
        }
        if (IS_POST) {
            if ($check == null) {
                if ($t_impress->add($_POST)) {
                    $this->success('添加成功', U('Jiaoyu/impress', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('id' => $this->_post('id'));
                if ($t_impress->where($wh)->save($_POST)!==false) {
                    $this->success('修改成功', U('Jiaoyu/impress', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('操作失败');
                }
            }
        }
        $this->display();
    }
    public function impress_del()
    {
        $impress = M('Estate_impress');
        $id = $this->_get('id');
        $where = array('id' => $id);
        $check = $impress->where($where)->find();
        if ($check == null) {
            $this->error('操作失败');
        } else {
            $isok = $impress->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jiaoyu/impress', array('token' => session('token'))));
            } else {
                $this->error('删除失败', U('Jiaoyu/impress', array('token' => session('token'))));
            }
        }
    }
    public function expert()
    {
        $t_expert = M('Estate_expert');
        $where['thetype']='jiaoyu';
        $expert = $t_expert->where($where)->order('sort desc')->select();
        $this->assign('expert', $expert);
        $this->display();
    }
    public function expert_add()
    {
        $t_expert = M('Estate_expert');
        $id = $this->_get('id');
        $where = array('id' => $id);
        $check = $t_expert->where($where)->find();
        if ($check != null) {
            $this->assign('expert', $check);
        }
        if (IS_POST) {
            if ($check == null) {
                if ($t_expert->add($_POST)) {
                    $this->success('添加成功', U('Jiaoyu/expert', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('id' => $this->_post('id'));
                if ($t_expert->where($wh)->save($_POST)!==false) {
                    $this->success('修改成功', U('Jiaoyu/expert', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('操作失败');
                }
            }
        }
        $this->display();
    }
    public function expert_del()
    {
        $expert = M('Estate_expert');
        $id = $this->_get('id');
        $where = array('id' => $id);
        $check = $expert->where($where)->find();
        if ($check == null) {
            $this->error('操作失败');
        } else {
            $isok = $expert->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jiaoyu/expert', array('token' => session('token'))));
            } else {
                $this->error('删除失败', U('Jiaoyu/expert', array('token' => session('token'))));
            }
        }
    }
    public function reservation()
    {
        $this->display();
    }
}
?>