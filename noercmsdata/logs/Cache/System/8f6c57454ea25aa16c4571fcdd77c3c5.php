<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RES;?>/wqyimg/style.css" type="text/css" rel="stylesheet" />
<title><?php echo C('site_name');?>-noercms后台管理系统</title>
<meta name="keywords" content="<?php echo C('site_name');?>-noercms后台管理系统" />
<meta name="description" content="<?php echo C('site_name');?>-noercms后台管理系统" />
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/js/frame.js" type=text/javascript></script>
<script type="text/javascript" src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>
<script type="text/javascript" src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>
</head>
<frameset rows="76,*,5" cols="*" framespacing="0" frameborder="0" border="0" name="framese" >
  <frame src="<?php echo U('System/top');?>" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" frameborder="0"/>
  <frameset cols="168,*"  framespacing="0" frameborder="0" border="0" name="frmset" id="frmset">
        <frame src="<?php echo U('System/menu');?>" name="left" noresize="noresize" id="left" frameborder="0"/>
        <frame src="<?php echo U('System/main');?>" name="main" scrolling="yes" noresize="noresize" id="main" frameborder="0"/>   
   </frameset>
  <frame src="<?php echo U('System/footer');?>" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" frameborder="0"/>
</frameset>
<noframes><body>
</body>
</noframes>
</html>