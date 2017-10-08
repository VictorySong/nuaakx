<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["stId"]) && !empty($_POST["department"]) && !empty($_POST["evaluate"]) && !empty($_POST["time"]))
{
	$mysql=new SaeMysql();
	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["department"])
			$t=true;
	}
	if($t)
	{
		if($_POST["time"]=="first")
		{
			if(!$mysql->runsql("UPDATE `KxRecruit` SET `firstevaluate`='".$_POST["evaluate"]."' ,`firstevaluatestId`='".$_SESSION["stId"]."' WHERE `stId`='".$_POST["stId"]."' && `department`='".$_POST["department"]."'"))
			{
				$json["error"]=0;
				echo json_encode($json);
			}
		}
		else if($_POST["time"]=="second")
		{
			if(!$mysql->runsql("UPDATE `KxRecruit` SET `secondevaluate`='".$_POST["evaluate"]."' ,`secondevaluatestId`='".$_SESSION["stId"]."' WHERE `stId`='".$_POST["stId"]."' && `department`='".$_POST["department"]."'"))
			{
				$json["error"]=0;
				echo json_encode($json);
			}
		}
	}
}



?>