<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
//$_SESSION["stId"]="151550121";
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	

	//获取个人及部门信息
	$data=$mysql->getData("SELECT `Department` FROM `KxBm` WHERE `stId`='".$_SESSION["stId"]."' ");
	if(!empty($data))
	{
		$i=0;
		foreach($data as $value)
		{
			$_SESSION["tableName"][$i]=$value["Department"];
			$i++;
		}
	}
	$person=$mysql->getLine("SELECT `nickname`,`name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$json["error"]=0;
	if(isset($_SESSION["tableName"])){
		$person["tableName"]=$_SESSION["tableName"];
	}
	$json["inf"]=$person;
	echo json_encode($json);
	
}
		
		




?>