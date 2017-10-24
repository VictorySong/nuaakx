<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	
	$data=$mysql->getData("SELECT `number`,`phone` FROM `KxVote` WHERE `Std`='".$_SESSION["stId"]."' ");
	if(empty($data))
	{
		$json["error"]=0;
		$json["alreadyvote"]=0;
		
	}
	else
	{
		$json["error"]=0;
		$json["alreadyvote"]=1;
		$data1=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '1'");
		$data2=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '2'");
		$data3=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '3'");
		$data4=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '4'");
		$data5=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '5'");
		$data6=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '6'");
		$data7=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '7'");
		$data8=$mysql->getData("SELECT `num` FROM `KxVote` WHERE `number` LIKE '8'");
		$json["1"]=sizeof($data1);
		$json["2"]=sizeof($data2);
		$json["3"]=sizeof($data3);
		$json["4"]=sizeof($data4);
		$json["5"]=sizeof($data5);
		$json["6"]=sizeof($data6);
		$json["7"]=sizeof($data7);
		$json["8"]=sizeof($data8);
	
		
        
		
	}
	echo json_encode($json);
}
		


?>