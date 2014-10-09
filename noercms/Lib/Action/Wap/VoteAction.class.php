<?php

class VoteAction extends BaseAction
{
    public function index()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
		/*
        if (!strpos($agent, "icroMessenger")) {
            echo '此功能只能在微信浏览器中使用';
            exit;
        }
		*/
        $token    = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $id       = $this->_get('id');
        $t_vote   = M('Vote');
        $t_record = M('Vote_record');
        $where    = array(
            'token' => $token,
            'id' => $id
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
    public function add_vote()
    {
        $token    = $this->_post('token');
        $wecha_id = $this->_post('wecha_id');
        $tid      = $this->_post('tid');
        $chid     = rtrim($this->_post('chid'), ',');
        $recdata  = M('Vote_record');
        $where    = array(
            'vid' => $tid,
            'wecha_id' => $wecha_id
        );
        $recode   = $recdata->where($where)->find();
        if ($recode != '' || $wecha_id == '') {
            $arr = array(
                'success' => 0
            );
            echo json_encode($arr);
            exit;
        }
        $data      = array(
            'item_id' => $chid,
            'vid' => $tid,
            'wecha_id' => $wecha_id,
            'touch_time' => time(),
            'touched' => 1
        );
        $ok        = $recdata->add($data);
        $map['id'] = array(
            'in',
            $chid
        );
        $t_item    = M('Vote_item');
        $t_item->where($map)->setInc('vcount');
        $total      = M('Vote_record')->where('vid=' . $tid)->count('touched');
        $item_count = M('Vote_item')->where('vid=' . $tid)->select();
        foreach ($item_count as $value) {
            $per[$value['id']] = (number_format(($value['vcount'] / $total), 4)) * 100;
        }
        $arr = array(
            'success' => 1,
            'token' => $token,
            'wecha_id' => $wecha_id,
            'tid' => $tid,
            'chid' => $chid,
            'arrpre' => $per
        );
        echo json_encode($arr);
        exit;
    }
}
?>