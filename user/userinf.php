<?php
//用来判断有没有登录并获取登录数据
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getLine("SELECT `name` , `nickname` , `phone` , `email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$data["stId"]=$_SESSION["stId"];
	
	$json=array();
	if(!empty($data))
	{
		$json["error"]=0;
		$json["inf"]=$data;
	}
	echo json_encode($json);
}



?>