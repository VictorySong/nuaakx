<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["stid"]) && !empty($_POST["tableName"]))
{
	$json["stid"]=$_POST["stid"];
	$json["tableName"]=$_POST["tableName"];
	$mysql=new SaeMysql();
	$data=$mysql->getLine("SELECT `department` FROM `KxRecruitSign` WHERE `stId`='".$_POST["stid"]."' && `interviewing`='1' && `end`='0'");
	if(!empty($data)){
		$json["error"]=0;
		$json["department"]=$data["department"];
	}
	else
	{
		$json["error"]=1;
	}
	echo json_encode($json);
}
?>