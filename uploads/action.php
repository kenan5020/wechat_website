<?php
error_reporting(0);

$APPKEY=$_GET['u'];
$APPSECRET=$_GET['p'];
$SPACENAME=$_GET['s'];
$domain=$_GET['d'];

define('APPKEY', $APPKEY);//设置App Key
define('APPSECRET', $APPSECRET);//设置App Secret
define('SPACENAME', $SPACENAME);//空间名称

include "nanoyun.class.php";

$picname = $_FILES['mypic']['name'];
$picsize = $_FILES['mypic']['size'];
if ($picname != "") {
	if ($picsize > 1024000) {
			echo '图片大小不能超过1M';
			exit;
		}
	$type = strstr($picname, '.');
	if ($type != ".gif" && $type != ".jpg" && $type != ".jpg" && $type != ".bmp" && $type != ".jpeg" && $type != ".png") {
			echo '图片格式不对！';
			exit;
		}
	$rand = rand(100, 999);
	$pics = date("YmdHis") . $rand . $type;//上传路径
	$pic_path = "file/". $pics;
	if(!$APPKEY){
        @move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path); //传到本地
		$picurl = 'http://'.$_SERVER['SERVER_NAME'].'/uploads/file/'.$pics;
	}else{
		@move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path); //传到本地
		$nanoyun = new Nanoyun(APPKEY, APPSECRET);
        $filehandle = fopen($pic_path, 'rb');
        $filename = $pics;//指定在云存储中的写入位置
        $rsp = $nanoyun->write_file(SPACENAME, $filename, $filehandle);
        fclose($filehandle);
		unlink($pic_path);
		$picurl = 'http://'.$domain.'/'.$pics;
	}
}
$size = round($picsize/1024,2);
$arr = array(
		'name'=>$picname,
		'pic'=>$picurl,
		'size'=>$size
	);
echo json_encode($arr);
?>