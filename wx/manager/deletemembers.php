<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_GET["stId"]) && !empty($_GET["tableName"]))
{
	$mysql=new SaeMysql();
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_GET["tableName"])
			$t=true;
	}
	if($t)
	{
		/*部门成员分开记录时
		if(!$mysql->runsql("DELETE FROM `".$_GET["tableName"]."` WHERE `stId`='".$_GET["stId"]."'"))
			echo "200";
		else
			echo $mysql->errmsg();
		*/
		if(!$mysql->runsql("DELETE FROM `KxBm` WHERE `stId`='".$_GET["stId"]."' && `Department`='".$_GET["tableName"]."'"))
			echo "200";
		else
			echo $mysql->errmsg();
	}
}
?>