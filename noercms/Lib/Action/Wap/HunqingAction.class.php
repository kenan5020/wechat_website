<?php
class HunqingAction extends BaseAction
{
    public $token;
    public $wecha_id;
    public function _initialize()
    {
        parent::_initialize();
        $this->token    = $this->_get('token');
        $this->wecha_id = $this->_get('wecha_id');
        $this->assign('token', $this->token);
        $this->assign('wecha_id', $this->wecha_id);
        $get_ids = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'hunqing'
        ))->field('res_id,classify_id')->find();
        $this->assign('rid', $get_ids['res_id']);
    }
    public function index()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (!strpos($agent, "icroMessenger")) {
        }
        $data        = M("Estate");
        $this->token = $this->_get('token');
        $where       = array(
            'token' => $this->token,'thetype' => 'hunqing'
        );
        $es_data     = $data->where($where)->find();
        $this->assign('es_data', $es_data);
        $this->display();
    }
    public function news()
    {
        $data        = M("Estate");
        $this->token = $this->_get('token');
        $where       = array(
            'token' => $this->token
        );
        $cid         = $data->where($where)->getField('classify_id');
        if ($cid != null) {
            $t_classify = M('Classify');
            $where      = array(
                'token' => $this->token,
                'id' => $cid
            );
            $classify   = $t_classify->where($where)->find();
        }
        $t_img  = M('Img');
        $where  = array(
            'classid' => $classify['id'],
            'token' => $this->_get('token')
        );
        $imgtxt = $t_img->where($where)->field('id as mid,title,pic,createtime')->select();
        $this->assign('imgtxt', $imgtxt);
        $this->assign('classify', $classify);
        $this->display();
    }
    public function newlist()
    {
        $token  = $this->_get('token');
        $mid    = (int) $this->_get('mid');
        $t_img  = M('Img');
        $where  = array(
            'id' => $mid,
            'token' => $token
        );
        $imgtxt = $t_img->where($where)->find();
        $this->assign('imgtxt', $imgtxt);
        $this->display();
    }
    public function housetype()
    {
        $t_housetype = M('Estate_housetype');
        $where       = array(
            'token' => $this->_get('token'),'thetype' => 'hunqing'
        );
        $housetype   = $t_housetype->where($where)->order('sort desc')->select();
        foreach ($housetype as $k => $v) {
            $son_type[] = M("Estate_son")->where(array(
                'id' => $v['son_id']
            ))->field('id as sid,title')->find();
        }
        foreach ($son_type as $key => $value) {
            foreach ($value as $k => $v) {
                $housetype[$key][$k] = $v;
            }
        }
        $this->assign('housetype', $housetype);
        $data        = M("Estate");
        $this->token = $this->_get('token');
        $where       = array(
            'token' => $this->token,'thetype' => 'hunqing'
        );
        $es_data     = $data->where($where)->field('title,house_banner,panorama_id')->find();
        $this->assign('es_data', $es_data);
        
        
        $data1        = M("Estate");
        $this->token = $this->_get('token');
        $where1       = array(
            'token' => $this->token,'thetype' => 'hunqing'
        );
        $es_data1     = $data1->where($where1)->find();
        $this->assign('es_data1', $es_data1);
        $this->display();
    }
    public function album()
    {
        $Photo      = M("Photo");
        $photo_list = M('Photo_list');
        $t_album    = M('Estate_album');
        $album      = $t_album->where(array(
            'token' => $this->_get('token'),'thetype' => 'hunqing'
        ))->field('id,poid')->select();
        foreach ($album as $k => $v) {
            $list_photo  = $Photo->where(array(
                'token' => $this->_get('token'),'thetype' => 'hunqing',
                'id' => $v['poid']
            ))->field('id')->find();
            $photolist[] = $photo_list->where(array(
                'token' => $this->_get('token'),
                'pid' => $list_photo['id']
            ))->select();
        }
        $this->assign('photolist', $photolist);
        $this->assign('album', $list_photo);
        $this->display();
    }
    public function show_album()
    {
        $t_housetype = M('Estate_housetype');
        $id          = (int) $this->_get('id');
        $where       = array(
            'token' => $this->_get('token'),'thetype' => 'hunqing',
            'id' => $id
        );
        $housetype   = $t_housetype->where($where)->order('sort desc')->find();
        $data        = M("Estate");
        $this->token = $this->_get('token');
        $where       = array(
            'token' => $this->token,'thetype' => 'hunqing'
        );
        $es_data     = $data->where($where)->field('id,title')->find();
        if (!empty($es_data)) {
            $housetype = array_merge($housetype, $es_data);
        }
        $this->assign('housetype', $housetype);
        $this->display();
    }
    public function impress()
    {
        $t_impress = M('Estate_impress');
				
        $impress   = $t_impress->where('is_show=1')->order('sort desc')->select();
        $this->assign('impress', $impress);
        $t_expert = M('Estate_expert');
        $where       = array(
            'token' => $this->token,'thetype' => 'hunqing'
        );
        $expert   = $t_expert->where($where)->order('sort desc')->select();
        $this->assign('expert', $expert);
         $data1        = M("Estate");
        $this->token = $this->_get('token');
        $where1       = array(
            'token' => $this->token,'thetype' => 'hunqing'
        );
        $es_data1     = $data1->where($where1)->find();
        $this->assign('es_data1', $es_data1);
        $this->display();
    }
    public function impress_add()
    {
        $t_impress = M('Estate_impress');
        $t_imp_add = M("Estate_impress_add");
        $imp_id    = (int) $this->_post('imp_id');
        $token     = $this->_post('token');
        $wecha_id  = $this->_post('wecha_id');
        $where     = array(
            'imp_id' => $imp_id,
            'wecha_id'
        );
        $check     = $t_imp_add->where($where)->find();
        $data      = array(
            'imp_id' => $imp_id,
            'msg' => $wecha_id
        );
        echo json_encode($data);
        exit;
        if ($check != null) {
            $data = array(
                'success' => 1,
                'msg' => "谢谢您的赞。"
            );
            echo json_encode($data);
            exit;
        }
        if ($id = $t_imp_add->add($_POST)) {
            $t_impress->where(array(
                'id' => $imp_id
            ))->setInc('comment');
            $data = array(
                'success' => 1,
                'msg' => "谢谢您的赞。"
            );
            echo json_encode($data);
            exit;
        } else {
            $data = array(
                'success' => 0,
                'msg' => "点赞失败，请再来一次吧。"
            );
            echo json_encode($data);
            exit;
        }
    }
    public function aboutus()
    {
        $company = M('Company');
        $token   = $this->_get('token');
        $about   = $company->where(array(
            'token' => $token
        ))->find();
        $this->assign('about', $about);
        $this->display();
    }
}
?>