<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
//$_SESSION["stId"]="151550121";
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	//循环从科协内部人员数据表中获取数据
	/*   从用多个数据表记录部门信息 改成 用单个数据表记录部门信息
	$arr=array("KxHdKp","KxHdKh","KxJsDj","KxJsJf","KxShwGl","KxShwWl","KxShwYj","KxXqChy","KxXqDm","KxXqTs");
	$data=array();
	$data[0]=array("addkeywords"=>"getkeywords.html","editnotice"=>"editnotice.html");
	
	$_SESSION["tableName"]=array();
	$dataKX=$mysql->getLine("SELECT  `nickname` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");//仍然要注意 number 和 stId 的问题
	$dataKx=array("stId"=>$_SESSION["stId"],"nickname"=>$dataKX["nickname"]);
	foreach($arr as $key=>$value)
	{
		$dataKxtable=$mysql->getLine("SELECT `stId` FROM `".$value."` WHERE `stId`='".$_SESSION["stId"]."'");
		if(!empty($dataKxtable))
		{
			$dataKx["tableName"]=$value;
			array_push($_SESSION["tableName"],$value);
			array_push($data,$dataKx);
		}
	}
	
		
	
	$json=json_encode($data);

	//输出所属部门有关信息 以便界面的调整
	echo $json;
	
	*/
	//改后
	//获取个人及部门信息
	$data=$mysql->getData("SELECT `Department` FROM `KxBm` WHERE `stId`='".$_SESSION["stId"]."' ");
	if(!empty($data))
	{
		$i=0;
		foreach($data as $value)
		{
			$_SESSION["tableName"][$i]=$value["Department"];
			$i++;
		}
	}
	$person=$mysql->getLine("SELECT `nickname`,`name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$_SESSION["stId"]."'");
	$json["error"]=0;
	$person["tableName"]=$_SESSION["tableName"];
	$json["inf"]=$person;
	echo json_encode($json);
	
}
		
		




?>