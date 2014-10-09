<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>站点配置</title>



<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">



<link href="<?php echo RES;?>/images/jquery-1.7.2.min.js" type="text/css" rel="stylesheet">



<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">

<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>

<meta http-equiv="x-ua-compatible" content="ie=7" />

<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>

<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>

<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>

<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>

<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script>



var editor;

KindEditor.ready(function(K) {

editor = K.create('#info', {

resizeType : 1,

allowPreviewEmoticons : false,

allowImageUpload : true,

items : [

'source','undo','clearhtml','hr','fontsize','forecolor','hilitecolor',

'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',

'insertunorderedlist', '|', 'emoticons', 'image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut']

});



});

</script>

<script>

	KindEditor.ready(function(K){

		var editor = K.editor({

			allowFileManager:true

		});

		K('#upload').click(function() {

			editor.loadPlugin('image', function() {

				editor.plugin.imageDialog({

					fileUrl : K('#pic').val(),

					clickFn : function(url, title) {

						if(url.indexOf("http") > -1){

							K('#pic').val(url);

						}else{

							K('#pic').val("<?php echo C('site_url');?>"+url);

						}

						editor.hideDialog();

					}

				});

			});

		});

	});

</script>



<meta http-equiv="x-ua-compatible" content="ie=7" />

</head>



<body class="warp">



<style>



.set_top{background:url('<?php echo RES;?>/images/set_top.png');height:60px;}



.set_top li{font-weight: bold;float:left;width:98px;line-height:60px;text-align: center;background:url('<?php echo RES;?>/images/set_top_li.png');}



#set_top_li_bg{background:url('<?php echo RES;?>/images/set_top_li_hover.png');}



</style>





<div class="set_top">
	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(ACTION_NAME == $vo['name']): ?>id="set_top_li_bg"<?php endif; ?>><a href="<?php echo U($action.'/'.$vo['name'],array('pid'=>6,'level'=>3));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</div>



<div id="artlist">



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">



 <form id="myform" action="<?php echo U('Site/insert');?>" method="post">



					<tr>

					<td height="48" align="right"><strong>图片上传：</strong></td>

				  <td>

											<div>

						<input name="tp" type="text" class="text textMiddle inputQ" id="pic" size="80" readonly="readonly"/>

						<span class="ke-button-common"  id="upload" style="margin-top: 8px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="Upload">

						</span>

			说明:将对应的图片上传到服务器，复制地址黏贴到指定位置</td>

				</tr>



    <tr> 



      <td  height="48" align="right"><strong>网站名称：</strong></td>



      <td><input type="text" name="site_name" value="<?php echo C('site_name');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例：<?php echo C('site_name');?></span>



	  </td>



    </tr>



	 <tr> 



      <td  height="48" align="right"><strong>网站标题：</strong></td>



      <td><input type="text" name="site_title" value="<?php echo C('site_title');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;一般不超过80个字符</span>



    </tr>

		 <tr> 



      <td  height="48" align="right"><strong>网站域名：</strong></td>



      <td><input type="text" name="site_url" value="<?php echo C('site_url');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;一般不超过80个字符</span>



    </tr>

	

					<tr>

					<td height="48" align="right"><strong>网站LOGO：</strong></td>

				  <td>

						<input type="text" id="logo" name="logo" value="<?php echo C('logo');?>" class="ipt" size="45" />

					  <span>&nbsp;&nbsp;填写网站logo</span>

						            				</td>

				</tr>





	

				 <tr> 



      <td  height="48" align="right"><strong>二维码：</strong></td>



      <td><input type="text" id="erwei" name="erwei" value="<?php echo C('erwei');?>" class="ipt" size="45" />

      <span>&nbsp;&nbsp;填写二维码地址</span>



    </tr>

			 <tr> 



      <td  height="48" align="right"><strong>联系电话：</strong></td>



      <td>电话1<input type="text" name="phone" value="<?php echo C('phone');?>" class="ipt" size="20" />电话2<input type="text" name="phone1" value="<?php echo C('phone1');?>" class="ipt" size="20" />电话3<input type="text" name="phone2" value="<?php echo C('phone2');?>" class="ipt" size="20" /><span>&nbsp;&nbsp;填写您的联系电话</span>



    </tr>





    </tr>

			 <tr> 



      <td  height="48" align="right"><strong>公司地址：</strong></td>



      <td><input type="text" name="adress" value="<?php echo C('adress');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;填写您的公司地址</span>



    </tr>

				 <tr> 



      <td  height="48" align="right"><strong>网站公告：</strong></td>



      <td><p>公告标题：

        <input type="text" name="gonggao" value="<?php echo C('gonggao');?>" class="ipt" size="45" />

            <span>&nbsp;&nbsp;

        </p>

        <p>公告内容：

            <textarea name="gonggaonr" cols="45" rows="20" class="ipt"><?php echo C('gonggaonr');?></textarea>

            <span>&nbsp;&nbsp;</span> </p>

      </tr>

	

			 <tr> 



      <td  height="48" align="right"><strong>VIP资费：</strong></td>



      <td><p>vip0：

        <input type="text" name="vip0" value="<?php echo C('vip0');?>" class="ipt" size="10" />

            <span>/月&nbsp;&nbsp;</span>   

        <input type="text" name="vip0m" value="<?php echo C('vip0m');?>" class="ipt" size="10" />

            <span>/年&nbsp;&nbsp; 

        vip1：

        <input type="text" name="vip1" value="<?php echo C('vip1');?>" class="ipt" size="10" />

               <span>/月&nbsp;&nbsp;</span>   

        <input type="text" name="vip1m" value="<?php echo C('vip1m');?>" class="ipt" size="10" />

            <span>/年&nbsp;&nbsp; 

        </p>

        <p>vip2：

            <input type="text" name="vip2" value="<?php echo C('vip2');?>" class="ipt" size="10" />

              <span>/月&nbsp;&nbsp;</span>   

            <input type="text" name="vip2m" value="<?php echo C('vip2m');?>" class="ipt" size="10" />

            <span>/年&nbsp;&nbsp; 

          vip3：

          <input type="text" name="vip3" value="<?php echo C('vip3');?>" class="ipt" size="10" />

               <span>/月&nbsp;&nbsp;</span>   

            <input type="text" name="vip3m" value="<?php echo C('vip3m');?>" class="ipt" size="10" />

            <span>/年&nbsp;&nbsp; </p>

      </tr>



	 	 <tr> 



      <td  height="48" align="right"><strong>Banner1：</strong></td>



      <td><input type="text" class="ipt" id="banner1" name="banner1" value="<?php echo C('banner1');?>" size="45" />

        Banner2:

        <input type="text" class="ipt" id="banner22" name="banner2" value="<?php echo C('banner2');?>" size="45" />	 	 </tr>  

		 	 	 <tr> 



      <td  height="48" align="right"><strong>Banner3：</strong></td>



      <td><input type="text" class="ipt" id="banner3" name="banner3" value="<?php echo C('banner3');?>" size="45" />

