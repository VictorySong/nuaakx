<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["tableName"]) && !empty($_POST["content"]) )
{
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	if($t)
	{
		if(!empty($_POST["email"]))
		{
			$str='<html lang="zh-CN"><head>
				<meta http-equiv="Content-type" content="text/html">
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
				<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
				<meta name="description" content="">
				<meta name="author" content="">

				<title>部门通知</title>

				<!-- Bootstrap core CSS -->
				<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
				<!-- 仍可以用 <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet"> -->
				
				<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
				<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
				<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
				</head>
				<body>
					<div style="max-width:600px; min-width:300px;">'.$_POST["content"].'
					</div>
				</body>
				</html>';
				$name=$_SESSION["stId"].time();
				file_put_contents("../../notice/manager/".$name.".html",$str);
				$url="http://nuaakx.com/notice/manager/".$name.".html";
			$mysql=new SaeMysql();
			$data=$mysql->getLine("SELECT `number` FROM `wx_user` WHERE `email`='".$_POST["email"]."'");
			$data2=$mysql->getLine("SELECT `email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
			if(!empty($data) && !empty($data2))
			{
				$to=$_POST["email"];
				$from="kx@nuaakx.com";
				$subject="您有一条新通知";
				$headers = 'From: kx@nuaakx.com' . "\r\n" .
							'Reply-To:' .$data2["email"]. "\r\n" ."Content-type:text/html;". "\r\n".
							'X-Mailer: PHP/' . phpversion();
				if(!mail($to,$subject,$str,$headers))
					die("401");
				if($mysql->runsql("INSET INTO `KxPersonalNotice` (`title` ,`description`, `msgtype`,`url`,`stId`,`tostId`) VALUES ('部门通知','部门通知','news','".$url."','".$_SESSION["stId"]."','".$data["number"]."')"))
					echo "200";
				else
					echo $mysql->errmsg();
			}
			else
			{
				echo "404";
			}
		}
		else if(!empty($_POST["all"])){
			$str='<html lang="zh-CN"><head>
				<meta http-equiv="Content-type" content="text/html">
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
				<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
				<meta name="description" content="">
				<meta name="author" content="">

				<title>部门通知</title>

				<!-- Bootstrap core CSS -->
				<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
				<!-- 仍可以用 <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet"> -->
				
				<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
				<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
				<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
				</head>
				<body>
					<div style="max-width:600px; min-width:300px;">'.$_POST["content"].'
					</div>
				</body>
				</html>';
				$name=$_SESSION["stId"].time();
				file_put_contents("../../notice/manager/".$name.".html",$str);
				$url="http://nuaakx.com/notice/manager/".$name.".html";
			$mysql=new SaeMysql();
			//部门分开记录时
			//$data=$mysql->getData("SELECT `stId` FROM `".$_POST["tableName"]."` WHERE 1");
			$data=$mysql->getData("SELECT `stId` FROM `KxBm` WHERE `Department`='".$_POST["tableName"]."'");
			$data2=$mysql->getLine("SELECT `email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
			
			if(!empty($data) && !empty($data2))
			{
				$from="kx@nuaakx.com";
				$subject="您有一条新通知";
				$headers = 'From: kx@nuaakx.com' . "\r\n" .
							'Reply-To:' .$data2["email"]. "\r\n" ."Content-type:text/html;". "\r\n".
							'X-Mailer: PHP/' . phpversion();
				$fail=0;//发送失败计数
				$success=0;//发送成功计数
				foreach($data as $value)
				{
					$to=$mysql->getLine("SELECT `email` FROM `wx_user` WHERE `number`='".$value["stId"]."'");
					
					if(!empty($to))
					{
						if(!mail($to["email"],$subject,$str,$headers))
							$fail++;
						else
						{
							//通知分开记录时
							//$mysql->runsql("INSERT INTO `KxPersonalNotice` (`title` ,`description`, `msgtype`,`url`,`stId`,`tostId`) VALUES ('部门通知','部门通知','news','".$url."','".$_SESSION["stId"]."','".$value["stId"]."')");
							$mysql->runsql("INSERT INTO `Notice` (`noticetype`,`title` ,`description`, `msgtype`,`url`,`stId`,`tostId`) VALUES ('Personal','部门通知','部门通知','news','".$url."','".$_SESSION["stId"]."','".$value["stId"]."')");
							$success++;
						}
					}
					else{
						$fail++;
					}
				}
				$json=array();
				
				$json["fail"]=$fail;
				$json["success"]=$success;
				echo json_encode($json);
				
				
			}
			else
			{
				echo "404";
			}
		}
	}
		
}
		

?>