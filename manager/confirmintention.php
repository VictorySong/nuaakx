<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["tableName"]) && !empty($_POST["intention"]) && !empty($_POST["stId"]) && !empty($_POST["department"]))
{
	$intention=array("1"=>"first","2"=>"second");
	$fromstId=array("1"=>"firststId","2"=>"secondstId");
	$mysql=new SaeMysql();
	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["department"])
			$t=true;
	}
	if($t)
	{
		if(!$mysql->runsql("UPDATE `KxRecruit` SET `".$intention[$_POST["intention"]]."`='1' , `".$fromstId[$_POST["intention"]]."`='".$_SESSION["stId"]."' WHERE `stId`='".$_POST["stId"]."' && `department`='".$_POST["department"]."'"))
		{
			$json["error"]=0;
			echo json_encode($json);
		}
	}
}
	

?>