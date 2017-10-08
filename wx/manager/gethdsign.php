<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["hdid"]) )
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `stId` FROM `Hdsign` WHERE `hdid`='".$_POST["hdid"]."' order by `time` desc");
	foreach($data as $key=>$value)
	{
		$data1=$mysql->getLine("SELECT `name`,`email`,`phone` FROM `wx_user` WHERE `number`='".$value["stId"]."'");
		$data[$key]["name"]=$data1["name"];
		$data[$key]["email"]=$data1["email"];
		$data[$key]["phone"]=$data1["phone"];
	}
	$json["error"]=0;
	$json["msg"]=$data;
	echo json_encode($json);
}
?>
	