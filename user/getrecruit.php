<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `department`,`first`,`second` FROM `KxRecruit` WHERE `stId`='".$_SESSION["stId"]."'");
	$description=$mysql->getLine("SELECT `description` FROM `KxRecruit` WHERE `stId`='".$_SESSION["stId"]."'");
	//$json=array();
	if(!empty($data))
	{
		$json["error"]=0;
		$json["department"]=$data;
		$json["description"]=$description["description"];
	}
	else
	{
		$json["error"]=1;
	}
	echo json_encode($json);
}


?>