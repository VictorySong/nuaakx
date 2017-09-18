<?php
require_once("../SaeMysql.php");
session_start();
if(!empty($_POST["department"]) && !empty($_POST["stId"]) && !empty($_POST["fromdp"]) && !empty($_SESSION["stId"]) && !empty($_SESSION["tableName"])){
	$mysql=new SaeMysql();
	$t=false;
	foreach($_SESSION["tableName"] as $value){
		$data=$mysql->getLine("SELECT `description` FROM `KxRecruit` WHERE `stId`='".$_POST["stId"]."' && `department`='".$value."'");
		if(!empty($data) && $value==$_POST["fromdp"]){
			$description=$data["description"];
			$t=true;
			break;
		}
	}
	if($t){
		$data1=$mysql->getLine("SELECT `stId` FROM `KxRecruit` WHERE `department`='".$_POST["department"]."' && `stId`='".$_POST["stId"]."'");
		if(empty($data1)){
			if(!$mysql->runsql("INSERT INTO `KxRecruit` (`stId`,`department`,`fromdp`,`description`,`fromdpstId`) VALUES ('".$_POST["stId"]."','".$_POST["department"]."','".$_POST["fromdp"]."','".$description."','".$_SESSION["stId"]."')")){
				$data=$mysql->getLine("SELECT `number` FROM `KxRecruitSign` WHERE `stId`='".$_POST["stId"]."'");
				if(!empty($data)){
					if(!$mysql->runsql("INSERT INTO `KxRecruitSign` (`stId`,`department`,`number`) VALUES ('".$_POST["stId"]."','".$_POST["department"]."','".$data["number"]."')")){
						$json["error"]=0;
						echo json_encode($json);
					}
				}
				else{
					$json["error"]=0;
					echo json_encode($json);
				}
			}
		}
	}
	
}


?>