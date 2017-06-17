<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	
	if(!empty($_POST["nickname"]))
	{
		$mysql->runsql("UPDATE `wx_user` SET `nickname`='".$_POST["nickname"]."' WHERE `number`='".$_SESSION["stId"]."'");
		$json["error"]=0;
		die(json_encode($json));
	}
	if(!empty($_POST["name"]))
	{
		$mysql->runsql("UPDATE `wx_user` SET `name`='".$_POST["name"]."' WHERE `number`='".$_SESSION["stId"]."'");
		$json["error"]=0;
		die(json_encode($json));
	}
	if(!empty($_POST["phone"]))
	{
		$mysql->runsql("UPDATE `wx_user` SET `phone`='".$_POST["phone"]."' WHERE `number`='".$_SESSION["stId"]."'");
		$json["error"]=0;
		die(json_encode($json));
	}
	if(!empty($_POST["email"]))
	{
		$mysql->runsql("UPDATE `wx_user` SET `email`='".$_POST["email"]."' WHERE `number`='".$_SESSION["stId"]."'");
		$json["error"]=0;
		die(json_encode($json));
	}
}


?>