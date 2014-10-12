<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if IE 10]>         <html class="no-js ie10"> <![endif]-->
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      
  <title>联系我们微信营销推广行业领导品牌</title>
  <meta name="keywords"  content=联系我们"/>
  <meta name="description"  content="，是微信营销行业领导品牌，专注于提供微信营销、微信推广、微信运营等解决方案，助力企业微营销。"/>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo RES;?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo RES;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo RES;?>/css/anythingslider.css">
    <script src="<?php echo RES;?>/js/com-9ac93d2c51d68fe2ff212cbd6355f2f6.js" type="text/javascript"></script>
    <script src="<?php echo RES;?>/js/modernizr-2.6.2.min.js"></script>
</head>
<body data-spy="scroll" data-target="#page-index"  id="index-0">
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<div class="html">
    <div class="header">
	<div class="wrap">
		<div class="logo">
			<a href="/"></a>
		</div>
		<div class="header-nav">
			<ul>
				<li>
					<a href="/">首页</a>
				</li>
				<li>
					<a href="<?php echo U('Home/Index/solution');?>" class="">经典案例</a>
				</li>
				<li>
					<a href="<?php echo U('Home/Index/navigation');?>" class="">功能导航</a>
				</li>

				<li>
					<a href="<?php echo U('Home/Index/about');?>" class="active">关于我们</a>
				</li>
			</ul>
		</div>
		<div class="header-btns">
		<?php if($_SESSION[uid]==false): ?><a href="<?php echo U('Home/Index/login');?>" class="btn btn-text">登录</a>
		<a href="<?php echo U('Home/Index/reg');?>" class="btn btn-green">注册试用</a>
		<?php else: ?>
		<a href="<?php echo U('User/Index/index');?>" class="btn btn-green"><?php echo (session('uname')); ?></a>
		<a href="/#" class="btn btn-green" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a><?php endif; ?>
		</div>
	</div>
</div>

    
<div class="body">
  <div class="flash h226" style="background: url(<?php echo RES;?>/images/img/ad-about.jpg) no-repeat center 0 #fcfcfc;">
    <div class="wrap relative">
      <div class="mod-list">
        <a href="<?php echo U('Home/Index/about');?>">关于我们</a>
        <a class="active" href="<?php echo U('Home/Index/contact');?>">联系我们</a>
      </div>
      <div class="ad-about">
        <p>梦达天下 因为由你</p>
        <small>社会化媒体时代商业新模式，O2O聚财新体验</small>
      </div>
    </div>
  </div>
  <div class="breadcrumb">
    <div class="wrap"><b>当前位置：</b>联系我们</div>
  </div>
  <div class="clearfix bg-gray">
    <div class="wrap">
      <h3 class="article-title">联系我们</h3>
      <div class="contactus">
        <div class="edit-main clearfix">
          <div class="part-2">
            <a href="http://map.baidu.com/?shareurl=1&poiShareUid=73946a6179e0b640e1110350" target="_blank" title="点击查询地图">
              <img src="<?php echo RES;?>/images/map.jpg">
            </a>
          </div>
          <div class="part-2">
            <h2></h2>
            <p>
              电话：<?php echo C('phone');?> <br>
              邮箱：<?php echo C('site_email');?> <br>
              网址：<?php echo C('site_url');?> <br>
              地址：湖南省郴州市北湖区龙泉路奇石馆小区2栋2单元09B6室
            </p>
          </div>
        </div>
        <div class="edit-main clearfix">
          <div class="paybox">
            <h2>银行汇款</h2>
            <p>
              公司名称： <br>
              公司银行账号： <br>
              中国
            </p>
          </div>
          <div class="paybox">
            <h2>支付宝汇款</h2>
            <p>
              公司名称：<br>
              公司支付宝账号：
            </p>
          </div>
          <div class="edit-main clearfix">
          </div>
        </div>
      </div>
    </div>


     <!--[if !IE]>底部<![endif]-->
