<?php
//将base64图片保存 并返回链接
session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if( !empty($_SESSION["stId"]))
{
	if(empty($_POST["originalurl"]) && !empty($_POST["url"]))
	{
		
		$url=base64_decode(str_replace(" ",",",$_POST['url']));
		$temp=uniqid(mt_rand(), true);
		$name="../../images/manager/".$_SESSION['stId'].$temp.".png";
		file_put_contents($name,$url);
		$name="images/manager/".$_SESSION['stId'].$temp.".png";
		echo "http://nuaakx.com/".$name;
	}
	else if(!empty($_POST["originalurl"]) && !empty($_POST["url"]))
	{
		$url=base64_decode(str_replace(" ",",",$_POST['url']));
		$originalurl=base64_decode(str_replace(" ",",",$_POST['originalurl']));
		$temp=uniqid(mt_rand(), true);
		$name="../../images/manager/".$_SESSION['stId'].$temp.".png";
		file_put_contents($name,$url);
		$name="images/manager/".$_SESSION['stId'].$temp.".png";
		$json["url"]="http://nuaakx.com/".$name;
		
		$temp=uniqid(mt_rand(), true);
		$name="../../images/manager/".$_SESSION['stId'].$temp.".png";
		file_put_contents($name,$originalurl);
		$name="images/manager/".$_SESSION['stId'].$temp.".png";
		$json["originalurl"]="http://nuaakx.com/".$name;
		echo json_encode($json);
	}
}

?>