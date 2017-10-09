<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();


	$mysql=new SaeMysql();
	
	$vote=$_POST["vote"];

		foreach($vote as $value)
		{
			if($mysql->runsql("INSERT INTO `app_nuaakexie`.`KxVote` (`Std`, `number`, `phone`) VALUES ('".$_SESSION["stId"]."','".$value."','2')"))
				die($mysql->errmsg());
		}
		
	
	$json["error"]=0;
	echo json_encode($json);
	

		


?>