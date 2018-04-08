<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `sid`,`sname`,`tel`,`addr`,`ques`,`des`,`number` FROM `bigfix` WHERE `wx`='".$_POST["item"]."'&&`ok`='0'");
	
	
		if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		}
	


?>