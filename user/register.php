<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_POST["Password"]) && !empty($_POST["email"]) && !empty($_POST["nickname"]) && !empty($_POST["name"]))
{
	if(preg_match("/@qq.com/",$_POST["email"]))
	{
		
		$mysql=new SaeMysql();
		$exist=$mysql->getLine("SELECT `number` FROM `wx_user` WHERE `email`='".$_POST["email"]."' || `number`='".$_POST["email"]."'");
		$subject="欢迎来到科协";
		$message="欢迎注册科协";
		$headers = 'From: kx@nuaakx.com' . "\r\n" .
					'Reply-To:2509792788@qq.com'. "\r\n" ."Content-type:text/html;". "\r\n".
					'X-Mailer: PHP/' . phpversion();
		
		if(empty($exist))
		{
			if(mail($_POST["email"],$subject,$message,$headers))
			{
				if(!$mysql->runsql("INSERT INTO `wx_user` (`code`,`number`,`email`,`nickname`,`name`) VALUE ('".$_POST["Password"]."','".$_POST["email"]."','".$_POST["email"]."','".$_POST["nickname"]."','".$_POST["name"]."')"))
				{
					echo "200";
					$_SESSION["stId"]=$stId;
				}
				else
					echo $mysql->errmsg();
			}
		}
		else {
			echo "该账号已注册";
		}

	}
}


?>