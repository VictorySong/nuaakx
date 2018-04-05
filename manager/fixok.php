<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	$data1=$mysql->getline("SELECT `name`,`phone` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$name1=$data1["name"];
	if($mysql->runsql("UPDATE `app_nuaakexie`.`bigfix` SET `ok` = 1,`fixname` = '".$name1."' WHERE `bigfix`.`sname` = '".$_POST["sname"]."'&&`sid` = '".$_POST["sid"]."'&&`wx` = '".$_POST["wx"]."'&&`tel` = '".$_POST["tel"]."'&&`ques` = '".$_POST["ques"]."'"))
				die($mysql->errmsg());
	$data=$mysql->getData("SELECT `sname`,`sid`,`tel`,`des`,`ques`,`addr` FROM `bigfix` WHERE `sname`='".$_POST["sname"]."'");
	if(!empty($data))
		{
			
			$json["error"]=0;
			$json["msg"]=$data;
			
			
			echo json_encode($json);
		}


?>