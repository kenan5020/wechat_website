<?php

class VoteAction extends UserAction
{
    public function index()
    {
        $function = M('Function')->where(array(
            'funname' => 'vote'
        ))->find();
        if (intval($this->user['gid']) < intval($function['gid'])) {
            $this->error('您还开启该模块的使用权,请到功能模块中添加', U('Function/index', array(
                'token' => $this->token
            )));
        }
        $user  = M('Users')->field('gid,activitynum')->where(array(
            'id' => session('uid')
        ))->find();
        $group = M('User_group')->where(array(
            'id' => $user['gid']
        ))->find();
        $this->assign('group', $group);
        $this->assign('activitynum', $user['activitynum']);
        $list  = M('Vote')->where(array(
            'token' => session('token')
        ))->order('id DESC')->select();
        $count = M('Vote')->where(array(
            'token' => session('token')
        ))->count();
        $this->assign('count', $count);
        if ($count >= $user['activitynum'])
            $this->assign('ok', 1);
        $this->assign('list', $list);
        $this->display();
    }
    public function totals()
    {
        $token    = session('token');
        $id       = $this->_get('id');
        $t_vote   = M('Vote');
        $t_record = M('Vote_record');
        $where    = array(
            'id' => $id,
            'token' => session('token')
        );
        $vote     = $t_vote->where($where)->find();
        if (empty($vote)) {
            exit('非法操作');
        }
        $vote_item = M('Vote_item')->where('vid=' . $vote['id'])->select();
        $this->assign('count', $t_record->where(array(
            'vid' => $id
        ))->count());
        $where       = array(
            'wecha_id' => $wecha_id,
            'vid' => $id
        );
        $vote_record = $t_record->where($where)->find();
        $total       = $t_record->where('vid=' . $id)->count('touched');
        $item_count  = M('Vote_item')->where('vid=' . $id)->select();
        foreach ($item_count as $k => $value) {
            $vote_item[$k]['per'] = (number_format(($value['vcount'] / $total), 4)) * 100;
        }
        $this->assign('vote_item', $vote_item);
        $this->assign('vote', $vote);
        $this->display();
    }
    public function add()
    {
        $this->assign('type', $this->_get('type'));
        if (IS_POST) {
            $adds = $_REQUEST['add'];
            if (empty($adds)) {
                $this->error('投票选项你还没有填写');
                exit;
            }
            foreach ($adds as $ke => $value) {
                foreach ($value as $k => $v) {
                    $item_add[$k][$ke] = $v;
                }
            }
            $data              = D('Vote');
            $_POST['id']       = $this->_get('id');
            $_POST['token']    = session('token');
            $_POST['type']     = $this->_get('type');
            $_POST['statdate'] = strtotime($this->_post('statdate'));
            $_POST['enddate']  = strtotime($this->_post('enddate'));
            $_POST['cknums']   = $this->_post('cknums');
            $_POST['display']  = $this->_post("display");
            $_POST['info']     = strip_tags($this->_post("info"));
            $_POST['picurl']   = $this->_post("picurl");
            $_POST['title']    = $this->_post("title");
            $_POST['keyword']  = $this->_post('keyword');
            $t_item            = M('Vote_item');
            if ($data->create() != false) {
                if ($id = $data->add()) {
                    foreach ($item_add as $k => $v) {
                        $data2['vid']    = $id;
                        $data2['item']   = $v['item'];
                        $data2['rank']   = $v['rank'];
                        $data2['vcount'] = $v['vcount'];
                        if ($_POST['type'] == 'img') {
                            $data2['startpicurl'] = $v['startpicurl'];
                            $data2['tourl']       = $v['tourl'];
                        }
                        $t_item->add($data2);
                    }
                    $data1['pid']     = $id;
                    $data1['module']  = 'Vote';
                    $data1['token']   = session('token');
                    $data1['keyword'] = trim($_POST['keyword']);
                    M('Keyword')->add($data1);
                    $user = M('Users')->where(array(
                        'id' => session('uid')
                    ))->setInc('activitynum');
                    $this->success('添加成功', U('Vote/index', array(
                        'token' => session('token')
                    )));
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
    public function del()
    {
        $type   = $this->_get('type');
        $id     = $this->_get('id');
        $vote   = M('Vote');
        $find   = array(
            'id' => $id,
            'type' => $type
        );
        $result = $vote->where($find)->find();
        if ($result) {
            $vote->where('id=' . $result['id'])->delete();
            M('Vote_item')->where('vid=' . $result['id'])->delete();
            M('Vote_record')->where('vid=' . $result['id'])->delete();
            $where = array(
                'pid' => $result['id'],
                'module' => 'Vote',
                'token' => session('token')
            );
            M('Keyword')->where($where)->delete();
            $this->success('删除成功', U('Vote/index', array(
                'token' => session('token')
            )));
        } else {
            $this->error('非法操作！');
        }
    }
    public function setinc()
    {
        $id    = $this->_get('id');
        $where = array(
            'id' => $id,
            'token' => session('token')
        );
        $check = M('Vote')->where($where)->find();
        if ($check == false)
            $this->error('非法操作');
        $user  = M('Users')->field('gid,activitynum')->where(array(
            'id' => session('uid')
        ))->find();
        $group = M('User_group')->where(array(
            'id' => $user['gid']
        ))->find();
        if ($user['activitynum'] >= $group['activitynum']) {
            $this->error('您的免费活动创建数已经全部使用完,请充值后再使用', U('Home/Index/price'));
        }
        if ($check['status'] == 0) {
            $data = M('Vote')->where($where)->save(array(
                'status' => 1
            ));
            $tip  = '恭喜你,活动已经开始';
        } else {
            $data = M('Vote')->where($where)->save(array(
                'status' => 0
            ));
            $tip  = '设置成功,活动已经结束';
        }
        if ($data != false) {
            $this->success($tip);
        } else {
            $this->error('设置失败');
        }
    }
    public function setdes()
    {
        $id    = $this->_get('id');
        $where = array(
            'id' => $id,
            'token' => session('token')
        );
        $check = M('Vote')->where($where)->find();
        if ($check == false)
            $this->error('非法操作');
        $data = M('Vote')->where($where)->setDec('status');
        if ($data != false) {
            $this->success('活动已经结束');
        } else {
            $this->error('服务器繁忙,请稍候再试');
        }
    }
    public function edit()
    {
        $this->assign('type', $this->_get('type'));
        if (IS_POST) {
            $data              = D('Vote');
            $_POST['id']       = $this->_get('id');
            $_POST['token']    = session('token');
            $_POST['type']     = $this->_get('type');
            $_POST['statdate'] = strtotime($this->_post('statdate'));
            $_POST['enddate']  = strtotime($this->_post('enddate'));
            $_POST['cknums']   = $this->_post('cknums');
            $_POST['display']  = $this->_post("display");
            $_POST['info']     = strip_tags($this->_post("info"));
            $_POST['picurl']   = $this->_post("picurl");
            $_POST['title']    = $this->_post("title");
            $where             = array(
                'id' => $_POST['id'],
                'token' => session('token')
            );
            $check             = $data->where($where)->find();
            if ($check == false)
                $this->error('非法操作');
            if (empty($_REQUEST['add'])) {
                $this->error('投票选项必须填写');
                exit;
            }
            $t_item = M('Vote_item');
            $datas  = $_REQUEST['add'];
            foreach ($datas as $ke => $value) {
                foreach ($value as $k => $v) {
                    $item_add[$k][$ke] = $v;
                }
            }
            $isnull = $t_item->where('vid=' . $_POST['id'])->find();
            foreach ($item_add as $k => $v) {
                $i_id['id'] = $v['id'];
                if ($i_id['id'] != '') {
                    $data2['item']   = $v['item'];
                    $data2['rank']   = $v['rank'];
                    $data2['vcount'] = $v['vcount'];
                    if ($this->_get('type') == 'img') {
                        $data2['startpicurl'] = $v['startpicurl'];
                        $data2['tourl']       = $v['tourl'];
                    }
                    $t_item->where('id=' . $i_id['id'])->save($data2);
                }
            }
            if ($data->create()) {
                if ($data->where($where)->save($_POST)) {
                    $data1['pid']    = $_POST['id'];
                    $data1['module'] = 'Vote';
                    $data1['token']  = session('token');
                    $da['keyword']   = trim($_POST['keyword']);
                    M('Keyword')->where($data1)->save($da);
                    $this->success('修改成功', U('Vote/index', array(
                        'token' => session('token')
                    )));
                } else {
                    $this->error('操作失败');
                }
            } else {
                $this->error($data->getError());
            }
        } else {
            $id    = $this->_get('id');
            $where = array(
                'id' => $id,
                'token' => session('token')
            );
            $data  = M('Vote');
            $check = $data->where($where)->find();
            if ($check == false)
                $this->error('非法操作');
            $vo    = $data->where($where)->find();
            $items = M('Vote_item')->where('vid=' . $id)->select();
            $this->assign('items', $items);
            $this->assign('vo', $vo);
            $this->display('add');
        }
    }
}
?>