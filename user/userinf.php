<?php
//用来判断有没有登录并获取登录数据
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getLine("SELECT `name` , `nickname` , `phone` , `email`,`openid` ,`sex` ,`headimgurl` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$data["stId"]=$_SESSION["stId"];
	
	$json=array();
	
		
	if(!empty($data))
	{
		$json["error"]=0;
		if(!empty($_SESSION["openid"])){
			$data["seopenid"]=$_SESSION["openid"];
		}
		$json["inf"]=$data;
	}
	
		
	echo json_encode($json);
}
else if(!empty($_SESSION["openid"]))
{
	$json="bound";
	echo $json;
}
else {
	$json="login";
	echo $json;
}


?>