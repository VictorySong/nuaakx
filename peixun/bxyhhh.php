<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<form action="bxywelcome.php" method="post">
学号：<input type="number" id="stId"><br>
<input type="submit">
</form>
	
<?php//实现搜索功能。通过网页搜索，输入学号，能在科协数据库查找名字等相关信息并显示出来，通过网页显示
$json=array(); 
$_SESSION["stId"]=document.getElementById("stId").value;

include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$name=$mysql->getLine("SELECT `name` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	//$json=array();
	if(!empty($data))
	{
		$json["error"]=0;
		$json["email"]=$data["email"];
		$json["name"]=$name["name"];
	}
	else
	{
		$json["error"]=1;
	}
}
?>

</body>
</html>



