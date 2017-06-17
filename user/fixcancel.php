<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	if(date("G")<"19")
		$time=date("Y-m-d");
	else
		$time=date("Y-m-d",time()+86400);
	if(!empty($_POST["date"]) && !($_POST["date"]<$time))
	{
		if(!$mysql->runsql("DELETE FROM `wxyy` WHERE `stId`='".$_SESSION["stId"]."' && `date`='".$_POST["date"]."'"))
		{
			$json["error"]=0;
		}
		else
		{
			die($mysql->errmsg());
		}
	}
	else
	{
		$json["error"]=1;
	}
	echo json_encode($json);
}
		

?>