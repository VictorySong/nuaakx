<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["jname"])&& !empty($_POST["jphone"]) && !empty($_POST["gname"])&& !empty($_POST["description"]) && !empty($_POST["wuzi"])&& !empty($_POST["jdate"]&& !empty($_POST["jtime"]))
{
	$mysql=new SaeMysql();
	if(date("G")<"19")
		$time=date("Y-m-d");
	else
		$time=date("Y-m-d",time()+86400);
	$result=mysql_query($sql,$mysql->ico);
	$counts=mysql_num_rows($result);

		if(!$mysql->runsql("INSERT INTO `KxGlwz` (`jname`,`jphone`,`jdate`,`gname`,`description`,`wuzi`,`jtime`) VALUES ('".$_SESSION["stId"]."','".$_POST["problem"]."','".$_POST["time"]."','".$_POST["place"]."')")&&!$mysql->runsql("UPDATE `app_nuaakexie`.`wx_user` SET `phone` = '".$_POST["phone"]."', `email` = '".$_POST["email"]."' WHERE `wx_user`.`number` = '".$_SESSION["stId"]."' "))
		{
			$json["error"]=0;
			
			echo json_encode($json);
	
		}
		else
			echo $mysql->errmsg();
	
}
	


?>