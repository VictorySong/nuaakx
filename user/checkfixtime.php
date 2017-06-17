<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `week` FROM `KxFixTime` WHERE 1 order by `week` ");//一定要顺序排
	$data1=$mysql->getLine("SELECT `days` ,`numperday` FROM `KxFixConf` WHERE 1 order by `time` desc");
	$json=array();
	
	$json["error"]=0;
	$json["msg"]=$data;
	$json["conf"]=$data1;
	echo json_encode($json);
}


?>