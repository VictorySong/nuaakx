<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_GET["postid"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getLine("SELECT `stId` FROM `PostThumbs` WHERE `stId`='".$_SESSION["stId"]."' && `postid`='".$_GET["postid"]."'");
	if(empty($data))
	{
		if(!$mysql->runsql("INSERT INTO `PostThumbs` (`postid`,`stId`) VALUE ('".$_GET["postid"]."','".$_SESSION["stId"]."')"))
		{
			$json["error"]=0;
			echo json_encode($json);
		}
		else{
			echo $mysql->errmsg();
		}
	}
}
?>