<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	
	$data=$mysql->getLine("SELECT `number`,`phone` FROM `KxVote` WHERE `Std`='".$_SESSION["stId"]."' ");
	if(empty($data))
	{
		$json["error"]=0;
		$json["alreadyvote"]=0;
		
	}
	else
	{
		$json["error"]=0;
		$json["alreadyvote"]=1;
		$json["msg"]=$data;
	}
	echo json_encode($json);
}
		


?>