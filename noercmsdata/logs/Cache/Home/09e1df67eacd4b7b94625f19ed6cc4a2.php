<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html><!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--><!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]--><!--[if IE 10]>         <html class="no-js ie10"> <![endif]--><head>    <meta charset="utf-8">  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">        <title>功能导航_微最强TMVlianyun_微信营销推广行业领导品牌</title>  <meta name="keywords"  content="微官网、微客服、微会员、微商圈、微电商、微营销、微支付、微推广"/>  <meta name="description"  content="全面的功能导航：微官网、微会员、微客服、微推广、微团购、微投票、微统计、微门店、微活动、微报名、微行业、微定制"/>    <meta name="viewport" content="width=device-width, initial-scale=1">    <link rel="stylesheet" href="<?php echo RES;?>/css/normalize.css">    <link rel="stylesheet" href="<?php echo RES;?>/css/main.css">    <link rel="stylesheet" href="<?php echo RES;?>/css/anythingslider.css">    <script src="<?php echo RES;?>/js/com-9ac93d2c51d68fe2ff212cbd6355f2f6.js" type="text/javascript"></script>    <script src="<?php echo RES;?>/js/modernizr-2.6.2.min.js"></script></head><body data-spy="scroll" data-target="#page-index"  id="index-0">    <!--[if lt IE 7]>        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>    <![endif]--><div class="html">    <div class="header">	<div class="wrap">		<div class="logo">			<a href="/"></a>		</div>		<div class="header-nav">			<ul>				<li>					<a href="/">首页</a>				</li>				<li>					<a href="<?php echo U('Home/Index/solution');?>" class="">经典案例</a>				</li>				<li>					<a href="<?php echo U('Home/Index/navigation');?>" class="active">功能导航</a>				</li>								<li>					<a href="<?php echo U('Home/Index/about');?>" class="">关于我们</a>				</li>			</ul>		</div>			<div class="header-btns">		<?php if($_SESSION[uid]==false): ?><a href="<?php echo U('Home/Index/login');?>" class="btn btn-text">登录</a>		<a href="<?php echo U('Home/Index/reg');?>" class="btn btn-green">注册试用</a>		<?php else: ?>		<a href="<?php echo U('User/Index/index');?>" class="btn btn-green"><?php echo (session('uname')); ?></a>		<a href="/#" class="btn btn-green" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a><?php endif; ?>		</div>	</div></div>    <div class="body">  <div class="clearfix article">    <div class="article-top">      <div class="wrap">        <div class="edit-box">          <h4>微官网——快速建立企业微信官网，全方位展现企业品牌</h4>          <small>5分钟快速搭建微网站，更多功能随意组合，选择更丰富，变换更随心； 作为业内首家网站流量分析的平台，通过在不同时段内针对PV、UV、IP、跳出率、访问时长等维度进行分析统计，方便快捷监控信息。</small>          <p class="text-center">            <a class="btn btn-green btn-big" href="<?php echo U('Home/Index/reg');?>">免费体验</a>          </p>      </div>      </div>    </div>    <div class="clearfix bg-gray bg-shadow">      <div class="wrap text-center">        <img src="<?php echo RES;?>/images/website.png">      </div>    </div>  </div></div>     <!--[if !IE]>底部<![endif]-->﻿  <div class="footer">

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

<!--[if !IE]>底部<![endif]--></div></body></html>