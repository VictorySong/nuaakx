<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["tableName"]) && !empty($_GET["keywords"]))
{
	$mysql=new SaeMysql();
	if(!$mysql->runsql("DELETE FROM `CustomizeKeyWords` WHERE `keywords`='"."\/".$_GET["keywords"]."\/"."'"))
		echo "200";
	else
		echo $mysql->errmsg();
}
?>