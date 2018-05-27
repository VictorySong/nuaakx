<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_POST["stid"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getLine("SELECT `name`,`email` FROM `wx_user` WHERE `number`='".$_POST["stid"]."'");
	if(!empty($data))
	{
		$json["error"]=0;
		$json["msg"]=$data;
	}
	else
	{
		$json["error"]=1;
	}
	echo json_encode($json);
}


?>