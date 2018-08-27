<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["stId"]) && !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["description"]))
{
	$mysql=new SaeMysql();

		if($mysql->runsql("INSERT INTO `app_nuaakexie`.`KxTs` (`Std`,`question`,`ok`) VALUES ('".$_SESSION["stId"]."','".$_POST["description"]."','0')"))
				die($mysql->errmsg());
		if($mysql->runsql("UPDATE `app_nuaakexie`.`wx_user` SET `phone` = '".$_POST["phone"]."', `email` = '".$_POST["email"]."' WHERE `wx_user`.`number` = '".$_SESSION["stId"]."' "))
				die($mysql->errmsg());
	
	$json["error"]=0;
	echo json_encode($json);
	
}
		

?>