<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["hdname"]) && !empty($_POST["hdcontent"]) && !empty($_POST["hdurl"]) && !empty($_POST["hdmax"]))
{
	$mysql=new SaeMysql();
	$hdid=getGuid();
	if(empty($_POST["hdsignend"]))
	{
		if(!$mysql->runsql("INSERT INTO `HdSsh` (`hdid`, `name`,`content`,`url`,`max`) VALUES ('".$hdid."','".$_POST["hdname"]."','".$_POST["hdcontent"]."','".$_POST["hdurl"]."','".$_POST["hdmax"]."')"))
		{
			$json["error"]=0;
			echo json_encode($json);
		}
		else
		{
			echo $mysql->errmsg();
		}
	}
	else
	{
		if(!$mysql->runsql("INSERT INTO `HdSsh` (`hdid`, `name`,`content`,`url`,`hdsignend`,`max`) VALUES ('".$hdid."','".$_POST["hdname"]."','".$_POST["hdcontent"]."','".$_POST["hdurl"]."','".$_POST["hdsignend"]."','".$_POST["hdmax"]."')"))
		{
			$json["error"]=0;
			echo json_encode($json);
		}
		else
		{
			echo $mysql->errmsg();
		}
	}
}
function getGuid() {
 $charid = strtoupper(md5(uniqid(mt_rand(), true))); 
 
 $hyphen = chr(45);// "-" 
 $uuid = substr($charid, 0, 8).$hyphen 
 .substr($charid, 8, 4).$hyphen 
 .substr($charid,12, 4).$hyphen 
 .substr($charid,16, 4).$hyphen 
 .substr($charid,20,12);
 return $uuid; 
}
?>