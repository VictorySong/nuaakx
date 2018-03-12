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

		if(!$mysql->runsql("INSERT INTO `KxGlwz2` (`jname`,`jphone`,`gname`,`jdatetime`,`jdatetime1`,`description`,`wz`) VALUES ('".$_POST["jname"]."','".$_POST["jphone"]."','".$_POST["gname"]."','".$_POST["jdatetime"]."','".$_POST["jdatetime1"]."','".$_POST["description"]."','".$_POST["wuzi"]."')"))
		{
			$json["error"]=0;
			
			echo json_encode($json);
	
		}
		else
			echo $mysql->errmsg();
	

	


?>