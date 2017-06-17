<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(isset($_GET["tableName"]) && isset($_GET["name"]) && !empty($_SESSION["tableName"]))
{

	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_GET["tableName"])
			$t=true;
	}
	$mysql=new SaeMysql();
	$result=array();
	if($t)
	{
		$data=$mysql->getData("SELECT `name`,`number`,`phone`,`email` FROM `wx_user` WHERE `name`='".$_GET["name"]."' || `number`='".$_GET["name"]."'");
	
		if(!empty($data))
		{
			foreach($data as $value)
			{
				//$datarel=$mysql->getLine("SELECT `stId` FROM `".$_GET["tableName"]."` WHERE `stId`='".$value["number"]."'");
				$datarel=$mysql->getLine("SELECT `stId` FROM `KxBm` WHERE `stId`='".$value["number"]."' && `Department`='".$_GET["tableName"]."'");
				if(!empty($datarel))
				{
					array_push($result,$value);
				}
			}
		}
		
		
	}
	else{
		$data=$mysql->getData("SELECT `name`,`number` FROM `wx_user` WHERE `name`='".$_GET["name"]."' || `number`='".$_GET["name"]."'");
		if(!empty($data))
		{
			foreach($data as $value)
			{
				//成员分开记录时
				//$datarel=$mysql->getLine("SELECT `stId` FROM `".$_GET["tableName"]."` WHERE `stId`='".$value["number"]."'");
				$datarel=$mysql->getLine("SELECT `stId` FROM `KxBm` WHERE `stId`='".$value["number"]."' && `Department`='".$_GET["tableName"]."'");
				if(!empty($datarel))
				{
					unset($value["number"]);
					array_push($result,$value);
				}
			}
		}
	}
	echo json_encode($result);
	
}

?>