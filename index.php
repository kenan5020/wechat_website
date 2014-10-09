<?php
header("Content-type: text/html; charset=utf-8");
if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value){
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value); 
		return $value; 
	}
	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE); 
}
if(!file_exists("./install/lock")){
	header("Location:/install");
}
define('APP_DEBUG',true);
define('CONF_PATH','./noercmsdata/Conf/');
define('RUNTIME_PATH','./noercmsdata/logs/');
define('TMPL_PATH','./tpl/');
define('HTML_PATH','./noercmsdata/html/');

define('APP_PATH','./noercms/');
define('CORE','./noercms/_Core');
require(CORE.'/noercms.php');
?>