<?php
require_once("../SaeMysql.php");
function getaccesstoken(){
	$mysql=new SaeMysql();
	$exist=$mysql->getLine("SELECT `token` ,`time` FROM `accesstoken` WHERE 1");
	if(empty($exist) || (time()-$exist["time"])>7200)
	{
		$ch=curl_init("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx5815c030faf2288c&secret=857641c9c9e4dbe04bd45ca9f3fc884c");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$data=curl_exec($ch);
		$data=json_decode($data);
		
		
		$mysql->runsql("DELETE FROM `accesstoken` WHERE 1");
		if(!$mysql->runsql("INSERT INTO `accesstoken` (`token`,`time`) VALUES ('".$data->access_token."','".time()."')")){
		
			echo $data->access_token;
		}else{
			echo $mysql->errmsg();
		}

		
	}
	else{
		echo $exist["token"];
	}
}
?>