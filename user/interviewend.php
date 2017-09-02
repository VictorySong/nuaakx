<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["id"]) && !empty($_SESSION["tableName"]) && !empty($_POST["tableName"]))
{
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	if($t){
		$mysql=new SaeMysql();
		if(!$mysql->runsql("UPDATE `KxRecruitSign` SET `end`='1' WHERE `stId`='".$_POST["id"]."' && `interviewing`='1' && `department`='".$_POST["tableName"]."'"))
		{
			$json["error"]=0;
			$json["status"]="200";
		}
		else{
			$json["error"]=1;
		}
		echo json_encode($json);
	}
}
?>