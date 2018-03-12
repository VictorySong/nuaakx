<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `jname`,`jphone`,`jdatetime`,`gname`,`description`,`jdatetime1` FROM `KxGlwz` WHERE `wz`='touyy'");
	 
	
		if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		}
	


?>