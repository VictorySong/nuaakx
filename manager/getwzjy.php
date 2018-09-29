<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_POST["item"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `jname`,`jphone`,`jdatetime`,`gname`,`description`,`jdatetime1` FROM `KxGlwz2` WHERE `wz`='".$_POST["item"]."'&&`itemreturn`='1'");
	
		if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			

		}
		else{
			$json["error"]=1;
		
			
		}
	  echo json_encode($json);
}

?>