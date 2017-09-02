<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["id"]) && !empty($_SESSION["tableName"]) && !empty($_POST["tableName"]))
{
	//判断是否是该部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	if($t){
		$mysql=new SaeMysql();
		$data=$mysql->getLine("SELECT `postpone`,`num`,`interviewing`,`end` FROM `KxRecruitSign` WHERE `stId`='".$_POST["id"]."' && `department`='".$_POST["tableName"]."'");
		if(!empty($data) && $data["interviewing"]==0 && $data["end"]==0)
		{
			$data["postpone"]++;
			if(!$mysql->runsql("UPDATE `KxRecruitSign` SET `postpone` = '".$data["postpone"]."' WHERE `num`='".$data["num"]."'"))
			{
				$json["error"]=0;
				$json["status"]="200";
			}
		}
	}
	echo json_encode($json);
}
?>