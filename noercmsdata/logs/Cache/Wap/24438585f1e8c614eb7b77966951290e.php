<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($tpl["wxname"]); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no"><style>
#iframe_screen{
    background:#fff;
    position:absolute;
    width:100%;
    height:100%;
    left:0;
    top:0;
    z-index:300000;
    overflow:hidden;
}
</style>
<meta charset="utf-8">
<link href="<?php echo RES;?>/css/1133/cate.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/1133/iscroll.css" rel="stylesheet" type="text/css">
<script src="<?php echo RES;?>/css/1133/jquery.min.js" type="text/javascript"></script><script src="<?php echo RES;?>/css/1133/swipe.js" type="text/javascript"></script><script src="<?php echo RES;?>/css/1133/iscroll.js" type="text/javascript"></script><script type="text/javascript">var myScroll;
function loaded() {
myScroll = new iScroll('wrapper', {
snap: true,
momentum: false,
hScrollbar: false,
onScrollEnd: function () {
document.querySelector('#indicator > li.active').className = '';
document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
}
 });
}
document.addEventListener('DOMContentLoaded', loaded, false);
</script><script>    $(function(){
        window.swiper_2 = new Swipe(document.getElementById('list_uls'), {
            speed:500,
           // auto:3000,
            callback: function(){
               var lis = $(".nav_for_list_ul ul:first-of-type li");
               lis.removeClass("on").eq(this.index).addClass("on");
               var las = $(".nav_for_list_ul ul:nth-of-type(2) a");
               las.removeClass("on").eq(this.index).addClass("on");
               var minIndex = 0;
               var maxIndex = Math.max(0, nav_uls.length - 3);
               var range = [this.index-1, minIndex, maxIndex];
               //
               range = range.sort(function(a, b){
                       	return a>b?1:-1;
                       });
               window.nav_uls.slide(range[1]);
            }
        });
    });
</script>
</head>
<body style=""><!--music-->
		<?php if($dh['animation'] != '0'): ?><iframe id="iframe_screen" src="./tpl/Wap/default/Index_an<?php echo ($dh["animation"]); ?>.html" frameborder="0"></iframe><?php endif; ?> <?php if($homeInfo['musicurl'] != false): ?><style>
.btn_music {
display: inline-block;
width: 35px;
height: 35px;
background: url('<?php echo RES;?>/images/play.png') no-repeat center center;
background-size: 100% auto;
position: absolute;
z-index: 100;
left: 15px;
top: 20px;
}
.btn_music.on {
    background-image: url("<?php echo RES;?>/images/stop.png");
}

</style>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
<script>

var playbox = (function(){
	//author:eric_wu
	var _playbox = function(){
		var that = this;
		that.box = null;
		that.player = null;
		that.src = null;
		that.on = false;
		//
		that.autoPlayFix = {
			on: true,
			//evtName: ("ontouchstart" in window)?"touchend":"click"
			evtName: ("ontouchstart" in window)?"touchstart":"mouseover"
			
		}

	}
	_playbox.prototype = {
		init: function(box_ele){
			this.box = "string" === typeof(box_ele)?document.getElementById(box_ele):box_ele;
			this.player = this.box.querySelectorAll("audio")[0];
			this.src = this.player.src;
			this.init = function(){return this;}
			this.autoPlayEvt(true);
			return this;
		},
		play: function(){
			if(this.autoPlayFix.on){
				this.autoPlayFix.on = false;
				this.autoPlayEvt(false);
			}
			this.on = !this.on;
			if(true == this.on){
				this.player.src = this.src;
				this.player.play();
			}else{
				this.player.pause();
				this.player.src = null;
			}
			if("function" == typeof(this.play_fn)){
				this.play_fn.call(this);
			}
		},
		handleEvent: function(evt){
			this.play();
		},
		autoPlayEvt: function(important){
			if(important || this.autoPlayFix.on){
				document.body.addEventListener(this.autoPlayFix.evtName, this, false);
			}else{
				document.body.removeEventListener(this.autoPlayFix.evtName, this, false);
			}
		}
	}
	//
	return new _playbox();
})();

playbox.play_fn = function(){
	this.box.className = this.on?"btn_music on":"btn_music";
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	playbox.init("playbox");
	/*
	setTimeout(function() {
		// IE
		if(document.all) {
			document.getElementById("playbox").click();
		}
		// 其它浏览器
		else {
			var e = document.createEvent("MouseEvents");
			e.initEvent("click", true, true);
			document.getElementById("playbox").dispatchEvent(e);
		}
	}, 2000);
	*/
});

