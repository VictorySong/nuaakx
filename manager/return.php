<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

	$mysql=new SaeMysql();
	if($mysql->runsql("UPDATE `app_nuaakexie`.`KxGlwz2` SET `itemreturn` = '0' WHERE `KxGlwz2`.`jname` = '".$_POST["jname"]."'"))
				die($mysql->errmsg());


?>