<?php
require_once("../SaeMysql.php");
session_start();
$mysql=new SaeMysql();
$data=$mysql->getLine("SELECT `appid` , `secret` FROM `wxappid` WHERE 1");
if(empty($_GET["code"])){
	header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5815c030faf2288c&redirect_uri=http%3a%2f%2fnuaakx.com%2ft%2fwx%2fscope.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
	die();
}
$ch=curl_init("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$data["appid"]."&secret=".$data["secret"]."&code=".$_GET["code"]."&grant_type=authorization_code");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$data1=curl_exec($ch);
$data1=json_decode($data1);
curl_close($ch);
$ch=curl_init("https://api.weixin.qq.com/sns/userinfo?access_token=".$data1->access_token."&openid=".$data1->openid."&lang=zh_CN");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$data2=curl_exec($ch);
$data2=json_decode($data2);
curl_close($ch);
$_SESSION["openid"]=$data2->openid;
$data=$mysql->getLine("SELECT `number` FROM `wx_user` WHERE `openid`='".$data2->openid."'");
if(!empty($data)){
	if($data["number"]!=$data2->openid)
		$_SESSION["stId"]=$data["number"];
	$mysql->runsql("UPDATE `wx_user` SET `nickname`='".$data2->nickname."' , `sex`='".$data2->sex."' , `headimgurl`='".$data2->headimgurl."' WHERE `openid`='".$data2->openid."'");
}
else
{
	if($mysql->runsql("INSERT INTO `wx_user` (`openid`,`number` ,`sex`,`headimgurl`) VALUES ('".$data2->openid."','".$data2->openid."','".$data2->sex."','".$data2->headimgurl."')"))
	{
		die($mysql->errmsg());
	}
}
echo('<meta http-equiv="refresh" content="0; URL=../user/">');
?>