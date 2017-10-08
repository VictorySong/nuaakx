<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["type"]) && !empty($_POST["description"]))
{
	$mysql=new SaeMysql();
	$nickname=$mysql->getLine("SELECT `nickname` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	
	$html='<html lang="zh-CN"><head>
	<meta http-equiv="Content-type" content="text/html">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="">
	<meta name="author" content="">

	<title>%s</title>


	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- 仍可以用 <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet"> -->

   
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link href="../test/Forum/css/index.css" rel="stylesheet">

  </head>
  <body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" style="float:left;" data-toggle="collapse"
					data-target="#accordion">
				<span class="sr-only">切换导航</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">论坛</a>
			<button type="button" class="navbar-toggle" style="border:0px;" data-toggle="collapse"
					data-target="#example-navbar-collapse-search">
				<span class="sr-only">切换导航</span>
				<span class="glyphicon glyphicon-search"></span>
				
			</button>
		</div>
		<div class="collapse navbar-collapse" id="accordion">
			<ul class="nav navbar-nav">

				<li><a href="../test/user/login.html" cont="nologin">登录</a></li>
				<li><a href="../test/user/register.html" cont="nologin">注册</a></li>
				<li><a href="#" id="logout" cont="alreadylogin">退出</a></li>
				<li><a href="../test/Forum/editpost.html">发表</a></li>
				<!--
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						类型
						 <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"></a></li>
						<li><a href="#">历史</a></li>
						
					</ul>
				</li>
				-->
			</ul>
			<!--
			<form class="navbar-form navbar-right" align="center" style="border:0px;">
				
				
				<input type="text" class="form-control" style="border-radius:16px; display:inline-block; width:250px;" placeholder="搜索" >
				<button type="submit" class="btn btn-default" style="border-radius:16px; ">
					搜索
				</button>
			</form>
			-->
		</div>
		
		<div class="collapse " id="example-navbar-collapse-search">
			<!--
			<form class="navbar-form navbar-right" align="center" style="border:0px;">
				
				<input type="text" class="form-control" style="border-radius:16px; display:inline-block; width:250px;" placeholder="搜索">
				 

				<button type="submit" class="btn btn-default" style="border-radius:16px; ">
					搜索
				</button>
				
			</form>
			-->
		</div>
		</div>
	</nav>
	<div style="height:51px;">
	</div>
	<div id="content" style="min-width:350px; max-width:500px; margin:0 auto;">
		<div id="contentp" class="contentp">
			<div class="content" >
				<div class="content-table-cell">
					<span class="avatar glyphicon glyphicon-cloud" cont="avatar"></span>
				</div>
				<div class="content-table-cell">
					<a>'.$nickname["nickname"].'</a>
					<div>'.$_POST["description"].'<br>%s</div>
					<div class="img" cont="img" >
						<div></div>
						<div></div>
					</div>
					<div class="last" postid="%s">
						<span cont="time">'.date("Y-m-d").'</span>
						
						<span class="glyphicon glyphicon-pencil"></span>
						
							<span class="glyphicon glyphicon-thumbs-up" cont="thumbs" to="thumbs" alreadythumb="false"></span>
							<span class="thumbs" cont="thumbs"></span>
						
					</div>
					<div class="comment">
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<!-- ...........................................    -->
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<!-- 或者用 <script src="../test/js/jquery-3.2.1.min.js"></script> -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- 或者用 <script src="../test/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> -->	
	<script src="../test/js/md5.js"></script>
	<script src="http://nuaakx.com/test/js/imagesong.js"></script>
	<script >
		window.postid="%s";
	</script>
	<script src="../test/Forum/js/post.js"></script>
  </body>
</html>	';
	
	$postId=getGuid();
	if(!empty($_POST["title"])  && !empty($_POST["content"]))
	{
		$str=sprintf($html,$_POST["title"],$_POST["content"],$postId,$postId);
		file_put_contents("../../post/".$postId.".html",$str);	
		$url="http://nuaakx.com/post/".$postId.".html";
		if(!$mysql->runsql("INSERT INTO `PostRecord` (`postId`,`stId`,`type`, `description`,`title`,`url`) VALUE ('".$postId."','".$_SESSION["stId"]."','".$_POST["type"]."','".$_POST["description"]."','".$_POST["title"]."','".$url."')"))
		{
			$json["error"]=0;
			$json["msg"]="";
			echo json_encode($json);
		}
		else
			echo $mysql->errmsg();
	}
	else
	{
		$str=sprintf($html,$nickname["nickname"]."的日常","",$postId,$postId);
		file_put_contents("../../post/".$postId.".html",$str);	
		$url="http://nuaakx.com/post/".$postId.".html";
		if(!$mysql->runsql("INSERT INTO `PostRecord` (`postId`,`stId`,`type`, `description`,`url`) VALUE ('".$postId."','".$_SESSION["stId"]."','".$_POST["type"]."','".$_POST["description"]."','".$url."')"))
		{
			$json["error"]=0;
			$json["msg"]="";
			echo json_encode($json);
		}
		else
			echo $mysql->errmsg();
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