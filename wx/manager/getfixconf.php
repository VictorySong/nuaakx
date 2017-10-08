<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	//判断查询人是不是技服的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value=="KxJsJf")
			$t=true;
	}
	if($t)
	{
		$data=$mysql->getLine("SELECT `days`, `numperday` FROM `KxFixConf` WHERE `num`='1'");
		$data1=$mysql->getData("SELECT `week` FROM `KxFixTime` WHERE 1");
		$json["error"]=0;
		$json["days"]=$data["days"];
		$json["numperday"]=$data["numperday"];
		$json["week"]=$data1;
		echo json_encode($json);
	}
}
?>