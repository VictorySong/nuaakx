<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_GET["postid"]))
{
	$mysql=new SaeMysql();
	$sql="SELECT `stId` FROM `PostThumbs` WHERE `postid`='".$_GET["postid"]."'";
	$result=mysql_query($sql,$mysql->ico);
	$data["msg"]["thumbs"]=mysql_num_rows($result);
	if(!empty($_SESSION["stId"]))
		$alreadythumb=$mysql->getLine("SELECT `stId` FROM `PostThumbs` WHERE `postid`='".$_GET["postid"]."' && `stId`='".$_SESSION["stId"]."'");
	else
		$alreadythumb="";
	if(!empty($alreadythumb))
		$data["msg"]["alreadythumb"]="true";
	else
		$data["msg"]["alreadythumb"]="false";
	echo json_encode($data);
}