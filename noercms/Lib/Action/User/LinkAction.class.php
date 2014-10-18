<?php



class LinkAction extends UserAction

{

    public $where;

    public $modules;

    public function _initialize()

    {

        parent::_initialize();

        $this->where = array('token' => $this->token);

        $this->modules = array('Home' => '首页', 'Classify' => '网站分类', 'Img' => '图文回复', 'Company' => 'LBS信息', 'Adma' => 'DIY宣传页', 'Photo' => '相册', 'Selfform' => '万能表单', 'Host' => '商家订单', 'Groupon' => '团购', 'Shop' => '商城', 'Dining' => '订餐', 'Wedding' => '婚庆喜帖', 'Vote' => '投票', 'Panorama' => '全景', 'Lottery' => '大转盘', 'Guajiang' => '刮刮卡', 'Coupon' => '优惠券', 'Zadan' => '砸金蛋', 'MemberCard' => '会员卡', 'Estate' => '微房产','jiudian' => '微酒店','Meirong' => '微美容','Lvyou' => '微旅游','Jianshen' => '微健身','Zhengwu' => '微政务','Wuye' => '微物业','Ktv' => '微KTV','Jiuba' => '微酒吧','Hunqing' => '微婚庆','Zhuangxiu' => '微装修','Jiaoyu' => '微教育','Huadian'=> '微花店','Yiliao' => '微医疗','Message'=>'留言板');

    }

    public function insert()

    {

        $modules = $this->modules();

        $this->assign('modules', $modules);

        $this->display();

    }

    public function modules()

