<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && isset($_POST["date"]))
{
	$mysql=new SaeMysql();
	//判断查询人是不是技服的
	$t=false; 
	foreach($_SESSION["tableName"] as $value)
	{
		if($value=="KxJsJf")
			$t=true;
	}
	if($t)
	{
		$data=$mysql->getLine("SELECT `week` FROM `KxFixTime` WHERE `week`='".$_POST["date"]."'");
		if(!empty($data))
		{
			if(!$mysql->runsql("DELETE FROM `KxFixTime` WHERE `week`='".$_POST["date"]."'"))
			{
				$json["error"]=0;
				echo json_encode($json);
			}
		}
		else
		{
			if(!$mysql->runsql("INSERT INTO `KxFixTime` (`week`,`stId`) VALUES ('".$_POST["date"]."','".$_SESSION["stId"]."')"))
			{
				$json["error"]=0;
				echo json_encode($json);
			}
		}
		
	}
}




?>