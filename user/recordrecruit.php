<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["stId"]) && !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["description"]) && !empty($_POST["department"]))
{
	$mysql=new SaeMysql();
	
	$department=$_POST["department"];
	$sql = "SELECT `stId` FROM `KxRecruit` WHERE `stId` LIKE '".$_SESSION["stId"]."'";
	$data=$mysql->getLine($sql);
	if(empty($data)){
		foreach($department as $value)
		{
			if($mysql->runsql("INSERT INTO `KxRecruit` (`stId`,`department`,`description`) VALUES ('".$_SESSION["stId"]."','".$value."','".$_POST["description"]."')"))
				die($mysql->errmsg());
		}
		if($mysql->runsql("UPDATE `app_nuaakexie`.`wx_user` SET `phone` = '".$_POST["phone"]."', `email` = '".$_POST["email"]."' WHERE `wx_user`.`number` = '".$_SESSION["stId"]."' "))
				die($mysql->errmsg());
	}
	$json["error"]=0;
	echo json_encode($json);
	
}
		

?>