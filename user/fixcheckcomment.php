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
	$data=$mysql->getData("SELECT `date`,`problem` ,`place`FROM `wxyy` WHERE `stId`='".$_SESSION["stId"]."' && `judge`='0' && `date`<'".$time."' order by date desc");
	
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