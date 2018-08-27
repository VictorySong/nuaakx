<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["id"]) && !empty($_SESSION["tableName"]) && !empty($_POST["tableName"]))
{
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	if($t){
		$mysql=new SaeMysql();
		$data=$mysql->getLine("SELECT `stId` FROM `KxRecruitSign` WHERE `stId`='".$_POST["id"]."' && `interviewing`='1' && `end`='0'");
		if(empty($data)){
			if(!$mysql->runsql("UPDATE `KxRecruitSign` SET `interviewing`='1' WHERE `stId`='".$_POST["id"]."' && `department`='".$_POST["tableName"]."'"))
			{
				$mysql->runsql("UPDATE `KxRecruit` SET `cgjudge`='1' WHERE `stId`='".$_POST["id"]."'");
				$json["error"]=0;
				$json["status"]="200";
			}
			else{
				$json["error"]=1;
			}
		}
		else{
			$json["error"]=1;
		}
		echo json_encode($json);
		
	}
}
?>