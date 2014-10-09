<?php
class WeixinAction extends Action 
{
	private $token;
	private $fun;
	private $data = array ();
	private $my = '狗扑软件';
	public function index() 
	{
		$this->token = $this->_get ( 'token' );
		
		$weixin = new Wechat ( $this->token );
		//O:6:"Wechat":1:{s:12:"Wechatdata";a:6:{s:10:"ToUserName";s:15:"gh_2cc1a9895914";s:12:"FromUserName";s:28:"ozq57t-9WQ8hGgTdy_baqSW1DBTk";s:10:"CreateTime";s:10:"1400606894";s:7:"MsgType";s:4:"text";s:7:"Content";s:12:"上海天气";s:5:"MsgId";s:19:"6015560804482315312";}}
		
		$data = $weixin->request ();
		//a:6:{s:10:"ToUserName";s:15:"gh_2cc1a9895914";s:12:"FromUserName";s:28:"ozq57t-9WQ8hGgTdy_baqSW1DBTk";s:10:"CreateTime";s:10:"1400607161";s:7:"MsgType";s:4:"text";s:7:"Content";s:12:"上海天气";s:5:"MsgId";s:19:"6015561951238583346";}
		
		$this->data = $weixin->request ();
		//a:6:{s:10:"ToUserName";s:15:"gh_2cc1a9895914";s:12:"FromUserName";s:28:"ozq57t-9WQ8hGgTdy_baqSW1DBTk";s:10:"CreateTime";s:10:"1400607256";s:7:"MsgType";s:4:"text";s:7:"Content";s:12:"上海天气";s:5:"MsgId";s:19:"6015562359260476470";}
		
		$this->my = C ( 'site_my' );
		list ( $content, $type ) = $this->reply ( $data );
		$weixin->response ( $content, $type );
	}
	private function reply($data) 
	{
		
		$wxuser=M('wxuser')->field ( 'uid' )->where(array("wxid"=>$data['ToUserName']))->order("id desc")->find();
		$viptime=M('users')->field ( 'viptime' )->where(array("id"=>$wxuser['uid']))->find();
		$nowtime=time();
		if(sizeof($wxuser)>0 && $viptime['viptime']<$nowtime){
			return array("狗扑软件提醒您，您的帐号已经过期！请去官方网址:http://wx.weixin.maozi168.cn开通VIP权限继续使用。","text");
		}
		$data2=$data;
		$wxuser_message = M ( 'wxuser_message' )->field ( 'MsgType' )->where ( array (
					
					'ToUserName' => $data2['ToUserName'], 
					'FromUserName' => $data2['FromUserName'], 
					'CreateTime' => $data2['CreateTime'], 
					'MsgType' => $data2['MsgType']
			)
			 )->find ();
		if(!$wxuser_message['MsgType']){
			if($data2['Event']){
				$data2['MsgType']=$data2['Event'];
			}
			M('Wxuser_message')->add($data2);
		}
		if ('CLICK' == $data ['Event']) {
			//file_put_contents("a.txt",1);
			$data ['Content'] = $data ['EventKey'];
		}
		
		if ('subscribe' == $data ['Event']) {
			//file_put_contents("b.txt",1);
			$follow_data ['follow_form_id'] = $data ['FromUserName'];
			
			$follow_data ['follow_to_id'] = $data ['ToUserName'];
			
			$follow_data ['follow_time'] = $data ['CreateTime'];
			
			$foloow_lists = M ( 'Follow' )->add ( $follow_data );
			
			$this->requestdata ( 'follownum' );
			
			$data = M ( 'Areply' )->field ( 'home,keyword,content' )->where ( array (
					
					'token' => $this->token 
			)
			 )
			->find ();
			
			
			if ($data ['keyword'] == '首页' || $data ['keyword'] == 'home') {
				
				return $this->shouye ();
			}
			 if ($data['keyword'] == '微房产') {
                return $this->estate();
            }
             if ($data['keyword'] == '微教育') {
                return $this->jiaoyu();
            }
            if ($data['keyword'] == '微婚庆') {
                return $this->hunqing();
            }
            if ($data['keyword'] == '微政务') {
                return $this->zhengwu();
            }
            if ($data['keyword'] == '微物业') {
                return $this->wuye();
            }
			if ($data ['home'] == 1) {
				
				$like ['keyword'] = array (
						
						'like',
						
						'%' . $data ['keyword'] . '%' 
				)
				;
				
				
				$like ['token'] = $this->token;
				
				$back = M ( 'Img' )->field ( 'id,text,pic,url,title' )->limit ( 9 )->order ( 'id desc' )->where ( $like )->select ();
				
				foreach ( $back as $keya => $infot ) {
					
					if ($infot ['url'] != false) {
						
						$url = $infot ['url'];
					} else {
						
						$url = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Index/content', array (
								
								'token' => $this->token,
								
								'id' => $infot ['id'] 
						)
						 )
						;
					}
					
					$return [] = array (
							
							$infot ['title'],
							
							$infot ['text'],
							
							$infot ['pic'],
							
							$url 
					)
					;
					
				}
				
				return array (
						
						$return,
						
						'news' 
				)
				;
				
			} else {
				
				return array (
						
						$data ['content'],
						
						'text' 
				)
				;
				
			}
		} elseif ('unsubscribe' == $data ['Event']) {
			//file_put_contents("c.txt",1);
			$follow_data ['follow_form_id'] = $data ['FromUserName'];
			
			$follow_data ['follow_to_id'] = $data ['ToUserName'];
			
			$foloow_del = M ( 'Follow' )->where ( $follow_data )->delete ();
			
			$this->requestdata ( 'unfollownum' );
		}
		//上海天气
		$Pin = new GetPin ();
		if (strtolower ( substr ( $data ['Content'], 0, 3 ) ) == "yyy") 
		{
			
			$key = "摇一摇";
			
			$yyyphone = substr ( $data ['Content'], 3, 11 );
		} 
		elseif (substr ( $data ['Content'], 0, 2 ) == "##") 
		{
			
			$key = "微信墙";
			
			$wallmessage = substr_replace ( $data ['Content'], "", 0, 2 );
		}elseif(substr ( $data ['Content'], 0, 6 ) == "快递"){
			$tmp=str_replace("快递","",$data ['Content']);
			$ret=$this->kuaidi($tmp);
			return array($ret,"text");
		}elseif(substr ( $data ['Content'], 0, 6 ) == "手机"){
			$tmp=str_replace("手机","",$data ['Content']);
			$ret=$this->shouji($tmp);
			return array($ret,"text");
		}elseif(substr ( $data ['Content'], 0, 6 ) == "公交"){
			$tmp=str_replace("公交","",$data ['Content']);
			$ret=$this->gongjiao($tmp);
			return array($ret,"text");
		}elseif(substr ( $data ['Content'], 0, 9 ) == "身份证"){
			$tmp=str_replace("身份证","",$data ['Content']);
			$ret=$this->shenfenzheng($tmp);
			return array($ret,"text");
		}elseif(substr ( $data ['Content'], 0, 6 ) == "健康"){
			$tmp=str_replace("健康","",$data ['Content']);
			$ret=$this->jiankang($tmp);
			return array($ret,"text");
		}
		else
			
			$key = $data ['Content'];
		//file_put_contents("as1.txt",$key);
		$open = M ( 'Token_open' )->where ( array (
				
				'token' => $this->_get ( 'token' ) 
		)
		 )
		->find ();
		//tianqi,qiushi,jishuan,langdu,jiankang,kuaidi,xiaohua,changtoushi,peiliao,liaotian,mengjian,yuyinfanyi,huoche,gongjiao,shenfenzheng,shouji,yinle,fujin,choujiang,taobao,userinfo,fanyi,api,suanming,baike,caipiao,choujiang,gua2,shouye,adma,huiyuanka,shenhe,geci,host_kev,diyform,dx,shop,etuan,diymen_set,Panorama,Yuyue,Yiliao,Heka,Jiudian,Diaoyan,Fang,Xitienew,userinfo,dining,LuckyFruit,WeiXitie
		$this->fun = $open ['queryname'];
		//file_put_contents("a1.txt",$this->fun);
		$datafun = explode ( ',', $open ['queryname'] );
		
		$tags = $this->get_tags ( $key );
		//s:13:"上海,天气";
		//分词技术不完整修补
		if(substr($key,0,6)=="计算"){
			$tags=str_replace('计算','计算,',$key);
		}
		
		$back = explode ( ',', $tags );
		foreach ( $back as $keydata => $data ) {
			
			$string = $Pin->Pinyin ( $data );
			//file_put_contents("bb.txt",$string);

			if($string=="shi"){
				$string="qiushi";
			}

			
			if (in_array ( $string, $datafun )) {
				
				$check = $this->user ( 'connectnum' );
				
				if ($string == 'fujin') {
					
					$this->recordLastRequest ( $key );
				}
				
				$this->requestdata ( 'textnum' );
				
				if ($check ['connectnum'] != 1) {
					
					$return = C ( 'connectout' );
					
					continue;
				}
				
				unset ( $back [$keydata] );
				//$return= $this->tianqi($back);
				//file_put_contents("as.txt",'$return= $this->' . $string . '($back);');
				eval ( '$return= $this->' . $string . '($back);' );
				
				continue;
			}
		}
		if (! empty ( $return )) {
			
			if (is_array ( $return )) {
				
				return $return;
			} else {
				
				return array (
						
						$return,
						
						'text' 
				)
				;
				
			}
		} else {
			if ($this->data ['Location_X']) {
				
				$this->recordLastRequest ( $this->data ['Location_Y'] . ',' . $this->data ['Location_X'], 'location' );
				
				return $this->map ( $this->data ['Location_X'], $this->data ['Location_Y'] );
			}
			
			if (! (strpos ( $key, '开车去' ) === FALSE) || ! (strpos ( $key, '坐公交' ) === FALSE) || ! (strpos ( $key, '步行去' ) === FALSE)) {
				
				$this->recordLastRequest ( $key );
				
				$user_request_model = M ( 'User_request' );
				
				$loctionInfo = $user_request_model->where ( array (
						
						'token' => $this->_get ( 'token' ),
						
						'msgtype' => 'location',
						
						'uid' => $this->data ['FromUserName'] 
				)
				 )
				->find ();
				
				if ($loctionInfo && intval ( $loctionInfo ['time'] > (time () - 60) )) {
					
					$latLng = explode ( ',', $loctionInfo ['keyword'] );
					
					return $this->map ( $latLng [1], $latLng [0] );
				}
				
				return array (
						
						'请发送您所在的位置',
						
						'text' 
				)
				;
				
			}
			switch ($key) {
				
				case '首页' :
					
					return $this->home ();
					
					break;
				
				case '主页' :
					
					return $this->home ();
					
					break;
				
				case '地图' :
					
					return $this->companyMap ();
				
				case '微信墙' :
					
					// 判断商家是否开启
					
					$yyy = M ( 'Wewall' )->where ( array (
							
							'isact' => '1',
							
							'token' => $this->token 
					)
					 )->find ();
					
					$welog = array ();
					
					if ($yyy == false) {
						
						return array (
								
								'目前商家未开启微信墙活动',
								
								'text' 
						)
						;
						
					}
					
					// 进入开启状态处理 step1 检查是否需要生成sn码抽奖
					
					$openid = $this->data ['FromUserName'];
					
					$exs = M ( 'Wewalllog' )->where ( array (
							
							'openid' => $openid,
							
							'token' => $this->token 
					)
					 )->find ();
					
					if ($yyy ['iflottery'] == '1' && $exs == false) {
						
						$welog ['sncode'] = $this->sncode ();
					}
					
					$welog ['content'] = $wallmessage;
					
					$welog ['uid'] = $yyy ['id'];
					
					$welog ['token'] = $this->token;
					
					$welog ['updatetime'] = time ();
					
					$welog ['ifsent'] = '0';
					
					$welog ['ifscheck'] = '0';
					
					if ($yyy ['ifcheck'] == '0') 
					{
						
						$welog ['ifcheck'] = '1';
					} 
					else 
					{
						
						$welog ['ifcheck'] = '0';
					}
					
					if ($exs == false) {
						
						$welog ['openid'] = $openid;
						
						M ( 'Wewalllog' )->add ( $welog );
						
						$sncode = $welog ['sncode'];
					} 
					else 
					{
						
						M ( 'Wewalllog' )->where ( array (
								
								'openid' => $openid,
								
								'token' => $this->token 
						)
						 )->save ( $welog );
						
						$sncode = $exs ['sncode'];
					}
					
					if ($yyy ['iflottery'] == '1') {
						
						return array (
								
								'上墙成功！获得sn号码为[' . $sncode . '],请留意抽奖环节哦',
								
								'text' 
						)
						;
						
					} 
					else {
						
						return array (
								
								'上墙成功！祝君万事如意',
								
								'text' 
						)
						;
						
					}
				
				case '摇一摇' :
					
					$yyy = M ( 'Shake' )->where ( array (
							
							'isopen' => '1',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					if ($yyy == false) {
						
						return array (
								
								'目前没有正在进行中的摇一摇活动',
								
								'text' 
						)
						;
						
					}
					
					/*
					 * if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$yyyphone)){ return array( '拜托遵守规则好吗，请输入yyy加您的手机号码，例如yyy13647810523', 'text' ); }
					 */
					
					$url = C ( 'site_url' ) . U ( 'Wap/Toshake/index', array (
							
							'token' => $this->token,
							
							'phone' => $yyyphone,
							
							'wecha_id' => $this->data ['FromUserName'] 
					)
					 )
					;
					
					return array (
							
							'<a href="' . $url . '">点击进入刺激的现场摇一摇活动</a>',
							
							'text' 
					)
					;
					
				
				case '最近的' :
					
					$this->recordLastRequest ( $key );
					
					$user_request_model = M ( 'User_request' );
					
					$loctionInfo = $user_request_model->where ( array (
							
							'token' => $this->_get ( 'token' ),
							
							'msgtype' => 'location',
							
							'uid' => $this->data ['FromUserName'] 
					)
					 )
					->find ();
					
					if ($loctionInfo && intval ( $loctionInfo ['time'] > (time () - 60) )) {
						
						$latLng = explode ( ',', $loctionInfo ['keyword'] );
						
						return $this->map ( $latLng [1], $latLng [0] );
					}
					
					return array (
							
							'请发送您所在的位置',
							
							'text' 
					)
					;
					
					
					break;
				
				case '帮助' :
					
					return $this->help ();
					
					break;
				
				case '笑话' :
					
					return $this->xiaohua ();
					
					break;
				
				case '快递' :
					
					return $this->kuaidi ();
					
					break;
				
				case '公交' :
					
					return $this->gongjiao ();
					
					break;
				
				case '火车' :
					
					return $this->huoche ();
					
					break;
				
				case 'help' :
					
					return $this->help ();
					
					break;
				
				case '会员卡' :
					
					return $this->member ();
					
					break;
				
				case '身份证' :
					
					return $this->shenfenzheng ();
					
					break;
				
				case '会员' :
					
					return $this->member ();
					
					break;
				
				case '3g相册' :
					
					return $this->xiangce ();
					
					break;
				
				case '相册' :
					
					return $this->xiangce ();
					
					break;
				
				// case '留言':
				
				// return $this->liuyan();
				
				// break;
				   case '婚庆喜帖':
                $url = C('site_url') . U('Wap/Wedding/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName'],
                    'id' => $urlInfos[1]
                ));
                break;
				case '微喜帖' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Xitie',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					if ($pro ['apiurl'] == false) {
						
						$url = C ( 'site_url' ) . '/index.php?g=Wap&m=Xitie&a=index&token=' . $this->token . '&id=' . $xitie ['id'];
					} else {
						
						$url = $pro ['apiurl'];
					}
					
					if ($pro == false) {
						
						return array (
								
								'商家未开通微喜帖或未做回复配置，请稍后再试',
								
								'text' 
						)
						;
						
					}
					
					$xitie = M ( 'xitie' )->order ( 'id', 'DESC' )->limit ( "0,1" )->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											$url 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case '商城':
                    /*$pro = M('product')->where(array(
                        'groupon' => '0',
                        'dining' => '0',
                        'token' => $this->token
                    ))->find();
                    return array(
                        array(
                            array(
                                $pro['name'],
                                strip_tags(htmlspecialchars_decode($pro['intro'])),
                                $pro['logourl'],
                                C('site_url') . '/index.php?g=Wap&m=Product&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );*/
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Shop',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Store&a=cats&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				       case '微房产':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'Estate'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Estate&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                case '微教育':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'jiaoyu'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Jiaoyu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                   case '微婚庆':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'hunqing'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Hunqing&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                    case '微政务':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'zhengwu'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Zhengwu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                     case '微物业':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'wuye'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Wuye&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                    
                case '微美容':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'meirong'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Meirong&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 case '微旅游':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'lvyou'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Lvyou&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 case '微健身':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'jianshen'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Jianshen&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 
                 case '微KTV':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'ktv'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Ktv&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                    
                case '微酒吧':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'jiuba'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Jiuba&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 
                 case '微装修':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'zhuangxiu'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Zhuangxiu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                  case '微花店':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'huadian'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                               C ( 'site_url' ) . '/index.php?g=Wap&m=Huadian&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
				case '全景' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Panorama',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Panorama&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case '留言' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Liuyan',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Liuyan&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case '预约' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Yuyue',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Yuyue&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'aaa' :
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case '订餐' :
					
					$pro = M('reply_info')->where(array('infotype' => 'Dining', 'token' => $this->token))->find();
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], ((((C('site_url') . '/index.php?g=Wap&m=Dining&a=index&dining=1&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']))), 'news');
                break;
				
				case '团购':
                    /*$pro = M('product')->where(array(
                        'groupon' => '1',
                        'token' => $this->token
                    ))->find();
                    return array(
                        array(
                            array(
                                $pro['name'],
                                strip_tags(htmlspecialchars_decode($pro['intro'])),
                                $pro['logourl'],
                                C('site_url') . '/index.php?g=Wap&m=Groupon&a=grouponIndex&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
					*/
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Groupon',
							
							'token' => $this->token 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Groupon&a=grouponIndex&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				 case '讨论社区': case '论坛': $fconfig = M('Forum_config') -> where(array('token' => $this -> token)) -> find();
                return array(array(array($fconfig['forumname'], str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($fconfig['intro']))), $fconfig['picurl'], C('site_url') . '/index.php?g=Wap&m=Forum&a=index&&token=' . $this -> token . '&wecha_id=' . $this -> data['FromUserName'])), 'news');
				
				default :
					//file_put_contents("a6.txt",$key);
					$check = $this->user ( 'diynum', $key );
					
					if ($check ['diynum'] != 1) {
						
						return array (
								
								C ( 'connectout' ),
								
								'text' 
						)
						;
						
					} else {
						//file_put_contents("a7.txt",$key);
						//file_put_contents("a8.txt",serialize($this->keyword));
						//file_put_contents("a9.txt",serialize($this->keyword ( $key )));
						return $this->keyword ( $key );
					}
			}
		}
	}
	function xiangce() 
	{
		$photo = M ( 'Photo' )->where ( array (
				
				'token' => $this->token,
				
				'status' => 1 
		)
		 )
		->find ();
		
		$data ['title'] = $photo ['title'];
		
		$data ['keyword'] = $photo ['info'];
		
		$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Photo/index', array (
				
				'token' => $this->token,
				
				'wecha_id' => $this->data ['FromUserName'] 
		)
		 )
		;
		
		$data ['picurl'] = $photo ['picurl'] ? $photo ['picurl'] : rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/yj.jpg';
		
		return array (
				
				array (
						
						array (
								
								$data ['title'],
								
								$data ['keyword'],
								
								$data ['picurl'],
								
								$data ['url'] 
						)
						 
				)
				,
				
				'news' 
		)
		;
		
	}
	
	// function liuyan(){
	
	// $liuyan = M('liuyan')->where(array(
	
	// 'token' => $this->token,
	
	// 'status' => 1
	
	// ))->find();
	
	// $data['title'] = $liuyan['title'];
	
	// $data['keyword'] = $liuyan['keyword'];
	
	// $data['url'] = rtrim(C('site_url'), '/') . U('Wap/Liuyan/index', array(
	
	// 'token' => $this->token,
	
	// 'wecha_id' => $this->data['FromUserName']
	
	// ));
	
	// $data['pic'] = $liuyan['pic'] ? $liuyan['pic'] : rtrim(C('site_url'), '/') . '/tpl/static/images/02.jpg';
	
	// return array(
	
	// array(
	
	// array(
	
	// $data['title'],
	
	// $data['keyword'],
	
	// $data['pic'],
	
	// $data['url']
	
	// )
	
	// ),
	
	// 'news'
	
	// );
	
	// }
	function companyMap() 
	{
		import ( "Home.Action.MapAction" );
		
		$mapAction = new MapAction ();
		
		return $mapAction->staticCompanyMap ();
	}
	function shenhe($name) 
	{
		$name = implode ( '', $name );
		
		if (empty ( $name )) {
			
			return '正确的审核帐号方式是：审核+帐号';
		} else {
			
			$user = M ( 'Users' )->field ( 'id' )->where ( array (
					
					'username' => $name 
			)
			 )
			->find ();
			
			if ($user == false) {
				
				return '主人' . $this->my . "提醒您,您还没注册吧\n正确的审核帐号方式是：审核+帐号,不含+号\n您的账号也可能尚未通过审核，请拨打13921492881联系技术代表";
			} else {
				
				$up = M ( 'users' )->where ( array (
						
						'id' => $user ['id'] 
				)
				 )
				->save ( array (
						
						'status' => 1,
						
						'viptime' => strtotime ( "+1 day" ) 
				)
				 )
				;
				
				if ($up != false) {
					
					return '主人' . $this->my . '恭喜您,您的帐号已经审核,您现在可以登陆微赢平台使用最强的功能啦!';
				} else {
					
					return '服务器繁忙请稍后再试';
				}
			}
		}
	}
	function huiyuanka($name) 
	{
		return $this->member ();
	}
	function member() {
		$card = M ( 'member_card_create' )->where ( array (
				
				'token' => $this->token,
				
				'wecha_id' => $this->data ['FromUserName'] 
		)
		 )->find ();
		
		$cardInfo = M ( 'member_card_set' )->where ( array (
				
				'token' => $this->token 
		)
		 )->find ();
		
		// $this->behaviordata ( 'Member_card_set', $cardInfo ['id'] );
		
		$reply_info_db = M ( 'Reply_info' );
		
		if ($card == false) {
			
			$where_member = array (
					
					'token' => $this->token,
					
					'infotype' => 'membercard' 
			)
			;
			
			$memberConfig = $reply_info_db->where ( $where_member )->find ();
			
			if (! $memberConfig) {
				
				$memberConfig = array ();
				
				$memberConfig ['picurl'] = rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/member.jpg';
				
				$memberConfig ['title'] = '会员卡,省钱，打折,促销，优先知道,有奖励哦';
				
				$memberConfig ['info'] = '尊贵vip，是您消费身份的体现,会员卡,省钱，打折,促销，优先知道,有奖励哦';
			}
			
			$data ['picurl'] = $memberConfig ['picurl'];
			
			$data ['title'] = $memberConfig ['title'];
			
			$data ['keyword'] = $memberConfig ['info'];
			
			if (! $memberConfig ['apiurl']) {
				
				$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Card/index', array (
						
						'token' => $this->token,
						
						'wecha_id' => $this->data ['FromUserName'] 
				)
				 );
			} else {
				
				$data ['url'] = str_replace ( '{wechat_id}', $this->data ['FromUserName'], $memberConfig ['apiurl'] );
			}
		} else {
			
			$where_unmember = array (
					
					'token' => $this->token,
					
					'infotype' => 'membercard_nouse' 
			)
			;
			
			$unmemberConfig = $reply_info_db->where ( $where_unmember )->find ();
			
			if (! $unmemberConfig) {
				
				$unmemberConfig = array ();
				
				$unmemberConfig ['picurl'] = rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/vip.jpg';
				
				$unmemberConfig ['title'] = '申请成为会员';
				
				$unmemberConfig ['info'] = '申请成为会员，享受更多优惠';
			}
			
			$data ['picurl'] = $unmemberConfig ['picurl'];
			
			$data ['title'] = $unmemberConfig ['title'];
			
			$data ['keyword'] = $unmemberConfig ['info'];
			
			if (! $unmemberConfig ['apiurl']) {
				
				$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Card/index', array (
						
						'token' => $this->token,
						
						'wecha_id' => $this->data ['FromUserName'] 
				)
				 );
			} else {
				
				$data ['url'] = str_replace ( '{wechat_id}', $this->data ['FromUserName'], $unmemberConfig ['apiurl'] );
			}
		}
		
		return array (
				
				array (
						
						array (
								
								$data ['title'],
								
								$data ['keyword'],
								
								$data ['picurl'],
								
								$data ['url'] 
						)
						 
				)
				,
				
				'news' 
		)
		;
		
	}
	
	/*
	 * function member() { $card = M ( 'member_card_create' )->where ( array ( 'token' => $this->token, 'wecha_id' => $this->data ['FromUserName'] ) )->find (); $cardInfo = M ( 'member_card_set' )->where ( array ( 'token' => $this->token ) )->find (); if ($card == false) { $data ['picurl'] = rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/member.jpg'; $data ['title'] = '会员卡,省钱，打折,促销，优先知道,有奖励哦'; $data ['keyword'] = '尊贵vip，是您消费身份的体现,会员卡,省钱，打折,促销，优先知道,有奖励哦'; $data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Card/get_card', array ( 'token' => $this->token, 'wecha_id' => $this->data ['FromUserName'] ) ); } else { $data ['picurl'] = rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/vip.jpg'; $data ['title'] = $cardInfo ['cardname']; $data ['keyword'] = $cardInfo ['msg']; $data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Card/vip', array ( 'token' => $this->token, 'wecha_id' => $this->data ['FromUserName'] ) ); }
	 */
	
	// return array (
	
	// array (
	
	// array (
	
	// $data ['title'],
	
	// $data ['keyword'],
	
	// $data ['picurl'],
	
	// $data ['url']
	
	// )
	
	// )
	
	// ,
	
	// 'news'
	
	// )
	
	// ;
	
	// }
	function taobao($name) 
	{
		$name = array_merge ( $name );
		
		$data = M ( 'Taobao' )->where ( array (
				
				'token' => $this->token 
		)
		 )
		->find ();
		
		if ($data != false) {
			
			if (strpos ( $data ['keyword'], $name )) {
				
				$url = $data ['homeurl'] . '/search.htm?search=y&keyword=' . $name . '&lowPrice=&highPrice=';
			} else {
				
				$url = $data ['homeurl'];
			}
			
			return array (
					
					array (
							
							array (
									
									$data ['title'],
									
									$data ['keyword'],
									
									$data ['picurl'],
									
									$url 
							)
							 
					)
					,
					
					'news' 
			)
			;
			
		} else {
			
			return '商家还未及时更新淘宝店铺的信息,回复帮助,查看功能详情';
		}
	}
	function choujiang($name) 
	{
		$data = M ( 'lottery' )->field ( 'id,keyword,info,title,starpicurl' )->where ( array (
				
				'token' => $this->token,
				
				'status' => 1,
				
				'type' => 1 
		)
		 )
		->order ( 'id desc' )->find ();
		
		if ($data == false) {
			
			return array (
					
					'暂无抽奖活动',
					
					'text' 
			)
			;
			
		}
		
		$pic = $data ['starpicurl'] ? $data ['starpicurl'] : rtrim ( C ( 'site_url' ), '/' ) . '/tpl/User/default/common/images/img/activity-lottery-start.jpg';
		
		$url = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Lottery/index', array (
				
				'type' => 1,
				
				'token' => $this->token,
				
				'id' => $data ['id'],
				
				'wecha_id' => $this->data ['FromUserName'] 
		)
		 )
		;
		
		return array (
				
				array (
						
						array (
								
								$data ['title'],
								
								$data ['info'],
								
								$pic,
								
								$url 
						)
						 
				)
				,
				
				'news' 
		)
		;
		
	}
	function keyword($key) 
	{
		$like ['keyword'] = array (
				
				'like',
				
				'%' . $key . '%' 
		)
		;
		
		
		$like ['token'] = $this->token;
		
		$data = M ( 'keyword' )->where ( $like )->order ( 'id desc' )->find ();
		//file_put_contents("a10.txt",serialize($data));
		if ($data != false) {
			switch ($data ['module']) {
				
				case 'Img' :
					
					$this->requestdata ( 'imgnum' );
					
					$img_db = M ( $data ['module'] );
					
					$back = $img_db->field ( 'id,text,pic,url,title' )->limit ( 9 )->order ( 'sorts desc' )->where ( $like )->select ();
					
					$idsWhere = 'id in (';
					
					$comma = '';
					
					foreach ( $back as $keya => $infot ) {
						
						$idsWhere .= $comma . $infot ['id'];
						
						$comma = ',';
						
						if ($infot ['url'] != false) {
							
							if (! (strpos ( $infot ['url'], 'http' ) === FALSE)) {
								
								$url = $infot ['url'];
							} else {
								
								$urlInfos = explode ( ' ', $infot ['url'] );
								
								switch ($urlInfos [0]) {
									
									case '刮刮卡' :
										
										$url = C ( 'site_url' ) . U ( 'Wap/Guajiang/index', array (
												
												'token' => $this->token,
												
												'wecha_id' => $this->data ['FromUserName'],
												
												'id' => $urlInfos [1] 
										)
										 )
										;
										
										break;
									
									case '砸金蛋' :
										
										$url = C ( 'site_url' ) . U ( 'Wap/Zadan/index', array (
												
												'token' => $this->token,
												
												'wecha_id' => $this->data ['FromUserName'],
												
												'id' => $urlInfos [1] 
										)
										 )
										;
										
										break;
									
									case '大转盘' :
										
										$url = C ( 'site_url' ) . U ( 'Wap/Lottery/index', array (
												
												'token' => $this->token,
												
												'wecha_id' => $this->data ['FromUserName'],
												
												'id' => $urlInfos [1] 
										)
										 )
										;
										
										break;
									
									case '商家订单' :
										
										$url = C ( 'site_url' ) . '/index.php?g=Wap&m=Host&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&hid=' . $urlInfos [1] . '&sgssz=mp.weixin.qq.com';
										
										break;
									
									case '优惠券' :
										
										$url = C ( 'site_url' ) . U ( 'Wap/Coupon/index', array (
												
												'token' => $this->token,
												
												'wecha_id' => $this->data ['FromUserName'],
												
												'id' => $urlInfos [1] 
										)
										 )
										;
										
										break;
								}
							}
						} else {
							
							$url = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Index/content', array (
									
									'token' => $this->token,
									
									'id' => $infot ['id'] 
							)
							 )
							;
						}
						
						// 这里修改过
						
						$return [] = array (
								
								$infot ['title'],
								
								$infot ['text'],
								
								$infot ['pic'],
								
								$url 
						)
						;
						
					}
					
					$idsWhere .= ')';
					
					if ($back) {
						
						$img_db->where ( $idsWhere )->setInc ( 'click' );
					}
					//file_put_contents("a11.txt",serialize($return));
					/**
					Array ( [0] => Array ( [0] => 10101010101 [1] => 1010101010 [2] => http://www.zseom.com/uploads/b/b626ad7f2067867/55//b/8/thumb_536455501ad76.png [3] => http://www.zseom.com/index.php?g=Wap&m=Index&a=content&token=b626ad7f2067867&id=52 ) [1] => Array ( [0] => 11111111111111 [1] => 111111111111 [2] => http://www.zseom.com/uploads/b/b626ad7f2067867/5/5/b/8/thumb_536455501ad76.png [3] => http://www.zseom.com/index.php?g=Wap&m=Index&a=content&token=b626ad7f2067867&id=44 ) [2] => Array ( [0] => 333333333333333 [1] => 3333333333333333333 [2] => [3] => http://www.zseom.com/index.php?g=Wap&m=Index&a=content&token=b626ad7f2067867&id=44 ) )
					*/
					return array (
							
							$return,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Host' :
					
					$this->requestdata ( 'other' );
					
					$host = M ( 'Host' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$host ['name'],
											
											$host ['info'],
											
											$host ['ppicurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Host&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&hid=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Text' :
					
					$this->requestdata ( 'textnum' );
					
					$info = M ( $data ['module'] )->order ( 'id desc' )->find ( $data ['pid'] );
					
					return array (
							
							htmlspecialchars_decode ( $info ['text'] ),
							
							'text' 
					)
					;
					
					
					break;
				
				case 'Product' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'Product' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['name'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['intro'] ) ),
											
											$pro ['logourl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Product&a=product&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Vote' :
					
					$this->requestdata ( 'other' );
					
					$Vote = M ( 'Vote' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$Vote ['title'],
											
											str_replace ( '&nbsp;', ' ', strip_tags ( htmlspecialchars_decode ( $Vote ['info'] ) ) ),
											
											$Vote ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Vote&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Xitie' :
					
					$this->requestdata ( 'other' );
					
					$info = M ( 'Xitie' )->find ( $data ['pid'] );
					
					if ($info == false) {
						
						return array (
								
								'商家未做微喜帖回复配置，请稍后再试',
								
								'text' 
						)
						;
						
					}
					
					$id = $info ['id'];
					
					$picurl = $info ['replypicurl'];
					
					$title = $info ['title'];
					
					$info = $info ['hua'];
					
					$url = C ( 'site_url' ) . U ( 'Wap/Xitie/index', array (
							
							'token' => $this->token,
							
							'id' => $id 
					)
					 )
					;
					
					return array (
							
							array (
									
									array (
											
											$title,
											
											$info,
											
											$picurl,
											
											$url 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
					case 'Wedding' :
					 $this->requestdata('other');
                    $wedding = M('Wedding')->where(array(
                        'id' => $data['pid']
                    ))->find();
                    return array(
                        array(
                            array(
                                $wedding['title'],
                                strip_tags(htmlspecialchars_decode($wedding['word'])),
                                $wedding['coverurl'],
                                C('site_url') . '/index.php?g=Wap&m=Wedding&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&sgssz=mp.weixin.qq.com'
                            ),
                            array(
                                '查看我的祝福',
                                strip_tags(htmlspecialchars_decode($wedding['word'])),
                                $wedding['picurl'],
                                C('site_url') . '/index.php?g=Wap&m=Wedding&a=check&type=1&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&sgssz=mp.weixin.qq.com'
                            ),
                            array(
                                '查看我的来宾',
                                strip_tags(htmlspecialchars_decode($wedding['word'])),
                                $wedding['picurl'],
                                C('site_url') . '/index.php?g=Wap&m=Wedding&a=check&type=2&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;	
						
						
				
					
						return array (
									
								array (
											
										array (
													
												$title,
													
												$info,
													
												$picurl,
													
												$url
										)
					
								)
								,
									
								'news'
						)
						;
					
							
							
						break;
					
				case 'Reservation' :
					
					$this->requestdata ( 'other' );
					
					$rt = M ( 'Reservation' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$rt ['title'],
											
											$rt ['info'],
											
											$rt ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Reservation&a=index&rid=' . $data ['pid'] . '&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Xitienew' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'Xitienew' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['message'] ) ),
											
											$pro ['pic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Xitienew&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Yiliao' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'yuyue' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['topic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Yiliao&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Yuyue' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'yuyue' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['topic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Yuyue&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Jiudian' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'yuyue' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['topic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Jiudian&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Canting' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'yuyue' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['topic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Canting&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				
				
				case 'Diaoyan' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'diaoyan' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['sinfo'] ) ),
											
											$pro ['pic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Diaoyan&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				case 'Heka' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'heka' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['sinfo'] ) ),
											
											$pro ['topic'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Heka&a=index&id=&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				
				
		
				
				case 'Selfform' :
					
					$this->requestdata ( 'other' );
					
					$pro = M ( 'Selfform' )->where ( array (
							
							'id' => $data ['pid'] 
					)
					 )
					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['name'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['intro'] ) ),
											
											$pro ['logourl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Selfform&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
					
					break;
				
				 case 'Estate':
                    return $this->estate();
                 case 'Jiaoyu':
                    return $this->jiaoyu();
                 case 'Hunqing':
                    return $this->hunqing();
                 case 'Zhengwu':
                    return $this->zhengwu();
                 case 'Wuye':
                    return $this->wuye();
                 case 'Meirong':
                    return $this->meirong();
                 case 'Lvyou':
                    return $this->Lvyou();
                 case 'Jianshen':
                    return $this->jianshen();
                 case 'Ktv':
                    return $this->ktv();
                  case 'Jiuba':
                    return $this->jiuba();
                  case 'Zhuangxiu':
                    return $this->zhuangxiu();
                  case 'Huadian':
                    return $this->huadian();
				case 'Lottery' :
					
					$this->requestdata ( 'other' );
					
					$info = M ( 'Lottery' )->find ( $data ['pid'] );
					
					if ($info == false || $info ['status'] == 3) {
						
						return array (
								
								'活动可能已经结束或者被删除了',
								
								'text' 
						)
						;
						
					}
					
					switch ($info ['type']) {
						
						case 1 :
							
							$model = 'Lottery';
							
							break;
						
						case 2 :
							
							$model = 'Guajiang';
							
							break;
						
						case 3 :
							
							$model = 'Coupon';
							
							break;
						
						case 4 :
							
							$model = 'Zadan';
					}
					
					$id = $info ['id'];
					
					$type = $info ['type'];
					
					if ($info ['status'] == 1) {
						
						$picurl = $info ['starpicurl'];
						
						$title = $info ['title'];
						
						$id = $info ['id'];
						
						$info = $info ['info'];
					} else {
						
						$picurl = $info ['endpicurl'];
						
						$title = $info ['endtite'];
						
						$info = $info ['endinfo'];
					}
					
					$url = C ( 'site_url' ) . U ( 'Wap/' . $model . '/index', array (
							
							'token' => $this->token,
							
							'type' => $type,
							
							'wecha_id' => $this->data ['FromUserName'],
							
							'id' => $id,
							
							'type' => $type 
					)
					 )
					;
					
					return array (
							
							array (
									
									array (
											
											$title,
											
											$info,
											
											$picurl,
											
											$url 
									)
									 
							)
							,
							
							'news' 
					)
					;
					
				
				default :
					
					$this->requestdata ( 'videonum' );
					
					$info = M ( $data ['module'] )->order ( 'id desc' )->find ( $data ['pid'] );
					
					return array (
							
							array (
									
									$info ['title'],
									
									$info ['keyword'],
									
									$info ['musicurl'],
									
									$info ['hqmusicurl'] 
							)
							,
							
							'music' 
					)
					;
					
			}
		} else {
			
			if (! strpos ( $this->fun, 'liaotian' )) {
				file_put_contents("a13.txt",$this->fun);
				$other = M ( 'Other' )->where ( array (
						
						'token' => $this->token 
				)
				 )
				->find ();
				
				if ($other == false) {
					
					return array (
							
							'回复帮助，可了解所有功能',
							
							'text' 
					)
					;
					
				} else {
					
					if (empty ( $other ['keyword'] )) {
						
						return array (
								
								$other ['info'],
								
								'text' 
						)
						;
						
					} else {
						
						$img = M ( 'Img' )->field ( 'id,text,pic,url,title' )->limit ( 5 )->order ( 'id desc' )->where ( array (
								
								'token' => $this->token,
								
								'keyword' => array (
										
										'like',
										
										'%' . $other ['keyword'] . '%' 
								)
								 
						)
						 )
						->select ();
						
						if ($img == false) {
							
							return array (
									
									'',
									
									'text' 
							)
							;
							
						}
						
						foreach ( $img as $keya => $infot ) {
							
							if ($infot ['url'] != false) {
								
								$url = $infot ['url'];
							} else {
								
								$url = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Index/content', array (
										
										'token' => $this->token,
										
										'id' => $infot ['id'] 
								)
								 )
								;
							}
							
							$return [] = array (
									
									$infot ['title'],
									
									$infot ['text'],
									
									$infot ['pic'],
									
									$url 
							)
							;
							
						}
						
						return array (
								
								$return,
								
								'news' 
						)
						;
						
					}
				}
			}
			
			return array (
					
					$this->chat ( $key ),
					
					'text' 
			)
			;
			
		}
	}
	function home() 
	{
		return $this->shouye ();
	}
	function shouye($name) 
	{
		$home = M ( 'Home' )->where ( array (
				
				'token' => $this->token 
		)
		 )
		->find ();
		
		if ($home == false) {
			
			return array (
					
					'商家未做首页配置，请稍后再试',
					
					'text' 
			)
			;
			
		} else {
			
			if ($home ['apiurl'] == false) {
				
				$url = rtrim ( C ( 'site_url' ), '/' ) . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com';
			} else {
				
				$url = $home ['apiurl'];
			}
		}
		
		return array (
				
				array (
						
						array (
								
								$home ['title'],
								
								$home ['info'],
								
								$home ['picurl'],
								
								$url 
						)
						 
				)
				,
				
				'news' 
		)
		;
		
	}
	 function estate($name)
    {
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微房产模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Estate&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function jiaoyu($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'jiaoyu'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微教育模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Jiaoyu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function hunqing($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'hunqing'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微婚庆模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Hunqing&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function zhengwu($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'zhengwu'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置政务模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Zhengwu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function wuye($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'wuye'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置物业模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Wuye&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function meirong($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'meirong'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微美容模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Meirong&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
   function lvyou($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'lvyou'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微教育模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Lvyou&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function jianshen($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'jianshen'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微健身模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Jianshen&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function ktv($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'ktv'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微教育模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Ktv&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    
    function jiuba($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'jiuba'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微教育模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Jiuba&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function zhuangxiu($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'zhuangxiu'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微装修模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Zhuangxiu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    
    function huadian($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'huadian'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微教育模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Huadian&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
	function kuaidi($data) 
	{
		//$data = array_merge ( $data );
		$data=$this->get_tags($data);
		
		$arr = explode(",",$data);
		$str = file_get_contents ( 'http://www.weinxinma.com/api/index.php?m=Express&a=index&name=' . $arr[0] . '&number=' . $arr[1] . '&sgssz=mp.weixin.qq.com' );
		return $str;
	}
	function langdu($data) 
	{
		$data = implode ( '', $data );
		
		$mp3url = 'http://www.apiwx.com/aaa.php?w=' . urlencode ( $data );
		
		return array (
				
				array (
						
						$data,
						
						'点听收听',
						
						$mp3url,
						
						$mp3url 
				)
				,
				
				'music' 
		)
		;
		
	}
	function jiankang($data) 
	{
		if (empty ( $data ))
			
			return '主人，' . $this->my . "提醒您\n正确的查询方式是:\n健康+身高,+体重\n例如：健康170,65";
		$data=	str_replace('，',',',$data);
		$data=explode(",",$data);
		$height = $data [0] / 100;
		$weight = $data [1];
		
		$Broca = ($height * 100 - 80) * 0.7;
		
		$kaluli = 66 + 13.7 * $weight + 5 * $height * 100 - 6.8 * 25;
		
		$chao = $weight - $Broca;
		
		$zhibiao = $chao * 0.1;
		
		$res = round ( $weight / ($height * $height), 1 );
		
		if ($res < 18.5) {
			
			$info = '您的体形属于骨感型，需要增加体重' . $chao . '公斤哦!';
			
			$pic = 1;
		} elseif ($res < 24) {
			
			$info = '您的体形属于圆滑型的身材，需要减少体重' . $chao . '公斤哦!';
		} elseif ($res > 24) {
			
			$info = '您的体形属于肥胖型，需要减少体重' . $chao . '公斤哦!';
		} elseif ($res > 28) {
			
			$info = '您的体形属于严重肥胖，请加强锻炼，或者使用我们推荐的减肥方案进行减肥';
		}
		
		return $info;
	}
	function fujin($keyword) 
	{
		$keyword = implode ( '', $keyword );
		
		if ($keyword == false) {
			
			return $this->my . "很难过,无法识别主淫的指令,正确使用方法是:输入【附近+关键词】当" . $this->my . '提醒您输入地理位置的时候就OK啦';
		}
		
		$data = array ();
		
		$data ['time'] = time ();
		
		$data ['token'] = $this->_get ( 'token' );
		
		$data ['keyword'] = $keyword;
		
		$data ['uid'] = $this->data ['FromUserName'];
		
		$re = M ( 'Nearby_user' );
		
		$user = $re->where ( array (
				
				'token' => $this->_get ( 'token' ),
				
				'uid' => $data ['uid'] 
		)
		 )
		->find ();
		
		if ($user == false) {
			
			$re->data ( $data )->add ();
		} else {
			
			$id ['id'] = $user ['id'];
			
			$re->where ( $id )->save ( $data );
		}
		
		return "主淫【" . $this->my . "】已经接收到你的指令\n请发送您的地理位置给我哈";
	}
	function recordLastRequest($key, $msgtype = 'text') 
	{
		$rdata = array ();
		
		$rdata ['time'] = time ();
		
		$rdata ['token'] = $this->_get ( 'token' );
		
		$rdata ['keyword'] = $key;
		
		$rdata ['msgtype'] = $msgtype;
		
		$rdata ['uid'] = $this->data ['FromUserName'];
		
		$user_request_model = M ( 'User_request' );
		
		$user_request_row = $user_request_model->where ( array (
				
				'token' => $this->_get ( 'token' ),
				
				'msgtype' => $msgtype,
				
				'uid' => $rdata ['uid'] 
		)
		 )
		->find ();
		
		if (! $user_request_row) {
			
			$user_request_model->add ( $rdata );
		} else {
			
			$rid ['id'] = $user_request_row ['id'];
			
			$user_request_model->where ( $rid )->save ( $rdata );
		}
	}
	function map($x, $y) 
	{
		$user_request_model = M ( 'User_request' );
		
		$user_request_row = $user_request_model->where ( array (
				
				'token' => $this->_get ( 'token' ),
				
				'msgtype' => 'text',
				
				'uid' => $this->data ['FromUserName'] 
		)
		 )
		->find ();
		
		if (! (strpos ( $user_request_row ['keyword'], '附近' ) === FALSE)) {
			
			$user = M ( 'Nearby_user' )->where ( array (
					
					'token' => $this->_get ( 'token' ),
					
					'uid' => $this->data ['FromUserName'] 
			)
			 )
			->find ();
			
			$keyword = $user ['keyword'];
			
			$radius = 2000;
			
			$str = file_get_contents ( C ( 'site_url' ) . '/map.php?keyword=' . urlencode ( $keyword ) . '&x=' . $x . '&y=' . $y );
			
			$array = json_decode ( $str );
			
			$map = array ();
			
			foreach ( $array as $key => $vo ) {
				
				$map [] = array (
						
						$vo->title,
						
						$key,
						
						rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/home.jpg',
						
						$vo->url 
				)
				;
				
			}
			
			return array (
					
					$map,
					
					'news' 
			)
			;
			
		} else {
			
			import ( "Home.Action.MapAction" );
			
			$mapAction = new MapAction ();
			
			if (! (strpos ( $user_request_row ['keyword'], '开车去' ) === FALSE) || ! (strpos ( $user_request_row ['keyword'], '坐公交' ) === FALSE) || ! (strpos ( $user_request_row ['keyword'], '步行去' ) === FALSE)) {
				
				if (! (strpos ( $user_request_row ['keyword'], '步行去' ) === FALSE)) {
					
					$companyid = str_replace ( '步行去', '', $user_request_row ['keyword'] );
					
					if (! $companyid) {
						
						$companyid = 1;
					}
					
					return $mapAction->walk ( $x, $y, $companyid );
				}
				
				if (! (strpos ( $user_request_row ['keyword'], '开车去' ) === FALSE)) {
					
					$companyid = str_replace ( '开车去', '', $user_request_row ['keyword'] );
					
					if (! $companyid) {
						
						$companyid = 1;
					}
					
					return $mapAction->drive ( $x, $y, $companyid );
				}
				
				if (! (strpos ( $user_request_row ['keyword'], '坐公交' ) === FALSE)) {
					
					$companyid = str_replace ( '坐公交', '', $user_request_row ['keyword'] );
					
					if (! $companyid) {
						
						$companyid = 1;
					}
					
					return $mapAction->bus ( $x, $y, $companyid );
				}
			} else {
				
				switch ($user_request_row ['keyword']) {
					
					case '最近的' :
						
						return $mapAction->nearest ( $x, $y );
						
						break;
				}
			}
		}
	}
	function suanming($name) 
	{
		$name = implode ( '', $name );
		
		if (empty ( $name )) {
			
			return '主人' . $this->my . '提醒您正确的使用方法是[算命+姓名]';
		}
		
		$data = require_once (CONF_PATH . 'suanming.php');
		
		$num = mt_rand ( 0, 80 );
		
		return $name . "\n" . trim ( $data [$num] );
	}
	function yinle($name) 
	{
		$name = implode ( '', $name );
		
		$url = 'http://httop1.duapp.com/mp3.php?musicName=' . $name;
		
		$str = file_get_contents ( $url );
		
		$obj = json_decode ( $str );
		
		return array (
				
				array (
						
						$name,
						
						$name,
						
						$obj->url,
						
						$obj->url 
				)
				,
				
				'music' 
		)
		;
		
	}
	function geci($n) {
		$name = implode ( '', $n );
		
		@$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode ( '歌词' . $name );
		
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->content );
		
		return str_replace ( 'mzxing_com', 'wephone', $str );
	}
	function yuming($n) {
		$name = implode ( '', $n );
		
		@$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode ( '域名' . $name );
		
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->content );
		
		return str_replace ( 'mzxing_com', 'wephone', $str );
	}
	function jisuan($n){
		//$name = implode ( '', $n );
		import('ORG.Util.String');
		$exp = $n[1];
		$mathrpn = new Math($exp);
		$rpnExp = $mathrpn->exp2rpn();
		return $mathrpn->getResult($rpnExp);
	}
	function tianqi($n) {
		
		$name = implode ( '', $n );
		$url = 'http://api.map.baidu.com/telematics/v3/weather?location=' . urlencode ( $name ) . '&output=json&ak=TdAlSllD8eT1aaCe35lwG7Px';
	 $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($output, true);
    if ($result["error"] != 0){
        return $result["status"];
    }
    $curHour = (int)date('H',time());
    $weather = $result["results"][0];
    $weatherArray[] = array("Title" =>$weather['currentCity']."天气预报", "Description" =>"", "PicUrl" =>"", "Url" =>"");
	$str='';
    for ($i = 0; $i < count($weather["weather_data"]); $i++) {
        $weatherArray[] = array("Title"=>
            $weather["weather_data"][$i]["date"]."\n".
            $weather["weather_data"][$i]["weather"]." ".
            $weather["weather_data"][$i]["wind"]." ".
            $weather["weather_data"][$i]["temperature"],
        "Description"=>"", 
        "PicUrl"=>(($curHour >= 6) && ($curHour < 18))?$weather["weather_data"][$i]["dayPictureUrl"]:$weather["weather_data"][$i]["nightPictureUrl"], "Url"=>"");
		$str.=$weather["weather_data"][$i]["date"]."\n".$weather["weather_data"][$i]["weather"]." ".$weather["weather_data"][$i]["wind"]." ".$weather["weather_data"][$i]["temperature"]."\n";
    }
    return $str;
	}
	function qiushi(){
		$HTTP_Server = "www.qiushibaike.com/8hr";
		$HTTP_URL = "/";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://" . $HTTP_Server . $HTTP_URL);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");

		$content = curl_exec($ch);
		preg_match_all('/<div class="content" title="(.*?)">\s*(.*?)\s*<\/div>/is', $content, $match);
		unset($match[0]);
		

		$lists = $match[2];
		if(sizeof($lists)>0){
			$num = sizeof($lists);
			$n=rand(0,$num-1);
			return $lists[$n];
		}else{
			return "糗事暂无内容";
		}
	}
	
	function sousuo($n) {
		$name = implode ( '', $n );
		
		@$str = 'http://vip0476.com/weixinapi.php?city_id=1' . urlencode ( '搜' . $name );
		
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->content );
		
		return str_replace ( 'mzxing_com', 'wephone', $str );
	}
	function shouji($n) {
		//$name = implode ('', $n);
		
		@$str = 'http://www.096.me/api.php?mode=txt&phone=' . $n;
		
		return iconv('gbk','utf-8',file_get_contents ( $str ));
	}
	
	/*
	 * function shouji($n){ $n = implode('', $n); if (count($n) > 1) { $this->error_msg($n); return false; }; $str = file_get_contents('http://www.096.me/api.php?phone=' . $n . '&mode=txt'); if ($str !== iconv('UTF-8', 'UTF-8', iconv('UTF-8', 'UTF-8', $str))) { $str = iconv('GBK', 'UTF-8', $str); } return str_replace('\t', '', str_replace('|', "\n", $str)); }
	 */
	function shenfenzheng($n) {
		//$n = implode ( '', $n );
		/*
		if (count ( $n ) > 1) {
			
			$this->error_msg ( $n );
			
			return false;
		}
		
		;
		*/
		$xml_array = simplexml_load_file ( 'http://api.k780.com/?app=idcard.get&idcard=' . $n . '&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=xml' ); // 将XML中的数据,读取到数组对象中
		
		foreach ( $xml_array as $tmp ) {
			
			if ($str !== iconv ( 'UTF-8', 'UTF-8', iconv ( 'UTF-8', 'UTF-8', $str ) )) {
				
				$str = iconv ( 'GBK', 'UTF-8', $str );
			}
			
			$str = "【身份证】" . $tmp->idcard . "【地址】" . $tmp->att . "【性别】" . $tmp->sex . "【生日】" . $tmp->born;
			
			// $str=$xml_array;
		}
		
		return $str;
	}
	function gongjiao($data) 
	{
		$data=$this->get_tags($data);
		
		$arr = explode(",",$data);
		
		if (count ( $arr ) != 2) {
			
			$this->error_msg ();
			
			return false;
		}
		
		$json = file_get_contents ( "http://www.twototwo.cn/bus/Service.aspx?format=json&action=QueryBusByLine&key=7d8a7bb1-430d-4b9f-bd3c-626bbf2735ec&zone=" . $arr [0] . "&line=" . $arr [1] );
		
		$data = json_decode ( $json );
		
		$xianlu = $data->Response->Head->XianLu;
		
		$xdata = get_object_vars ( $xianlu->ShouMoBanShiJian );
		
		$xdata = $xdata ['#cdata-section'];
		
		$piaojia = get_object_vars ( $xianlu->PiaoJia );
		
		$xdata = $xdata . ' -- ' . $piaojia ['#cdata-section'];
		
		$main = $data->Response->Main->Item->FangXiang;
		
		$xianlu = $main [0]->ZhanDian;
		
		$str = "【本公交途经】\n";
		
		for($i = 0; $i < count ( $xianlu ); $i ++) {
			
			$str .= "\n" . trim ( $xianlu [$i]->ZhanDianMingCheng );
		}
		
		return $str;
	}
	function huoche($data, $time = '') 
	{
		$data = array_merge ( $data );
		
		$data [2] = date ( 'Y', time () ) . $time;
		
		if (count ( $data ) != 3) {
			
			$this->error_msg ( $data [0] . '至' . $data [1] );
			
			return false;
		}
		
		;
		
		$time = empty ( $time ) ? date ( 'Y-m-d', time () ) : date ( 'Y-', time () ) . $time;
		
		$json = file_get_contents ( "http://www.twototwo.cn/train/Service.aspx?format=json&action=QueryTrainScheduleByTwoStation&key=5da453b2-b154-4ef1-8f36-806ee58580f6&startStation=" . $data [0] . "&arriveStation=" . $data [1] . "&startDate=" . $data [2] . "&ignoreStartDate=0&like=1&more=0" );
		
		if ($json) {
			
			$data = json_decode ( $json );
			
			$main = $data->Response->Main->Item;
			
			if (count ( $main ) > 10) {
				
				$conunt = 10;
			} else {
				
				$conunt = count ( $main );
			}
			
			for($i = 0; $i < $conunt; $i ++) {
				
				$str .= "\n 【编号】" . $main [$i]->CheCiMingCheng . "\n 【类型】" . $main [$i]->CheXingMingCheng . "\n【发车时间】:　" . $time . ' ' . $main [$i]->FaShi . "\n【耗时】" . $main [$i]->LiShi . ' 小时';
				
				$str .= "\n----------------------";
			}
		} else {
			
			$str = '没有找到 ' . $name . ' 至 ' . $toname . ' 的列车';
		}
		
		return $str;
	}
	function fanyi($name) 
	{
		$name = array_merge ( $name );
		
		$url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=kylV2rmog90fKNbMTuVsL934&q=" . $name [0] . "&from=auto&to=auto";
		
		$json = Http::fsockopenDownload ( $url );
		
		if ($json == false) {
			
			$json = file_get_contents ( $url );
		}
		
		$json = json_decode ( $json );
		
		$str = $json->trans_result;
		
		if ($str [0]->dst == false)
			
			return $this->error_msg ( $name [0] );
		
		$mp3url = 'http://www.apiwx.com/aaa.php?w=' . $str [0]->dst;
		
		return array (
				
				array (
						
						$str [0]->src,
						
						$str [0]->dst,
						
						$mp3url,
						
						$mp3url 
				)
				,
				
				'music' 
		)
		;
		
	}
	function caipiao($name) 
	{
		$name = array_merge ( $name );
		
		$url = "http://api2.sinaapp.com/search/lottery/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=" . $name [0];
		
		$json = Http::fsockopenDownload ( $url );
		
		if ($json == false) {
			
			$json = file_get_contents ( $url );
		}
		
		$json = json_decode ( $json, true );
		
		$str = $json ['text'] ['content'];
		
		return $str;
	}
	function mengjian($name) 
	{
		$name = array_merge ( $name );
		
		if (empty ( $name ))
			
			return '周公睡着了,无法解此梦,这年头神仙也偷懒';
		
		$data = M ( 'Dream' )->field ( 'content' )->where ( "`title` LIKE '%" . $name [0] . "%'" )->find ();
		
		if (empty ( $data ))
			
			return '周公睡着了,无法解此梦,这年头神仙也偷懒';
		
		return $data ['content'];
	}
	
	
	function gupiao($name) 
	{
		$name = array_merge ( $name );
		
		$url = "http://api2.sinaapp.com/search/stock/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=" . $name [0];
		
		$json = Http::fsockopenDownload ( $url );
		
		if ($json == false) {
			
			$json = file_get_contents ( $url );
		}
		
		$json = json_decode ( $json, true );
		
		$str = $json ['text'] ['content'];
		
		return $str;
	}
	function getmp3($data) 
	{
		$obj = new getYu ();
		
		$ContentString = $obj->getGoogleTTS ( $data );
		
		$randfilestring = 'mp3/' . time () . '_' . sprintf ( '%02d', rand ( 0, 999 ) ) . ".mp3";
		
		//file_put_contents ( $randfilestring, $ContentString );
		
		return rtrim ( C ( 'site_url' ), '/' ) . $randfilestring;
	}
	function xiaohua() {
		
		$str = 'http://www.tuling123.com/openapi/api?key=2d5c65414458b189825a797c0485f2b1&info=笑话';
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->text );
		
		return str_replace ( 'mzxing_com', 'wephone', $str );
	}
	function liaotian($name) 
	{
		$name = array_merge ( $name );
		
		$this->chat ( $name [0] );
	}
	function chat($name) 
	{
		$this->requestdata ( 'textnum' );
		
		$check = $this->user ( 'connectnum' );
		
		if ($check ['connectnum'] != 1) {
			
			return C ( 'connectout' );
		}
		
		if ($name == "你叫什么" || $name == "你是谁") {
			
			return '咳咳，我是聪明与智慧并存的美女，主淫你可以叫我' . $this->my . ',人家刚交男朋友,你不可追我啦';
		} elseif ($name == "你父母是谁" || $name == "你爸爸是谁" || $name == "你妈妈是谁") {
			
			return '主淫,' . $this->my . '是主人创造的,所以他们是我的父母,不过主人我属于你的';
		} elseif ($name == '糗事') {
			
			$name = '笑话';
		} elseif ($name == '网站' || $name == '官网' || $name == '网址' || $name == '你是' || $name == '3g网址') {
			
		return "回复首页试试";		}
		
		$str = 'http://www.tuling123.com/openapi/api?key=2d5c65414458b189825a797c0485f2b1&info=' . urlencode ( $name );
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '狗扑软件', $this->my, str_replace ( '提示：', $this->my . '提醒您:', str_replace ( '{br}', "\n", $json->text ) ) );
		
		return $str;
	}
	public function fistMe($data) 
	{
		if ('event' == $data ['MsgType'] && 'subscribe' == $data ['Event']) {
			
			return $this->help ();
		}
	}
	public function help() 
	{
		$data = M ( 'Areply' )->where ( array (
				
				'token' => $this->token 
		)
		 )
		->find ();
		
		return array (
				
				preg_replace ( "/(\015\012)|(\015)|(\012)/", "\n", $data ['content'] ),
				
				'text' 
		)
		;
		
	}
	function error_msg($data) 
	{
		return '没有找到' . $data . '相关的数据';
	}
	public function user($action, $keyword = '') 
	{
		$user = M ( 'Wxuser' )->field ( 'uid' )->where ( array (
				
				'token' => $this->token 
		)
		 )
		->find ();
		
		$usersdata = M ( 'Users' );
		
		$dataarray = array (
				
				'id' => $user ['uid'] 
		)
		;
		
		
		$users = $usersdata->field ( 'gid,diynum,connectnum,activitynum,viptime' )->where ( array (
				
				'id' => $user ['uid'] 
		)
		 )
		->find ();
		
		$group = M ( 'User_group' )->where ( array (
				
				'id' => $users ['gid'] 
		)
		 )
		->find ();
		
		if ($users ['diynum'] < $group ['diynum']) {
			
			$data ['diynum'] = 1;
			
			if ($action == 'diynum') {
				
				$usersdata->where ( $dataarray )->setInc ( 'diynum' );
			}
		}
		
		if ($users ['connectnum'] < $group ['connectnum']) {
			
			$data ['connectnum'] = 1;
			
			if ($action == 'connectnum') {
				
				$usersdata->where ( $dataarray )->setInc ( 'connectnum' );
			}
		}
		
		if ($users ['viptime'] > time ()) {
			
			$data ['viptime'] = 1;
		}
		
		return $data;
	}
	public function requestdata($field) 
	{
		$data ['year'] = date ( 'Y' );
		
		$data ['month'] = date ( 'm' );
		
		$data ['day'] = date ( 'd' );
		
		$data ['token'] = $this->token;
		
		$mysql = M ( 'Requestdata' );
		
		$check = $mysql->field ( 'id' )->where ( $data )->find ();
		
		if ($check == false) {
			
			$data ['time'] = time ();
			
			$data [$field] = 1;
			
			$mysql->add ( $data );
		} else {
			
			$mysql->where ( $data )->setInc ( $field );
		}
	}
	function baike($name) 
	{
		$name = implode ( '', $name );
		
		if ($name == 'wephone') {
			
			return '苏州是一个牛B的地方，这里的男淫女淫都喜欢..不过马上要被我收购了，当然这只是一个笑话';
		}
		
		$name_gbk = iconv ( 'utf-8', 'gbk', $name );
		
		$encode = urlencode ( $name_gbk );
		
		$url = 'http://baike.baidu.com/list-php/dispose/searchword.php?word=' . $encode . '&pic=1';
		file_put_contents("b.txt",$url);
		$get_contents = $this->httpGetRequest_baike ( $url );
		
		$get_contents_gbk = iconv ( 'gbk', 'utf-8', $get_contents );
		
		preg_match ( "/URL=(\S+)'>/s", $get_contents_gbk, $out );
		
		$real_link = 'http://baike.baidu.com' . $out [1];
		
		$get_contents2 = $this->httpGetRequest_baike ( $real_link );
		
		preg_match ( '#"Description"\scontent="(.+?)"\s\/\>#is', $get_contents2, $matchresult );
		
		if (isset ( $matchresult [1] ) && $matchresult [1] != "") {
			
			return htmlspecialchars_decode ( $matchresult [1] );
		} else {
			
			return "抱歉，没有找到与“" . $name . "”相关的百科结果。";
		}
	}
	function httpGetRequest_baike($url) 
	{
		$headers = array (
				
				"User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
				
				"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
				
				"Accept-Language: en-us,en;q=0.5",
				
				"Referer: http://www.baidu.com/" 
		)
		;
		
		
		$ch = curl_init ();
		
		curl_setopt ( $ch, CURLOPT_URL, $url );
		
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		
		$output = curl_exec ( $ch );
		
		curl_close ( $ch );
		
		if ($output === FALSE) {
			
			return "cURL Error: " . curl_error ( $ch );
		}
		
		return $output;
	}
	public function behaviordata($field, $id = '', $type = '') 
	{
		$data ['date'] = date ( 'Y-m-d', time () );
		
		$data ['token'] = $this->token;
		
		$data ['openid'] = $this->data ['FromUserName'];
		
		$data ['keyword'] = $this->data ['Content'];
		
		$data ['model'] = $field;
		
		if ($id != false) {
			
			$data ['fid'] = $id;
		}
		
		if ($type != false) {
			
			$data ['type'] = 1;
		}
		
		$mysql = M ( 'Behavior' );
		
		$check = $mysql->field ( 'id' )->where ( $data )->find ();
		
		$this->updateMemberEndTime ( $data ['openid'] );
		
		if ($check == false) {
			
			$data ['enddate'] = time ();
			
			$mysql->add ( $data );
		} else {
			
			$mysql->where ( $data )->setInc ( 'num' );
		}
	}
	public function get_tags($title, $num = 10) 
	{
		if($title=="摇一摇"){
			return $title;
		}

		vendor ( 'Pscws.Pscws4', '', '.class.php' );
		
		$pscws = new PSCWS4 ();
		
		$pscws->set_dict ( CONF_PATH . 'etc/dict.utf8.xdb' );
		
		$pscws->set_rule ( CONF_PATH . 'etc/rules.utf8.ini' );
		
		$pscws->set_ignore ( true );
		
		$pscws->send_text ( $title );
		
		$words = $pscws->get_tops ( $num );
		
		$pscws->close ();
		
		$tags = array ();
		
		foreach ( $words as $val ) {
			
			$tags [] = $val ['word'];
		}
		
		return implode ( ',', $tags );
	}

}
?>