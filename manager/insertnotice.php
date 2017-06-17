<?php
//用来生成通告的html文件
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
$failtimes=0;//记录邮件发送失败数
$message='<html lang="zh-CN"><head>
		<meta http-equiv="Content-type" content="text/html">
		<meta charset="utf-8">
		<title>南航学生科协</title>
		</head>
		<body>
		<h3>%s</h3>
		<p>%s</p>
		<p>%s</p>
		</body>
		</html>';
$mailurl="";
$return["mail"]["all"]=0;
$return["mail"]["fail"]=0;
$noticeid=getGuid();
if(isset($_SESSION['tableName']) && !empty($_SESSION["tableName"]))
{
	if(!empty($_POST))
	{
		
		$table=array(
			"External"=>array("name"=>"KxExternalNotice"),
			"Internal"=>array("name"=>"KxInternalNotice","mail"=>""),
			"Personal"=>array("name"=>"KxPersonalNotice","mail"=>"","tostId"=>"")
		);
		
		if(!empty($_POST["msgtype"]) && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["totableName"]))
		{
			switch($_POST['msgtype'])
			{
				case "text":
				{
					$result=solvetext();
				
					
					
				}
				break;
				case "news":
				{
					$result=solvenews();
				
					
				}
				break;
				case "none":
				{
					$result=solvenone();
				
					
					
				}
				break;
			}
			if($result=="200" && !empty($_POST["mail"]))
			{
				$message=sprintf($message,$_POST["title"],$_POST["description"],$mailurl);
				
				sendmail($message);
			}
			$return["add"]=$result;
			echo json_encode($return);
			
		}
	}
}
function solvetext(){
	$mysql=new SaeMysql();
	if(!empty($_POST["editor"]) )
	{
		$str='<html lang="zh-CN"><head>
    <meta http-equiv="Content-type" content="text/html">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>'.$_POST["title"].'</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- 仍可以用 <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet"> -->
	
	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
	</head>
	<body>
		<div style="margin:0 auto; max-width:600px; min-width:300px;">'.$_POST["editor"].'
		</div>
		<script src="http://nuaakx.com/test/js/imagesong.js"></script>
	</body>
	</html>';
		$name=$_SESSION["stId"].time();
		file_put_contents("../../notice/manager/".$name.".html",$str);
		$url="http://nuaakx.com/notice/manager/".$name.".html";
		$GLOBALS["mailurl"]=$url;
		/*
		$sql="INSERT INTO `".$GLOBALS["table"][$_POST["totableName"]]["name"]."` (`title`,`description`,`msgtype`,`url`,`stId`";
		$sqlend="VALUE ('".$_POST["title"]."','".$_POST["description"]."','".$_POST["msgtype"]."','".$url."','".$_SESSION["stId"]."'";
		foreach($GLOBALS["table"][$_POST["totableName"]] as $key=>$value)
		{
			if($key!="name")
			{
				if(isset($_POST[$key]))
				{
					$sql.=",`".$key."`";
					$sqlend.=",'".$_POST[$key]."'";
				}
			}
		}
		$sql=$sql.")".$sqlend.")";
		if(!$mysql->runsql($sql))
			return "200";
		*/
		$sql="INSERT INTO `Notice` (`noticeid`,`noticetype`,`title`,`description`,`msgtype`,`url`,`stId`";
		$sqlend="VALUES ('".$GLOBALS["noticeid"]."','".$_POST["totableName"]."','".$_POST["title"]."','".$_POST["description"]."','".$_POST["msgtype"]."','".$url."','".$_SESSION["stId"]."'";
		foreach($GLOBALS["table"][$_POST["totableName"]] as $key=>$value)
		{
			if($key!="name")
			{
				if(isset($_POST[$key]))
				{
					$sql.=",`".$key."`";
					$sqlend.=",'".$_POST[$key]."'";
				}
			}
		}
		$sql=$sql.")".$sqlend.")";
		if(!$mysql->runsql($sql))
			return "200";
	}
}
function solvenews(){
	$mysql=new SaeMysql();
	if(!empty($_POST["url"]) )
	{
		$GLOBALS["mailurl"]=$_POST["url"];
		/*
		$sql="INSERT INTO `".$GLOBALS["table"][$_POST["totableName"]]["name"]."` (`title`,`description`,`msgtype`,`url`,`stId`";
		$sqlend="VALUE ('".$_POST["title"]."','".$_POST["description"]."','".$_POST["msgtype"]."','".$_POST["url"]."','".$_SESSION["stId"]."'";
		foreach($GLOBALS["table"][$_POST["totableName"]] as $key=>$value)
		{
			if($key!="name")
			{
				if(isset($_POST[$key]))
				{
					$sql.=",`".$key."`";
					$sqlend.=",'".$_POST[$key]."'";
				}
			}
		}
		$sql=$sql.")".$sqlend.")";
		if(!$mysql->runsql($sql))
			return "200";
		*/
		$sql="INSERT INTO `Notice` (`noticeid`,`noticetype`,`title`,`description`,`msgtype`,`url`,`stId`";
		$sqlend="VALUES ('".$GLOBALS["noticeid"]."','".$_POST["totableName"]."','".$_POST["title"]."','".$_POST["description"]."','".$_POST["msgtype"]."','".$_POST["url"]."','".$_SESSION["stId"]."'";
		foreach($GLOBALS["table"][$_POST["totableName"]] as $key=>$value)
		{
			if($key!="name")
			{
				if(isset($_POST[$key]))
				{
					$sql.=",`".$key."`";
					$sqlend.=",'".$_POST[$key]."'";
				}
			}
		}
		$sql=$sql.")".$sqlend.")";
		if(!$mysql->runsql($sql))
			return "200";
	}
}
function solvenone(){
	$mysql=new SaeMysql();
	/*
	$sql="INSERT INTO `".$GLOBALS["table"][$_POST["totableName"]]["name"]."` (`title`,`description`,`msgtype`,`stId`";
	$sqlend="VALUE ('".$_POST["title"]."','".$_POST["description"]."','".$_POST["msgtype"]."','".$_SESSION["stId"]."'";
	foreach($GLOBALS["table"][$_POST["totableName"]] as $key=>$value)
	{
		if($key!="name")
		{
			if(isset($_POST[$key]))
			{
				$sql.=",`".$key."`";
				$sqlend.=",'".$_POST[$key]."'";
			}
		}
	}
	$sql=$sql.")".$sqlend.")";

	if(!$mysql->runsql($sql))
		return "200";
	else
		return $mysql->errmsg();
	
	*/
	$sql="INSERT INTO `Notice` (`noticeid`,`noticetype`,`title`,`description`,`msgtype`,`stId`";
	$sqlend="VALUES ('".$GLOBALS["noticeid"]."','".$_POST["totableName"]."','".$_POST["title"]."','".$_POST["description"]."','".$_POST["msgtype"]."','".$_SESSION["stId"]."'";
	foreach($GLOBALS["table"][$_POST["totableName"]] as $key=>$value)
	{
		if($key!="name")
		{
			if(isset($_POST[$key]))
			{
				$sql.=",`".$key."`";
				$sqlend.=",'".$_POST[$key]."'";
			}
		}
	}
	$sql=$sql.")".$sqlend.")";
    
	if(!$mysql->runsql($sql))
		return "200";
	else
		return $mysql->errmsg();
	
}
	
