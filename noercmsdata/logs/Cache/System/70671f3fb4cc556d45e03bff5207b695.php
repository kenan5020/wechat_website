<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/js/frame.js" type=text/javascript></script>
<script type="text/javascript" src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>
<script type="text/javascript" src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>
<script type="text/javascript">
function getV(){
	$('#site_upgrade').empty().html("正在发送请求......");
	$.ajax({ url: "<?php echo U('System/getversion');?>", context: document.body, success: function(msg){
	alert(msg);    
}});
}
</script>
</head>
<body style="background:none" bgColor="transparent">
<div class="content">
<div class="box">
	<h3><?php echo C('site_name');?>网络更新消息</h3>
    <div class="con dcon">
    <div class="update">
    
    </div>
    <ul class="myinfo">
   <li>当前版本：<?php echo C('version');?></li>
   <li><a href="javascript:void(0);" onclick="getV()">检查升级</a></li>
  <li id="site_upgrade"></li>
	</ul>
    </div>
</div>
<!--/box-->

<!--/box-->
</div>
</body>
</html>