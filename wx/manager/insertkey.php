<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION['tableName']))
{
	
	$mysql=new SaeMysql();
	if(!empty($_GET['keywords']))
	{
		
		if(!preg_match("/^\//",$_GET['keywords']) && !preg_match("/\/$/",$_GET['keywords']))
		{
			
			$_GET['keywords']="/".$_GET['keywords']."/";
			if($_GET['msgtype']=="text" && !empty($_GET['content']))
			{
				
				if($mysql->runsql("INSERT INTO `CustomizeKeyWords` (`keywords`,`content`,`msgtype`,`stId`) VALUE ('".$_GET['keywords']."','".$_GET['content']."','".$_GET['msgtype']."','".$_SESSION['stId']."')"))
					$mysql->runsql("UPDATE `CustomizeKeyWords` SET `content`='".$_GET['content']."',`msgtype`='".$_GET['msgtype']."',`stId`='".$_SESSION['stId']."' WHERE `keywords`='".$_GET['keywords']."'");

				die("200");
			}
			else if($_GET['msgtype']=="news" && !empty($_GET['title']) && !empty($_GET['url']) )
			{
				if($mysql->runsql("INSERT INTO `CustomizeKeyWords` (`keywords`,`msgtype`,`title`,`description`,`picurl`,`url`,`stId`) VALUE ('".$_GET['keywords']."','".$_GET['msgtype']."','".$_GET['title']."','".$_GET['description']."','".$_GET['picurl']."','".$_GET['url']."','".$_SESSION['stId']."')"))
					$mysql->runsql("UPDATE `CustomizeKeyWords` SET `msgtype`='".$_GET['msgtype']."',`title`='".$_GET['title']."',`description`='".$_GET['description']."',`picurl`='".$_GET['picurl']."',`url`='".$_GET['url']."',`stId`='".$_SESSION['stId']."' WHERE `keywords`='".$_GET['keywords']."'");
				if($mysql->errno()!=0)
					echo $mysql->errmsg();
				
				die("200");
			}
		}
		else {
			foreach($_SESSION['tableName'] as $key=>$value)
			{
				if($value=="KxXqDm")
				{
					if($_GET['msgtype']=="text" && !empty($_GET['content']))
					{
						
						$mysql->runsql("INSERT INTO `CustomizeKeyWords` (`keywords`,`content`,`msgtype`,`stId`) VALUE ('".$_GET['keywords']."','".$_GET['content']."','".$_GET['msgtype']."','".$_SESSION['stId']."')");
						
						die("200");
					}
					else if($_GET['msgtype']=="news" && !empty($_GET['title']) && !empty($_GET['url']) )
					{
						$mysql->runsql("INSERT INTO `CustomizeKeyWords` (`keywords`,`msgtype`,`title`,`description`,`picurl`,`url`,`stId`) VALUE ('".$_GET['keywords']."','".$_GET['msgtype']."','".$_GET['title']."','".$_GET['description']."','".$_GET['picurl']."','".$_GET['url']."','".$_SESSION['stId']."')");
						die("200");
					}
				}
			}
		}
	}
}
?>