</script>
<span id="playbox" class="btn_music" onclick="playbox.init(this).play();"><audio id="audio" loop src="<?php echo ($homeInfo["musicurl"]); ?>"></audio></span><?php endif; ?>
<!--music-->
<div class="banner">
  <div id="wrapper" style="overflow: hidden;">
    <div id="scroller" style="width: 1222px; -webkit-transition: -webkit-transform 0ms; transition: -webkit-transform 0ms; -webkit-transform-origin: 0px 0px; -webkit-transform: translate3d(0px, 0px, 0px) scale(1);">
     <ul id="thelist">
        <?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li><p><?php echo ($so["info"]); ?></p><a href="<?php echo ($so["url"]); ?>"><img src="<?php echo ($so["img"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </div>
  <div id="nav">
    <div id="prev" onclick="myScroll.scrollToPage(&#39;prev&#39;, 0,400,2);return false">← prev</div>
    <ul id="indicator">
      <li class="active"></li>
    </ul>
    <div id="next" onclick="myScroll.scrollToPage(&#39;next&#39;, 0,400,2);return false">next →</div>
  </div>
  <div class="clr"></div>
</div>
<div id="insert1"></div>
<section>
  <nav class="nav_for_list_ul">
  <ul>
      <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li   <?php if($i == 1): ?>class="on"<?php endif; ?>  ></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <ul>
        <div id="nav_uls" style="width: 33.3%; visibility: visible;">
          <ol style="list-style: none; width: 3300.625px; transition: 0ms; -webkit-transition: 0ms; -webkit-transform: translate3d(0px, 0, 0);">
          <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="width: 412.578125px; float: left; vertical-align: top;"><a href="javascript:swiper_2.slide(<?php echo ($i-1)%100; ?>);"   <?php if($i == 1): ?>class="on"<?php endif; ?>  ><img src="<?php echo ($vo["img"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ol>
        </div>
      </ul>
      <script>
window.nav_uls = new Swipe(document.getElementById('nav_uls'), {
speed:500,
callback: function(){
if(this.index>(this.length-3)){
this.slide(this.length-3);
}
}
});
</script> </div>
  </nav>
  <div id="list_uls" class="list_uls box_swipe" style="visibility: visible;">
    <ul style="list-style: none; width: 9776px; transition: 0ms; -webkit-transition: 0ms; -webkit-transform: translate3d(0px, 0, 0);">

     <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="width: 1222px; float: left; vertical-align: top;">
        <dl>
          <?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i; if($res['fid'] != 0 && $res['fid'] == $vo['id']): ?><dd><a href="<?php if($res['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$res['id'],'token'=>$res['token'])); else: echo (htmlspecialchars_decode($res["url"])); endif; ?>">
            <figure>
              <div><img src="<?php echo ($res["img"]); ?>"></div>
              <figcaption>
                <label style="cursor:pointer;"><?php echo ($res["name"]); ?></label>
              </figcaption>
            </figure>
            </a></dd><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </dl>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
      <li style="width: 1222px; float: left; vertical-align: top;">
        <dl>
        </dl>
      </li>
    </ul>
  </div>
</section>
<script>var count = document.getElementById("thelist").getElementsByTagName("img").length;	
for(i=0;i<count;i++){
 document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";
}
document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
 setInterval(function(){
myScroll.scrollToPage('next', 0,400,count);
},3500 );
window.onresize = function(){ 
for(i=0;i<count;i++){
document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";
}
 document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
} 
</script>
<div class="copyright">

<?php if($iscopyright == 1): echo ($homeInfo["copyright"]); ?>

<?php else: ?>

<?php echo ($siteCopyright); endif; ?>

</div>
<script src="<?php echo RES;?>/css/1133/jquery.min(1).js" type="text/javascript"></script><script>function displayit(n){
	for(i=0;i<4;i++){
		if(i==n){
			var id='menu_list'+n;
			if(document.getElementById(id).style.display=='none'){
				document.getElementById(id).style.display='';
				document.getElementById("plug-wrap").style.display='';
			}else{
				document.getElementById(id).style.display='none';
				document.getElementById("plug-wrap").style.display='none';
			}
		}else{
			if($('#menu_list'+i)){
				$('#menu_list'+i).css('display','none');
			}
		}
	}
}
function closeall(){
	var count = document.getElementById("top_menu").getElementsByTagName("ul").length;
	for(i=0;i<count;i++){
		document.getElementById("top_menu").getElementsByTagName("ul").item(i).style.display='none';
	}
	document.getElementById("plug-wrap").style.display='none';
}
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script><script type="text/javascript">			window.shareData = {  
					"moduleName":"Index",
					"moduleID": '0',
					"imgUrl": "http://demo.pigcms.cn/tpl/static/attachment/background/view/2.jpg", 
					"timeLineLink": "http://demo.pigcms.cn/index.php?g=Wap&m=Index&a=index&token=vemmyj1400164325",
					"sendFriendLink": "http://demo.pigcms.cn/index.php?g=Wap&m=Index&a=index&token=vemmyj1400164325",
					"weiboLink": "http://demo.pigcms.cn/index.php?g=Wap&m=Index&a=index&token=vemmyj1400164325",
					"tTitle": "就哦哦排名",
					"tContent": "消息的范德萨"
				};
		</script><script>document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        WeixinJSBridge.on('menu:share:appmessage', function (argv) {
         shareHandle('friend');
            WeixinJSBridge.invoke('sendAppMessage', { 
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.sendFriendLink,
                "desc": window.shareData.tContent,
                "title": window.shareData.tTitle
            }, function (res) {
                _report('send_msg', res.err_msg);
            })
        });
        WeixinJSBridge.on('menu:share:timeline', function (argv) {
         shareHandle('frineds');
            WeixinJSBridge.invoke('shareTimeline', {
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.sendFriendLink,
                "desc": window.shareData.tContent,
                "title": window.shareData.tTitle
            }, function (res) {
                _report('timeline', res.err_msg);
            });
        });
        WeixinJSBridge.on('menu:share:weibo', function (argv) {
         shareHandle('weibo');
            WeixinJSBridge.invoke('shareWeibo', {
                "content": window.shareData.tContent,
                "url": window.shareData.sendFriendLink,
            }, function (res) {
                _report('weibo', res.err_msg);
            });
        });
        }, false)
        function shareHandle(to) {
	var submitData = {
		module: window.shareData.moduleName,
		moduleid: window.shareData.moduleID,
		token:'vemmyj1400164325',
		wecha_id:'oKhaVjqgLaKArgt56avxkHtsuPtI',
		url: window.shareData.sendFriendLink,
		to:to
	};
	$.post('/index.php?g=Wap&m=Share&a=shareData&token=vemmyj1400164325&wecha_id=oKhaVjqgLaKArgt56avxkHtsuPtI',submitData,function (data) {},'json')
}
        </script>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
