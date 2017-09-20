<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["tableName"])  && !empty($_GET["tableName"]) && !empty($_GET["type"]))
{
	$department["KxXqDm"]="WEB研发部";
	$department["KxXqChy"]="创意设计部";
	$department["KxXqTs"]="网络宣传部";
	$department["KxJsJf"]="技术服务部";
	$department["KxJsDj"]="大疆俱乐部";
	$department["KxShwWl"]="外联部";
	$department["KxShwYj"]="院校交流部";
	$department["KxShwGl"]="管理部";
	$department["KxHdKh"]="科技活动部";
	$department["KxHdKp"]="科技培训部";
	header("Content-type:application/vnd.ms-excel");    
	header("Content-Disposition:filename=".$department[$_GET["tableName"]]."招新信息".$_GET["type"].".xls");
	$mysql=new SaeMysql();
	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_GET["tableName"])
			$t=true;
	}
	
	switch($_GET["type"]){
		case "all":{
			$sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_GET["tableName"]."' group by `stId` order by `stId` ";
		}
		break;
		case "1":{
			$sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_GET["tableName"]."' && `first`=1 group by `stId` order by `stId` ";
		}
		break;
		case "2":{
			$sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_GET["tableName"]."' && `second`=1 group by `stId` order by `stId` ";
		}
		break;
	}

	$result1=mysql_query($sql,$mysql->ico);
	//报名这个部门的总人数
	$num=mysql_num_rows($result1);
	//输出字符串
	$str="学号\t姓名\t手机\t描述\t一面评价\t二面评价\t一面所过部门\t二面所过部门\r";
	$j=$num ;
	
	if($t)
	{
		for($i=0;$i<$j; $i++)
		{
			$result=mysql_fetch_assoc($result1);
			$data=$mysql->getLine("SELECT `name`,`phone`FROM `wx_user` WHERE `number`='".$result["stId"]."'");
			$result["name"]=$data["name"];
			$result["phone"]=$data["phone"];
			
			
			$evaluate=$mysql->getLine("SELECT `firstevaluate`,`secondevaluate` FROM `KxRecruit` WHERE `stId`='".$result["stId"]."' && `department`='".$_GET["tableName"]."'");
			$first=$mysql->getData("SELECT `department` FROM `KxRecruit` WHERE `stId`='".$result["stId"]."' && `first`=1");
			$second=$mysql->getData("SELECT `department` FROM `KxRecruit` WHERE `stId`='".$result["stId"]."' && `second`=1");
			$str.=$result["stId"]."\t".$data["name"]."\t".$data["phone"]."\t".$result["description"]."\t".$evaluate["firstevaluate"]."\t".$evaluate["secondevaluate"]."\t";
			foreach($first as $value){
				$str.=$department[$value["department"]]."\n";
			}
			$str.="\t";
			foreach($second as $value){
				$str.=$department[$value["department"]]."\n";
			}
			$str.="\r";
			
		}
	}
	//$str=iconv('UTF-8',"GB2312//IGNORE",$str);    
    exit(mb_convert_encoding($str,"GB2312","UTF-8"));
	
}
?>