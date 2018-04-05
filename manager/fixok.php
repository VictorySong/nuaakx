<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	if($mysql->runsql("UPDATE `app_nuaakexie`.`bigfix` SET `ok` = 1 WHERE `bigfix`.`sname` = '".$_POST["sname"]."'&&`sid` = '".$_POST["sid"]."'&&`tel` = '".$_POST["tel"]."'&&`ques` = '".$_POST["ques"]."'"))
				die($mysql->errmsg());
	$data=$mysql->getData("SELECT `sname`,`sid`,`tel`,`des`,`ques`,`addr` FROM `bigfix` WHERE `sname`='".$_POST["sname"]."'");
	if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		}


?>