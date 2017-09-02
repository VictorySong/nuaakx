<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) )
{
	$mysql=new SaeMysql();
	if(!empty($_SESSION["tableName"]))
	{
		foreach($_SESSION["tableName"] as $value){
			$data=$mysql->getData("SELECT `number`,`stId`,`department`,`postpone`,`interviewing`,`end` FROM `KxRecruitSign` WHERE `department`='".$value."' order by `number`");
			$i=0;
			foreach($data as $value1){
				$data1=$mysql->getLine("SELECT `name` FROM `wx_user` WHERE `number`='".$value1["stId"]."'");
				$data[$i++]["name"]=$data1["name"];
				
			}
			$json["result"][$value]=$data;
		}
		$json["error"]=0;
		
	}else{
		$data=$mysql->getData("SELECT `department` FROM `KxRecruit` WHERE `stId`='".$_SESSION["stId"]."'");
		foreach($data as $value){
			$data=$mysql->getData("SELECT `number`,`stId`,`department`,`jpostpone`,`interviewing`,`end` FROM `KxRecruitSign` WHERE `department`='".$value["department"]."' order by `number`");
			$json["error"]=0;
			$json["result"][$value["department"]]=$data;
		}
	}
	echo json_encode($json);
}			
?>