<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	if(date("G")<"19")
		$time=date("Y-m-d");
	else
		$time=date("Y-m-d",time()+86400);
	$data=$mysql->getLine("SELECT `date`,`problem` FROM `wxyy` WHERE `stId`='".$_SESSION["stId"]."' && (`date`='".$time."' || `date`>'".$time."')");
	if(empty($data))
	{
		$json["error"]=0;
		$json["alreadyappoint"]=0;
		
	}
	else
	{
		$json["error"]=0;
		$json["alreadyappoint"]=1;
		$json["msg"]=$data;
	}
	echo json_encode($json);
}
		


?>