<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$json["notice"]=$mysql->getData("SELECT `noticeid`,`title`,`description`,`url`,`date` FROM `Notice` WHERE `tostId`='".$_SESSION["stId"]."'");
	echo json_encode($json);
}
		

?>