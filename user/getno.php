<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	$data=$mysql->getline("SELECT `sid`,`sname`,`tel`,`addr`,`ques`,`des`,`number`,`ok`,`wx`  FROM `bigfix` WHERE `sid`='".$_SESSION["stId"]."'");
	if($data)
	{
		$json["if"]=1;
		if($data["wx"]=='R')
		{
			$data["wx1"]="软件";
		}
	else if($data["wx"]=='Y')
	{
		$data["wx1"]="硬件";
	}
	else
	{
		$data["wx1"]="软件和硬件";
	}
	
	
	if($data["ok"]==1)
	{
		$data["ok"]="已经维修完成";
	}
	else
	{
		$data["ok"]="未维修完成";
	}
	if($data["addr"]=='east')
	{
		$data["addr"]="东区";
	}
	else
	{
		$data["addr"]="西区";
	}
		
		
	}
	else $json["if"]=0;
	
	
		
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		


?>