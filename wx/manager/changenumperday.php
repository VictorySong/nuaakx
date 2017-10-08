<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["perday"]))
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
		if(!$mysql->runsql("UPDATE `KxFixConf` SET `numperday`='".$_POST["perday"]."' , `numperdaystId`='".$_SESSION["stId"]."' WHERE `num`='1'"))
		{
			$json["error"]=0;
			echo json_encode($json);
		}
	}
}




?>