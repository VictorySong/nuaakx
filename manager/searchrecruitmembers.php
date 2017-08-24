<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(isset($_POST["tableName"]) && isset($_POST["name"]) && !empty($_SESSION["tableName"]))
{

	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	$mysql=new SaeMysql();
	$result=array();
	if($t)
	{
		$data=$mysql->getData("SELECT `name`,`number`,`phone`,`email` FROM `wx_user` WHERE `name`='".$_POST["name"]."' || `number`='".$_POST["name"]."'");
	
		if(!empty($data))
		{
			$i=0;
			foreach($data as $value)
			{
				$datarel=$mysql->getLine("SELECT `stId`,`description` FROM `KxRecruit` WHERE `stId`='".$value["number"]."' && `Department`='".$_POST["tableName"]."'");
				if(!empty($datarel))
				{
					
					$result[$i]=$value;
					$result[$i]["stId"]=$datarel["stId"];
					$result[$i]["description"]=$datarel["description"];
					$result[$i]["department"]=$mysql->getData("SELECT `department`,`first`,`second`,`firstevaluate`,`secondevaluate` FROM `KxRecruit` WHERE `stId`='".$result[$i]["stId"]."'");
				}
			}
		}
		
		
	}
	$json["error"]=0;
	$json["msg"]=$result;
	
	
	echo json_encode($json);
	
}

?>