<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["toid"]) && !empty($_POST["content"]))
{
	$commentid=getGuid();
	$mysql=new SaeMysql();
	if(!$mysql->runsql("INSERT INTO `PostComment` (`postid`,`commentid`,`stId`,`content`) VALUE ( '".$_POST["toid"]."','".$commentid."','".$_SESSION["stId"]."','".$_POST["content"]."')"))
	{
		$json["error"]=0;
		$json["msg"]["commentid"]=$commentid;
		$json["msg"]["stId"]=$_SESSION["stId"];
		echo json_encode($json);
		
	}
	else
		echo $mysql->errmsg();
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