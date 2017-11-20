<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
define("N",20);
if(!empty($_SESSION["tableName"]) )
{
	$mysql=new SaeMysql();
	
	
	$sql="SELECT * FROM `KxTs`";

	$result1=mysql_query($sql,$mysql->ico);
	$num=mysql_num_rows($result1);
	$result=array();//用来存放结果
	$k=0;//用来计数
	if($t)
	{
		for($i=0;$i<$num; $i++)
		{
			
				$result[$k]=mysql_fetch_assoc($result1);
				$data=$mysql->getLine("SELECT `name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$result[$k]["stId"]."'");
				$result[$k]["name"]=$data["name"];
				$result[$k]["phone"]=$data["phone"];
				$result[$k]["email"]=$data["email"];
				$result[$k]["department"]=$mysql->getData("SELECT `question` FROM `KxTs` WHERE `stId`='".$result[$k]["stId"]."'");
				
				$k++;
			
		}
	}
	$json["error"]=0;
	$json["msg"]=$result;
	$json["num"]=$num;
	echo json_encode($json);
}
?>