<?php if($radiogroup > 8): ?><br>
<br><?php endif; ?>
<script>
function displayit(n){
	for(i=0;i<4;i++){
		if(i==n){
			var id='menu_list'+n;
			if(document.getElementById(id).style.display=='none'){
				document.getElementById(id).style.display='';
				document.getElementById("plug-wrap").style.display='';
			}else{
				document.getElementById(id).style.display='none';
				document.getElementById("plug-wrap").style.display='none';
			}
		}else{
			if($('#menu_list'+i)){
				$('#menu_list'+i).css('display','none');
			}
		}
	}
}
function closeall(){
	var count = document.getElementById("top_menu").getElementsByTagName("ul").length;
	for(i=0;i<count;i++){
		document.getElementById("top_menu").getElementsByTagName("ul").item(i).style.display='none';
	}
	document.getElementById("plug-wrap").style.display='none';
}

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script>  
	<?php if(ACTION_NAME == 'index'): ?><script type="text/javascript">
			window.shareData = {  
					"moduleName":"Index",
					"moduleID": '0',
					"imgUrl": "<?php echo ($homeInfo["picurl"]); ?>", 
					"timeLineLink": "<?php echo C('site_url'); echo U(Index/ACTION_NAME,array('token'=>$_GET['token']));?>",
					"sendFriendLink": "<?php echo C('site_url'); echo U(Index/ACTION_NAME,array('token'=>$_GET['token']));?>",
					"weiboLink": "<?php echo C('site_url'); echo U(Index/ACTION_NAME,array('token'=>$_GET['token']));?>",
					"tTitle": "<?php echo ($homeInfo["title"]); ?>",
					"tContent": "<?php echo ($homeInfo["info"]); ?>"
				};
		</script>
	<?php else: ?>
		<script type="text/javascript">
			window.shareData = {  
				"moduleName":"Index",
				"moduleID": '1',
				"imgUrl": "<?php echo ($homeInfo["picurl"]); ?>", 
				"timeLineLink": "<?php echo C('site_url'); echo U(Index/ACTION_NAME,array('token'=>$_GET['token'],'classid'=>$_GET['classid']));?>",
				"sendFriendLink": "<?php echo C('site_url'); echo U(MODULE_NAME/ACTION_NAME,array('token'=>$_GET['token'],'classid'=>$_GET['classid']));?>",
				"weiboLink": "<?php echo C('site_url'); echo U(MODULE_NAME/ACTION_NAME,array('token'=>$_GET['token'],'classid'=>$_GET['classid']));?>",
				"tTitle": "<?php echo ($homeInfo["title"]); ?>",
				"tContent": "<?php echo ($homeInfo["info"]); ?>"
			};
		</script><?php endif; ?>
<?php echo ($shareScript); ?><!--chat-->
<script type="text/javascript" src="/tpl/Wap/default/common/js/ChatFloat.js"></script>
<?php if($kefu['status'] == '1'): ?><a href="<?php echo ($kefu["info2"]); ?>" id="CustomerChatFloat" style="position: fixed; right: 0px; top: 150px; z-index: 99999; height: 70px; width: 65px; min-width: 65px; background-image: url(/tpl/Wap/default/common/css/img/MobileChatFloat.png); background-size: 65px; background-position: 0px 0px; background-repeat: no-repeat no-repeat;"></a><?php endif; ?>   </body>
</html>