<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["stId"]) && !empty($_POST["date"]) && !empty($_POST["response"]))
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
		$data=$mysql->getLine("SELECT `response` FROM `wxyy` WHERE `stId`='".$_POST["stId"]."' && `date`='".$_POST["date"]."'");
		if(!empty($data) && $data["response"]==null)
		{
			$sql="UPDATE `wxyy` SET `response`='".$_POST["response"]."',`responsestId`='".$_SESSION["stId"]."' WHERE `stId`='".$_POST["stId"]."' && `date`='".$_POST["date"]."'  || `date`='".$_POST["date1"]."'";
			if(!$mysql->runsql($sql))
			{
				$json["error"]=0;
				echo json_encode($json);
			}
		}
	}
}

?>