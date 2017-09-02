<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["stId"]) && $_SESSION["stId"]==$_POST["stId"])
{
	$mysql=new SaeMysql();
	
	$exist=$mysql->getLine("SELECT `stId` FROM `KxRecruitSign` WHERE `stId`='".$_POST["stId"]."'");
	if(empty($exist)){
		$inf=$mysql->getData("SELECT `stId` ,`department` FROM `KxRecruit` WHERE `stId`='".$_POST["stId"]."'");
		$data=$mysql->getLine("SELECT `number` FROM `KxRecruitSign` order by `number` desc");
		empty($data)?$number=1:$number=$data["number"]+1;
		if(!empty($inf)){
			foreach($inf as $value){
				$mysql->runsql("INSERT INTO `KxRecruitSign` (`stId`,`department`,`number`) VALUES ('".$_POST["stId"]."','".$value["department"]."','".$number."')");
				if(!$mysql->errno())
				{
					$json["error"]=0;
				}
				else
				{
					$json["error"]=1;
					
					exit(json_encode($json));
				}
			}
			$json["status"]="200";
		}else{
			$json["error"]=0;
			$json["status"]="401";
		}
	}
	else{
		$json["error"]=0;
		$json["status"]="400";
	}
	echo json_encode($json);
	
	
}
?>