﻿  <div class="footer">

	<div class="footer-nav clearfix">

		<div class="wrap clearfix">

			<dl class="list-arrow-square">

				<dt>关于微盟合创</dt>

				<dd><a href="<?php echo U('Home/Index/contact');?>">联系方式</a></dd>

				<dd><a href="<?php echo U('Home/Index/about');?>">关于我们</a></dd>

			</dl>

			<!--<dl class="list-arrow-square">

				<dt><a href="#">暂无</a></dt>

			</dl>-->

			<dl class="list-icon">

				<dt>联系方式</dt>

				<dd class="icon-address"><a href="<?php echo U('Home/Index/contact');?>">公司地址</a></dd>

				<dd class="icon-phone"><?php echo C('phone');?></dd>

				<dd class="icon-mail"><a href="mailto:<?php echo C('site_email');?>"><?php echo C('site_email');?></a></dd>

			</dl>

			<dl class="list-link">

				<dt>友情链接</dt>

				<dd>

            <a href="http://weixin.qq.com/" target="blank">微信下载</a>

            <a href="http://daxue.qq.com/" target="blank">腾讯大学</a>

            <a href="http://daxue.qq.com/wechat" target="blank">微信商学院</a>

				</dd>

			</dl>

		</div>

	</div>

	<div class="footer-copyright">

		<div class="wrap clearfix">

			<p class="fl text-left"><?php echo C('ipc');?></p>

			<p class="fr text-right mod-share">

				

			</p>

		</div>

	</div>

</div>



<!--  js  -->

  <script src="<?php echo RES;?>/js/jquery.anythingslider.min.js"></script>

  <script src="<?php echo RES;?>/js/affix.js"></script>

  <script src="<?php echo RES;?>/js/scrollspy.js"></script>

	<script src="<?php echo RES;?>/js/plugins.js"></script>

	<script src="<?php echo RES;?>/js/main.js"></script>

  <script src="<?php echo RES;?>/js/jquery.cookie.js"></script>

	<script>

		$(function(){

			$('#slider-spread').anythingSlider({

				theme:"minimalist-round",

				buildStartStop:false,

				pauseOnHover: true,

				startPanel:0,

        hashTags: false

			});

		});

	</script>

	<script>

		$("#change_verify_code").click(function() {

			$image_code = $('#image_code');

			$image_code.attr("src", $image_code.attr("src") + Math.random());

			$('#verify_code').val('').focus();

			return false;

		});

	</script>





  

<script>

  $(function(){

    $("#page-index").affix({

        offset: {

            top: 200,

            bottom: 300

        }

    });

    $.fn.scrollspy.Constructor.DEFAULTS = {

        offset: 100

    }

  });

</script>



<script>

    $(function(){

        $(window).resize(function(){

            $('#slider-index').anythingSlider({

                theme:"cs-portfolio",

                buildStartStop:false,

                autoPlay:true,

                pauseOnHover: true,

                buildArrows:false,

                startPanel:0,

                hashTags: false

            });

        });

        $('#slider-index').anythingSlider({

            theme:"cs-portfolio",

            buildStartStop:false,

            autoPlay:true,

            pauseOnHover: true,

            buildArrows:false,

            startPanel:0,

            hashTags: false

        });

        $('#slider-note').anythingSlider({

            mode: "vertical",

            buildNavigation: false,

            theme:"cs-portfolio",

            buildStartStop:false,

            autoPlay:true,

            pauseOnHover: true,

            buildArrows:false,

            startPanel:0,

            hashTags: false

        });

        $('#slider-index-4').anythingSlider({

            theme:"minimalist-square",

            buildStartStop:false,

            autoPlay:true,

            pauseOnHover: true,

            expand : true,

            showMultiple : 5,

            startPanel:0,

            hashTags: false

        });



        $('#slider-case').anythingSlider({

            theme:"minimalist-square",

            autoPlay: false,

            buildStartStop:false,

            pauseOnHover: true,

            expand : true,

            showMultiple : 1,

            startPanel:3,

            hashTags: false

        });



    });



    

</script>

<div class="mod-tools" id="tools">

    <a class="tools-qq" id="launch_qq">QQ:<?php echo C('site_qq');?></a>

    <a class="tools-phone"><?php echo C('phone');?></a>

    <a class="tools-spread" href="<?php echo U('Home/Index/spread');?>">申请代理</a>

    <a class="tools-qrd"></a>

</div>



  <div class="mod-page-circle page-index" id="page-index">

    <ul class="nav">

      <li><a href="#index-0">0</a></li>

      <li><a href="#index-1">1<i></i><span>V-领先服务</span></a></li>

      <li><a href="#index-2">2<i></i><span>谁使用了noercms</span></a></li>

    </ul>

  </div>


<!--[if !IE]>底部<![endif]-->
</div>


</body>
</html>