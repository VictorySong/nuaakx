<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$json=array();
	foreach($_POST as $key=>$value)
	{
		$sql="SELECT `stId` FROM `wxyy` WHERE `date`='".$key."'";
		$result=mysql_query($sql,$mysql->ico);
		$json[$key]=mysql_num_rows($result);
	}
	echo json_encode($json);
}


?>