Banner4:

  <input type="text" class="ipt" id="banner4" name="banner4" value="<?php echo C('banner4');?>" size="45" />		 	 	 </tr>  

	 	 <tr> 



      <td  height="48" align="right"><strong>Banner5：</strong></td>



      <td><input type="text" class="ipt" id="banner5" name="banner5" value="<?php echo C('banner5');?>" size="45" />

        Banner6:

        <input type="text" class="ipt" id="banner6" name="banner6" value="<?php echo C('banner6');?>" size="45" />

	 	 </tr>  



	<tr> 



      <td  height="48" align="right"><strong>机器人名称：</strong></td>



      <td><input type="text" name="site_my" value="<?php echo C('site_my');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例:http://wx.weixin.maozi168.cn</span>



    </tr> 



	<tr> 



      <td  height="48" align="right"><strong>审核用户：</strong></td>



      <td><input type="radio" name="ischeckuser" value="true" <?php if(C('ischeckuser')==='true')echo checked; ?> />注册时无需要审核<input type="radio" name="ischeckuser" value="false" <?php if(C('ischeckuser')==='false')echo checked; ?> />注册时需要审核</td>



    </tr>


<tr> 
      <td  height="48" align="right"><strong>注册后级别：</strong></td>
      <td>
      <select name="reg_groupid">
      <?php if(is_array($groups)): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><option value="<?php echo ($g["id"]); ?>" <?php if(C('reg_groupid') == $g['id']): ?>selected<?php endif; ?>><?php echo ($g["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      <span>&nbsp;&nbsp;仅注册不需要审核的时候有效</span>
    </tr>
	<tr> 
	<tr> 



      <td  height="48" align="right"><strong>网站备案：</strong></td>



      <td><input type="text" name="ipc" value="<?php echo C('ipc');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例：沪ICP备88888号</span>



    </tr>



	<tr> 



      <td  height="48" align="right"><strong>站长QQ：</strong></td>



      <td><input type="text" name="site_qq" value="<?php echo C('site_qq');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例如:QQ:327979560</span>



    </tr>



    <tr> 



	<tr> 



      <td  height="48" align="right"><strong>联系电话：</strong></td>



      <td><textarea	 type="text" name="counts" class="ipt" style="width:252px;height:25px;margin:5px 0 5px 0;" /><?php echo C('counts');?></textarea><span>&nbsp;&nbsp;例:13888888888</span>



    </tr>



    <tr>



      <td  height="48" align="right"><strong>百度地图API：</strong></td>



      <td><input type="text" name="baidu_map_api" value="<?php echo C('baidu_map_api');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;<a href="http://lbsyun.baidu.com/apiconsole/key?application=key" target="_blank">点击获取</a></span>



    </tr>



	<tr> 



      <td  height="48" align="right"><strong>站长Email：</strong></td>



      <td><input type="text" name="site_email" value="<?php echo C('site_email');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例如:QQ:server@wx.weixin.maozi168.cn</span>



    </tr>

		<tr> 



      <td  height="48" align="right"><strong>关于我们：</strong></td>



      <td><textarea	 type="text" name="about" class="ipt" style="width:450px;height:450px;margin:5px 0 5px 0;" /><?php echo C('about');?></textarea><span>&nbsp;&nbsp;公司介绍</span>



    </tr>	



	<tr> 



      <td  height="48" align="right"><strong>网站关键词：</strong></td>



      <td><textarea	 type="text" name="keyword" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" /><?php echo C('keyword');?></textarea><span>&nbsp;&nbsp;一般不超过100个字符</span>



    </tr>	



	<tr> 



      <td  height="48" align="right"><strong>网站　描述：</strong></td>



      <td><textarea	 type="text" name="content" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" /><?php echo C('content');?></textarea><span>&nbsp;&nbsp;一般不超过200个字符</span>



    </tr>







	<tr> 



      <td  height="48" align="right"><strong>底部　版权：</strong></td>



      <td><textarea	 type="text" name="copyright" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" /><?php echo C('copyright');?></textarea><span>&nbsp;&nbsp;例:noercms版权所有</span>



    </tr>



   <input type="hidden" name="files" value="info.php" />



    <tr> 



      <td height="48" colspan="2">



		  <div id="addkey"></div>



		  <div style="padding-left:100px;">



			<input type="submit" value="保存设置" />



		  </div>



	  </td>



    </tr>



	</form>



</table><br />



<br />



<br />







</div>



</body>



</html>