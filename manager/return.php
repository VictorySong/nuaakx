<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	if($mysql->runsql("UPDATE `app_nuaakexie`.`KxGlwz2` SET `itemreturn` = '0' WHERE `KxGlwz2`.`jname` = '".$_POST["jname"]."'&&`gname` = '".$_POST["gname"]."'&&`jdatetime` = '".$_POST["jdatetime"]."'&&`jdatetime1` = '".$_POST["jdatetime1"]."'"))
				die($mysql->errmsg());
	$data=$mysql->getData("SELECT `jname`,`jphone`,`jdatetime`,`gname`,`description`,`jdatetime1` FROM `KxGlwz2` WHERE `jname`='".$_POST["jname"]."'");
	if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		}


?>