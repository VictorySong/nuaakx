<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["tableName"]) && !empty($_POST["p"]) && !empty($_POST["tableName"]))
{
	$mysql=new SaeMysql();
	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	
	//报名这个部门的总人数
	//$data=$mysql->getData("SELECT `stId`,`description` FROM `KxRecruit` AS A WHERE num = (SELECT MAX(num) FROM `KxRecruit` WHERE `stId`=A.stId order by `stId`) && `department`='".$_POST["tableName"]."' ");
	$sql="SELECT `stId`,`description` FROM `KxRecruit` AS A WHERE num = (SELECT MAX(num) FROM `KxRecruit` WHERE `stId`=A.stId order by `stId` && `department`='".$_POST["tableName"]."') ";

	$result1=mysql_query($sql,$mysql->ico);
	$num=mysql_num_rows($result1);
	
	$j=(($_POST["p"]*20)>$num) ? $num : $_POST["p"]*20;
	$result=array();//用来存放结果
	$k=0;//用来计数
	if($t)
	{
		for($i=0;$i<$j; $i++)
		{
			if($i<(($_POST["p"]-1)*20))
				mysql_fetch_assoc($result1);
			else
			{
				$result[$k]=mysql_fetch_assoc($result1);
				$data=$mysql->getLine("SELECT `name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$result[$k]["stId"]."'");
				$result[$k]["name"]=$data["name"];
				$result[$k]["phone"]=$data["phone"];
				$result[$k]["email"]=$data["email"];
				$result[$k]["department"]=$mysql->getData("SELECT `department`,`first`,`second`,`firstevaluate`,`secondevaluate` FROM `KxRecruit` WHERE `stId`='".$result[$k]["stId"]."'");
				
				$k++;
			}
		}
	}
	$json["error"]=0;
	$json["msg"]=$result;
	$json["num"]=$num;
	echo json_encode($json);
}
?>