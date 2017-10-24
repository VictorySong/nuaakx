<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	
	$data=$mysql->getLine("SELECT `number`,`phone` FROM `KxVote` WHERE `Std`='".$_SESSION["stId"]."' ");
	if(empty($data))
	{
		$json["error"]=0;
		$json["alreadyvote"]=0;
		
	}
	else
	{
		$json["error"]=0;
		$json["alreadyvote"]=1;
		$data1=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '1'");
		$data2=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '2'");
		$data3=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '3'");
		$data4=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '4'");
		$data5=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '5'");
		$data6=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '6'");
		$data7=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '7'");
		$data8=$mysql->getLine("SELECT `phone` FROM `KxVote` WHERE `number` LIKE '8'");
		$json["1"]=sizeof($data1);
		$json["2"]=$data2;
		$json["3"]=$data3;
		$json["4"]=$data4;
		$json["5"]=$data5;
		$json["6"]=$data6;
		$json["7"]=$data7;
		$json["8"]=$data8;
	
		
        
		
	}
	echo json_encode($json);
}
		


?>