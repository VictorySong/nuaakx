<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(isset($_SESSION["tableName"]) && !empty($_SESSION["tableName"]))
{
	$mysql=new SaeMysql();
	/* 通知分多个数据表记录时
	$data=$mysql->getLine("SELECT `title`, `description`, `msgtype`,`url` FROM `KxInternalNotice` order by `date` desc");
	*/
	$data=$mysql->getLine("SELECT `title`, `description`, `msgtype`,`url` FROM `Notice` WHERE `noticetype`='Internal' order by `date` desc");
	echo json_encode($data);
}

?>