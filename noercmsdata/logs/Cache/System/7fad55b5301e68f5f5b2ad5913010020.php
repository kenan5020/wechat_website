<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限管理</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<div id="artlist" class="addn">
<?php if(($info["id"]) > "0"): ?><form action="<?php echo U('User/edit');?>" method="post" name="form" id="myform">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
		<?php else: ?>
			<form action="<?php echo U('User/add');?>" method="post" name="form" id="myform"><?php endif; ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">

				 <tr>
					<th colspan="4"><?php echo ($title); ?></th>
				</tr>
				<tr>
					<td height="48" align="right"><strong>用户名称：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="username" class="ipt" size="45" value="<?php echo ($info["username"]); ?>" readonly="readonly">
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>密　　码：</strong></td>
					<td colspan="3" class="lt">
						<input type="password" name="password" class="ipt" size="45" value="">
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>确认密码：</strong></td>
					<td colspan="3" class="lt">
						<input type="password" name="repassword" class="ipt" size="45"/>
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>用户角色：</strong></td>
					<td colspan="3" class="lt">
						<select name="role" style="width:136px">
							<?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $info["role"]): ?>selected=""<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>用户状态：</strong></td>
					<td colspan="3" class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="status" id="status1" <?php if(($info["status"] == 1) OR ($info['status'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="status" id="status2" <?php if(($info["status"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>备注说明：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="remark" class="ipt" size="45" value="<?php echo ($info["remark"]); ?>"/>
					</td>
				</tr>
	<tr>
		<td colspan="4">
			<?php if(($info["id"]) > "0"): ?><input class="bginput" type="submit" name="dosubmit" value="修 改" >
				<?php else: ?>
				<input class="bginput" type="submit" name="dosubmit" value="添 加"><?php endif; ?>
			&nbsp;
			<input class="bginput" type="button" onclick="javascript:history.back(-1);" value="返 回" ></td>
	</tr>
</table>
</form>
<br />
<br />
<br />

</div>
</body>
</html>