    {

        return array(
		array('module' => 'Home', 'linkcode' => ('/index.php?g=Wap&m=Index&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => '微站首页', 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => $this->modules['Home'], 'askeyword' => 1), 
		array('module' => 'Classify', 'linkcode' => ('/index.php?g=Wap&m=Index&a=lists&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Classify'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 0), 
		array('module' => 'Img', 'linkcode' => ('/index.php?g=Wap&m=Index&a=content&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Img'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		array('module' => 'Company', 'linkcode' => ('/index.php?g=Wap&m=Company&a=map&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Company'], 'sub' => 1, 'canselected' => 1, 'linkurl' => '', 'keyword' => '地图', 'askeyword' => 1), 
		array('module' => 'Adma', 'linkcode' => '/index.php/show/' . $this->token, 'name' => $this->modules['Adma'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 0), 
		array('module' => 'Photo', 'linkcode' => ('/index.php?g=Wap&m=Photo&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Photo'], 'sub' => 1, 'canselected' => 1, 'linkurl' => '', 'keyword' => '相册', 'askeyword' => 1), 
		array('module' => 'Selfform', 'linkcode' => ('/index.php?g=Wap&m=Selfform&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Selfform'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		array('module' => 'Host', 'linkcode' => ('/index.php?g=Wap&m=Host&a=detail&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Host'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Groupon', 'linkcode' => ('/index.php?g=Wap&m=Groupon&a=grouponIndex&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Groupon'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '团购', 'askeyword' => 1), 
		// array('module' => 'Shop', 'linkcode' => ('/index.php?g=Wap&m=Product&a=cats&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Shop'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '商城', 'askeyword' => 1), 
		// array('module' => 'Dining', 'linkcode' => ('/index.php?g=Wap&m=Dining&a=index&dining=1&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Dining'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '微餐饮', 'askeyword' => 1), 
		// array('module' => 'Wedding', 'linkcode' => ('/index.php?g=Wap&m=Wedding&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Wedding'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Vote', 'linkcode' => ('/index.php?g=Wap&m=Vote&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Vote'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Panorama', 'linkcode' => ('/index.php?g=Wap&m=Panorama&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Panorama'], 'sub' => 1, 'canselected' => 1, 'linkurl' => '', 'keyword' => $this->modules['Panorama'], 'askeyword' => 1), 
		// array('module' => 'Lottery', 'linkcode' => '', 'name' => $this->modules['Lottery'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Guajiang', 'linkcode' => '', 'name' => $this->modules['Guajiang'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Coupon', 'linkcode' => '', 'name' => $this->modules['Coupon'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Zadan', 'linkcode' => '', 'name' => $this->modules['Zadan'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
//		array('module' => 'MemberCard', 'linkcode' => ('/index.php?g=Wap&m=Card&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['MemberCard'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '会员卡', 'askeyword' => 1), 
//		array('module' => 'Estate', 'linkcode' => ('/index.php?g=Wap&m=Estate&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&sgssz=mp.weixin.qq.com', 'name' => $this->modules['Estate'], 'sub' => 1, 'canselected' => 1, 'linkurl' => '', 'keyword' => '微房产', 'askeyword' => 1),
		// array('module' => 'jiudian', 'linkcode' => '', 'name' => $this->modules['jiudian'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		array('module' => 'Meirong', 'linkcode' => '', 'name' => $this->modules['Meirong'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1)); 		

		// array('module' => 'Lvyou', 'linkcode' => '', 'name' => $this->modules['Lvyou'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Jianshen', 'linkcode' => '', 'name' => $this->modules['Jianshen'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Wuye', 'linkcode' => '', 'name' => $this->modules['Wuye'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Ktv', 'linkcode' => '', 'name' => $this->modules['Ktv'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Zhengwu', 'linkcode' => '', 'name' => $this->modules['Zhengwu'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
			
		// array('module' => 'Jiuba', 'linkcode' => '', 'name' => $this->modules['Jiuba'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Hunqing', 'linkcode' => '', 'name' => $this->modules['Hunqing'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Zhuangxiu', 'linkcode' => '', 'name' => $this->modules['Zhuangxiu'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Jiaoyu', 'linkcode' => '', 'name' => $this->modules['Jiaoyu'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 
		// array('module' => 'Huadian', 'linkcode' => '', 'name' => $this->modules['Huadian'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1), 	
										
		// array('module' => 'Yiliao', 'linkcode' => '', 'name' => $this->modules['Yiliao'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			
		// array('module'=>'Message','linkcode'=>'/index.php?g=Wap&m=Liuyan&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Message'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'留言','askeyword'=>1)); 
	
	}
	

    public function Classify()

    {

        $this->assign('moduleName', $this->modules['Classify']);

        $db = M('Classify');

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['name'], 'linkcode' => (('/index.php?g=Wap&m=Index&a=lists&token=' . $this->token) . '&wecha_id={wechat_id}&classid=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Img()

    {

        $this->assign('moduleName', $this->modules['Img']);

        $db = M('Img');

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Index&a=content&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Company()

    {

        $this->assign('moduleName', $this->modules['Company']);

        $db = M('Company');

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['name'], 'linkcode' => (('/index.php?g=Wap&m=Company&a=map&token=' . $this->token) . '&wecha_id={wechat_id}&companyid=') . $item['id'], 'linkurl' => '', 'keyword' => '地图'));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Photo()

    {

        $this->assign('moduleName', $this->modules['Photo']);

        $db = M('Photo');

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Photo&a=plist&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Selfform()

    {

        $this->assign('moduleName', $this->modules['Selfform']);

        $db = M('Selfform');

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['name'], 'linkcode' => (('/index.php?g=Wap&m=Selfform&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Host()

    {

        $moduleName = 'Host';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M($moduleName);

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['name'], 'linkcode' => (('/index.php?g=Wap&m=Host&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&hid=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Panorama()

    {

        $this->assign('moduleName', $this->modules['Panorama']);

        $db = M('Panorama');

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('time DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['name'], 'linkcode' => (('/index.php?g=Wap&m=Panorama&a=item&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Wedding()

    {

        $moduleName = 'Wedding';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M($moduleName);

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Wedding&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Lottery()

    {

        $moduleName = 'Lottery';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M($moduleName);

        $where = $this->where;

        $where['type'] = 1;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Lottery&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Guajiang()

    {

        $moduleName = 'Guajiang';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('Lottery');

        $where = $this->where;

        $where['type'] = 2;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Guajiang&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

    public function Coupon()

    {

        $moduleName = 'Coupon';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('Lottery');

        $where = $this->where;

        $where['type'] = 3;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Coupon&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

	public function Zadan()

    {

        $moduleName = 'Zadan';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('Lottery');

        $where = $this->where;

        $where['type'] = 4;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Zadan&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }
	
    public function Vote()

    {

        $moduleName = 'Vote';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M($moduleName);

        $where = $this->where;

        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Vote&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));

            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }
	
	public function jiudian()

    {

        $moduleName = 'jiudian';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('yuyue');

        $where = $this->where;
		$where['type']=$moduleName;
        $count = $db->where($where)->count();

        $Page = new Page($count, 5);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Jiudian&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            }

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }

	public function Meirong()

    {

        $moduleName = 'Meirong';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Meirong';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Meirong&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }
	
    public function Estate()

    {

        $moduleName = 'Estate';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $items = array();

        array_push($items, array('id' => 1, 'name' => '楼盘介绍', 'linkcode' => ('/index.php?g=Wap&m=Estate&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&sgssz=mp.weixin.qq.com', 'linkurl' => '', 'keyword' => '微房产'));

        array_push($items, array('id' => 2, 'name' => '楼盘相册', 'linkcode' => ('/index.php?g=Wap&m=Estate&a=album&token=' . $this->token) . '&wecha_id={wechat_id}&sgssz=mp.weixin.qq.com', 'linkurl' => '', 'keyword' => '微房产'));

        array_push($items, array('id' => 3, 'name' => '户型全景', 'linkcode' => ('/index.php?g=Wap&m=Estate&a=housetype&token=' . $this->token) . '&wecha_id={wechat_id}&sgssz=mp.weixin.qq.com', 'linkurl' => '', 'keyword' => '微房产'));

        array_push($items, array('id' => 4, 'name' => '专家点评', 'linkcode' => ('/index.php?g=Wap&m=Estate&a=impress&token=' . $this->token) . '&wecha_id={wechat_id}&sgssz=mp.weixin.qq.com', 'linkurl' => '', 'keyword' => '微房产'));

        $Estate = M('Estate')->where(array('token' => $this->token))->find();

        $rt = M('Reservation')->where(array('id' => $Estate['res_id']))->find();

        array_push($items, array('id' => 5, 'name' => '看房预约', 'linkcode' => ((('/index.php?g=Wap&m=Reservation&a=index&rid=' . $Estate['res_id']) . '&token=') . $this->token) . '&wecha_id={wechat_id}&sgssz=mp.weixin.qq.com', 'linkurl' => '', 'keyword' => $rt['keyword']));

        $this->assign('list', $items);

        $this->display('detail');

    }
	


	public function Lvyou()

    {

        $moduleName = 'Lvyou';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Lvyou';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Lvyou&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }
	
	public function Jianshen()

    {

        $moduleName = 'Jianshen';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Jianshen';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Jianshen&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }
	
	public function Zhengwu()

    {

        $moduleName = 'Zhengwu';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Zhengwu';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Zhengwu&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }	
	
	public function Wuye()

    {

        $moduleName = 'Wuye';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Wuye';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Wuye&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }	

	public function Ktv()

    {

        $moduleName = 'Ktv';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Ktv';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Ktv&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }	
	
	
	
	public function Jiuba()

    {

        $moduleName = 'Jiuba';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Jiuba';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Jiuba&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }		
	public function Hunqing()

    {

        $moduleName = 'Hunqing';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Hunqing';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Hunqing&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }		
	public function Zhuangxiu()

    {

        $moduleName = 'Zhuangxiu';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Zhuangxiu';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Zhuangxiu&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }		
	public function Jiaoyu()

    {

        $moduleName = 'Jiaoyu';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Jiaoyu';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Jiaoyu&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }		
	public function Huadian()

    {

        $moduleName = 'Huadian';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('estate');

        $where = $this->where;
		
		$where['thetype'] = 'Huadian';

        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Huadian&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }		
	
		
	public function Yiliao()

    {

        $moduleName = 'Yiliao';

        $this->assign('moduleName', $this->modules[$moduleName]);

        $db = M('yuyue');

        $where = $this->where;
		$where['type']=$moduleName;
		
        $count = $db->where($where)->count();

        $Page = new Page($count, 10);

        $show = $Page->show();

        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();

        $items = array();

        if ($list) {

            foreach ($list as $item) {

                array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => (('/index.php?g=Wap&m=Yiliao&a=index&token=' . $this->token) . '&wecha_id={wechat_id}&id=') . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
            } 

        }

        $this->assign('list', $items);

        $this->assign('page', $show);

        $this->display('detail');

    }		
	
}

?>