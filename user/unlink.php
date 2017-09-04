<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_SESSION["openid"])){
	$mysql=new SaeMysql();
	$exist=$mysql->getLine("SELECT `openid`,`sex`,`headimgurl` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	if(!empty($exist) && $exist["openid"]==$_SESSION["openid"]){
		if(!$mysql->runsql("UPDATE `wx_user` SET `openid`=null ,`sex`=null ,`headimgurl`=null WHERE `number`='".$_SESSION["stId"]."'"))
		{
			$mysql->runsql("INSERT INTO `wx_user` (`openid`,`number` ,`sex`,`headimgurl`) VALUES ('".$exist["openid"]."','".$exist["openid"]."','".$exist["sex"]."','".$exist["headimgurl"]."')");
			$json["error"]=0;
			echo json_encode($json);
		}
		
	}
}
?>