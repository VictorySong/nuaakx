<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["date"]) && !empty($_POST["evaluate"]))
{
	$mysql=new SaeMysql();
	if(!$mysql->runsql("UPDATE `wxyy` SET `evaluate`='".$_POST["evaluate"]."' , `judge`='1' WHERE `date`='".$_POST["date"]."' && `stId`='".$_SESSION["stId"]."'"))
	{
		$json["error"]=0;
		echo json_encode($json);
	}
	
	
}


?>