<html>
<meta charset="utf-8">
<body>

Welcome <?php echo json_encode($json["email"]); ?><br>
Your email address is: <?php echo json_encode($json["name"]); ?>


<?php//实现搜索功能。通过网页搜索，输入学号，能在科协数据库查找名字等相关信息并显示出来，通过网页显示
$json=array(); 


include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($POST["id"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `email` FROM `wx_user` WHERE `number`='".$_POST["id"]."'");
	$name=$mysql->getData("SELECT `name` FROM `wx_user` WHERE `number`='".$_POST["id"]."'");
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