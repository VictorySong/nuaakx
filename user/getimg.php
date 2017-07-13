<?php
//获取个人照片
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	
	if(empty($_SESSION["ip"]))
		$_SESSION["ip"]=$_SERVER["REMOTE_ADDR"];
	if(empty($_SESSION["img"]))
	{
		$_SESSION["imgt"]=time();//用来记录上一次请求时间
	}		
	else if((time()-$_SESSION["imgt"])<3)
	{
		exit();
	}
	$name=$_SESSION["stId"];
	switch($name)
	{
		case "151550121":
			$name="haha";
		break;
		case "161620310":
			$name="ha";
		break;
	}
	
	//照片存放在 /mydata/images/image 和万象优图中 
	$img = imagecreatefrompng("/yjdata/www/www/ftp/image/".$name.".png");  
	//imagefilter($img, IMG_FILTER_EMBOSS);
	header('Content-Type: image/png');//设置头部
	imagepng($img);  
	imagedestroy($img);  
}
?>