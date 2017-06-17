<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["date"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `stId` ,`problem`,`evaluate`,`solution`,`response` FROM `wxyy` WHERE `date`='".$_POST["date"]."' || `date`='".$_POST["date1"]."'");
	//判断查询人是不是技服的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value=="KxJsJf")
			$t=true;
	}
	if($t)
	{
		if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
				$data1=$mysql->getLine("SELECT `name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$value["stId"]."'");
				$data[$key]["name"]=$data1["name"];
				$data[$key]["phone"]=$data1["phone"];
				$data[$key]["email"]=$data1["email"];
			}
			$json["error"]=0;
			$json["msg"]=$data;
			echo json_encode($json);
		}
	}
}


?>