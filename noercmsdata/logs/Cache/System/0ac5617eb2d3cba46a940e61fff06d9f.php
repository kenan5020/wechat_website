<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo C('site_name');?>微信营销系统" />
<meta name="Description" content="<?php echo C('site_name');?>微信营销系统" />
<title><?php echo C('site_name');?>-<?php echo C('site_name');?>-微信后台管理登陆</title>
<style type="text/css">
	body{background:url(tpl/System/common/images/bj_01.jpg) repeat-x; padding-top:140px;font-family:'微软雅黑';}
	.c1{margin:auto; width:802px; height:457px; background:url(tpl/System/common/images/gbj_04.png) no-repeat center ; overflow:hidden;}
	.c2{margin-top:94px; text-align:right; color:#FFF;  font-weight:bold; font-size:16px;}
	.c3{background:url(tpl/System/common/images/loing_04.png) no-repeat;width:802px; height:108px; overflow:hidden;line-height:108px;vertical-align:middle;z-index: 100;position: relative;}
	.username{width:255px; height:39px; color:#979797;  font-size:18px;background-color:#FFF; border:1px solid #1e3e57;-moz-border-radius: 5px; text-indent:1em; -webkit-border-radius: 5px; margin-left:113px;line-height: 39px; }
	.password{width:255px;  color:#979797;  font-size:18px; height:39px; background-color:#FFF; border:1px solid #1e3e57;-moz-border-radius: 5px; text-indent:1em; -webkit-border-radius: 5px; margin-left:15px;line-height: 39px;}
	.submit{width:98px; height:39px; background:url(tpl/System/common/images/abj_04.jpg) repeat-x;  border:1px solid #1e3e57;-moz-border-radius: 3px; -webkit-border-radius: 3px; color:#FFF; margin-left:15px;}
	.c4{background:url(tpl/System/common/images/ww_12.png) no-repeat; width:802px; height:54px;}
</style>
</head>

<body>
<div class="c1">
<div class="c2"><?php echo C('site_name');?>高级运营版</div>
<div class="c3">
<form action="<?php echo U('Admin/insert');?>" method="post">
<input name="username" type="text" class="username" value=""/>
<input name="password" type="password" class="password"style="" value=""/>
<input value="登录" type="submit" class="submit"/>
</form>
</div>
<div class="c4"></div>
</div>
</body>
</html>