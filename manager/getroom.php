<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `jname`,`jphone`,`date`,`gname`,`description`,`room`,`time` FROM `KxGlwz` WHERE `date`='".$_POST["date"]."' || `date`='".$_POST["date1"]."'");
	$data["description"]=$data["time"]+2;
	
		if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		}
	



?>