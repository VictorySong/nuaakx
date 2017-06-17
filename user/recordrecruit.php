<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["stId"]) && !empty($_POST["description"]) && !empty($_POST["department"]))
{
	$mysql=new SaeMysql();
	
	$department=$_POST["department"];
	foreach($department as $value)
	{
		if($mysql->runsql("INSERT INTO `KxRecruit` (`stId`,`department`,`description`) VALUES ('".$_SESSION["stId"]."','".$value."','".$_POST["description"]."')"))
			die($mysql->errmsg());
	}
	$json["error"]=0;
	echo json_encode($json);
	
}
		

?>