//判断被通知 人/群体 类型进行发送邮件
//通知到个人发送，通知到内部人员群发
function sendmail($message){
	$mysql=new SaeMysql();
	switch($_POST["totableName"])
	{
		case "Internal":
		{
			//此时case 的{}是不能删的
			/* 多表记录内部人员时
			$arr=array("KxHdKp","KxHdKh","KxJsDj","KxJsJf","KxShwGl","KxShwWl","KxShwYj","KxXqChy","KxXqDm","KxXqTs");
			foreach($arr as $value)
			{
				$data=$mysql->getData("SELECT `stId` FROM `".$value."` WHERE 1");
				
				foreach($data as $value1)
				{
					$to="";
					$from="kx@nuaakx.com";
					$subject="您有一条新通知";
					$headers = 'From: kx@nuaakx.com' . "\r\n" .
								'Reply-To: 2509792788@qq.com' . "\r\n" ."Content-type:text/html;". "\r\n".
								'X-Mailer: PHP/' . phpversion();
					
					
					$data_wx_user=$mysql->getLine("SELECT `email` FROM `wx_user` WHERE `number` = '".$value1["stId"]."'");
					if(!empty($data_wx_user) && !empty($data_wx_user["email"]))
					{
						$to=$data_wx_user["email"];
					}
					
					if($to)
					{
						
						if(!mail($to,$subject,$message,$headers))
							$GLOBALS["failtimes"]++;
					}
				}
			}*/
			$data=$mysql->getData("SELECT `stId` FROM `KxBm` WHERE 1");
			
			$i=0;
			foreach($data as $value1)
			{
				$to="";
				$from="kx@nuaakx.com";
				$subject="您有一条新通知";
				$headers = 'From: kx@nuaakx.com' . "\r\n" .
							'Reply-To: 2509792788@qq.com' . "\r\n" ."Content-type:text/html;". "\r\n".
							'X-Mailer: PHP/' . phpversion();
				
				
				$data_wx_user=$mysql->getLine("SELECT `email` FROM `wx_user` WHERE `number` = '".$value1["stId"]."'");
			
				if(!empty($data_wx_user) && !empty($data_wx_user["email"]))
				{
					$to=$data_wx_user["email"];
				}
				
				if(!empty($to))
				{
					
					if(!mail($to,$subject,$message,$headers))
						$GLOBALS["failtimes"]++;
				}
				$i++;
			}
			
			$GLOBALS["return"]["mail"]["all"]=$i;
			$GLOBALS["return"]["mail"]["fail"]=$GLOBALS["failtimes"];
			
		}
		break;
		case "Personal":
		{
			if(!empty($_POST["tostId"]))
			{
				$data_wx_user=$mysql->getLine("SELECT `email` FROM `wx_user` WHERE `number` = '".$_POST["tostId"]."' || `email`='".$_POST["tostId"]."'");
				if(!empty($data_wx_user["email"]))
				{
					$to=$data_wx_user["email"];
					$from="kx@nuaakx.com";
					$subject="您有一条新通知";
					$headers = 'From: kx@nuaakx.com' . "\r\n" .
								'Reply-To: 2509792788@qq.com' . "\r\n" ."Content-type:text/html;". "\r\n".
								'X-Mailer: PHP/' . phpversion();
					if(!mail($to,$subject,$message,$headers))
						$GLOBALS["failtimes"]++;
					
				}
				$GLOBALS["return"]["mail"]["all"]=1;
				$GLOBALS["return"]["mail"]["fail"]=$GLOBALS["failtimes"];
			}
		}
		break;
	}
}
							
function getGuid() {
 $charid = strtoupper(md5(uniqid(mt_rand(), true))); 
 
 $hyphen = chr(45);// "-" 
 $uuid = substr($charid, 0, 8).$hyphen 
 .substr($charid, 8, 4).$hyphen 
 .substr($charid,12, 4).$hyphen 
 .substr($charid,16, 4).$hyphen 
 .substr($charid,20,12);
 return $uuid; 
}
	
	
?>