<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(isset($_GET["tableName"]) && isset($_GET["p"]) && !empty($_SESSION["tableName"]))
{
	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_GET["tableName"])
			$t=true;
	}
	$mysql=new SaeMysql();
	/* 多个表记录部门人数
	//取得该部门总人数
	$result1=mysql_query("SELECT `stId` FROM `".$_GET["tableName"]."` WHERE 1 order by `date` desc",$mysql->ico);
	$num=mysql_num_rows($result1);
	*/
	//单个表记录部门人数
	$result1=mysql_query("SELECT `stId` FROM `KxBm` WHERE `Department`='".$_GET["tableName"]."' order by `date` desc",$mysql->ico);
	$num=mysql_num_rows($result1);
	$j=(($_GET["p"]*10)>$num) ? $num : $_GET["p"]*10;
	$result=array();//用来存放结果
	$k=0;//用来计数
	if($t)
	{
		for($i=0;$i<$j; $i++)
		{
			if($i<(($_GET["p"]-1)*10))
				mysql_fetch_assoc($result1);
			else
			{
				$result[$k]=mysql_fetch_assoc($result1);
				$data=$mysql->getLine("SELECT `name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$result[$k]["stId"]."'");
				$result[$k]["name"]=$data["name"];
				$result[$k]["phone"]=$data["phone"];
				$result[$k]["email"]=$data["email"];
				
				$k++;
			}
		}
	}
	else{
		for($i=0;$i<$j; $i++)
		{
			if($i<(($_GET["p"]-1)*10))
				mysql_fetch_assoc($result1);
			else
			{
				$result2=mysql_fetch_assoc($result1);
				$data=$mysql->getLine("SELECT `name` FROM `wx_user` WHERE `number`='".$result2["stId"]."'");
				$result[$k]["name"]=$data["name"];
							
				$k++;
			}
		}
	}

	$response["result"]=$result;
	$response["total"]=$num;
	$json=json_encode($response);
	echo $json;
}
	
?>