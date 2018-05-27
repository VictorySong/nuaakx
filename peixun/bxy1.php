<?php
$json=array(); 
$_SESSION["stId"]=document.getElementById("stId").value;
var id=$("#recruitsign input[name=Id]").val();

include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$name=$mysql->getLine("SELECT `name` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	//$json=array();
	if(!empty($data))
	{
		$json["error"]=0;
		$json["email"]=$data["email"];
		$json["name"]=$name["name"];
	}
	else
	{
		$json["error"]=1;
	}
}
?>