<?php
require_once("../SaeMysql.php");
class JSSDK {
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
	$token=$this->getAccessToken();
	$mysql=new SaeMysql();
	$exist=$mysql->getLine("SELECT `ticket` ,`time` FROM `jsapiticket` WHERE 1");
	if(empty($exist) || (time()-$exist["time"])>7200){
		$ch=curl_init("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$token."&type=jsapi");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$data=curl_exec($ch);
		$data=json_decode($data);
		
		
		$mysql->runsql("DELETE FROM `jsapiticket` WHERE 1");
		if(!$mysql->runsql("INSERT INTO `jsapiticket` (`ticket`,`time`) VALUES ('".$data->ticket."','".time()."')")){
		
			return $data->ticket;
		}
		else{
			die($mysql->errmsg());
		}
	}else{
		return $exist["ticket"];
	}
	
  }

  private function getAccessToken() {
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
		
			return $data->access_token;
		}
		else{
			die($mysql->errmsg());
		}
		
	}
	else{
		return $exist["token"];
	}
  }

}

