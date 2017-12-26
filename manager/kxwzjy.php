<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
$mysql=new SaeMysql();
	if(date("G")<"19")
		$time=date("Y-m-d");
	else
		$time=date("Y-m-d",time()+86400);
	$result=mysql_query($sql,$mysql->ico);
	$counts=mysql_num_rows($result);

		if(!$mysql->runsql("INSERT INTO `KxGlwz` (`jname`,`jphone`,`date`,`gname`,`description`,`room`,`time`) VALUES ('".$_POST["jname"]."','".$_POST["jphone"]."','".$_POST["jdate"]."','".$_POST["gname"]."','".$_POST["description"]."','".$_POST["wuzi"]."','".$_POST["jtime"]."')"))
		{
			$json["error"]=0;
			
			echo json_encode($json);
	
		}
		else
			echo $mysql->errmsg();
	

	


?>