<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["tableName"])&& !empty($_GET["stid"]) && !empty($_GET["department"]))
{
	$mysql=new SaeMysql();
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		$data=$mysql->getLine("SELECT `stId` ,`department` FROM `KxRecruit` WHERE `stId`='".$_GET["stid"]."' && `department`='".$value."'");
		if(!empty($data) && $data["department"]==$_GET["department"])
		{
			$t=true;
			break;
		}
	}
	switch($_GET["stid"])
	{
		case "151550121":
			$_GET["stid"]="haha";
		break;
		case "161620310":
			$_GET["stid"]="ha";
		break;
	}
	if(!empty($data) && $t && substr($_GET["department"],0,4)=="KxXq")
	{
		//照片存放在 /mydata/images/image 和万象优图中 
		$img = imagecreatefrompng("/yjdata/www/www/ftp/image/".$_GET["stid"].".png");  
		//imagefilter($img, IMG_FILTER_EMBOSS);
		header('Content-Type: image/png');//设置头部
		imagepng($img);  
		imagedestroy($img); 
	}
}
?>	