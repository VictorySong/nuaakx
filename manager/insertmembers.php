<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["tableName"]) && !empty($_POST["tableName"]) && !empty($_POST["stId"]))
{
	foreach($_SESSION["tableName"] as $value)
	{
		
		if($_POST["tableName"]==$value)
		{
			$mysql=new SaeMysql();
			$data=$mysql->getLine("SELECT `number` FROM `wx_user` WHERE `number` ='".$_POST["stId"]."' || `email`='".$_POST["stId"]."'");			
			if(!empty($data))
			{
				
				$dataexist=$mysql->getLine("SELECT `stId` FROM `KxBm` WHERE `stId`='".$_POST["stId"]."'&& `Department`='".$_POST["tableName"]."' ");
				if(empty($dataexist))
				{
					if(!$mysql->runsql("INSERT INTO `KxBm` (`stId`,`Department`) VALUE ('".$_POST["stId"]."','".$_POST["tableName"]."')"))
					{
						echo "200";
					}
					else{
						echo $mysql->errmsg();
					}
				}
				else{
					die("201");
				}
			}
		}
	}
}

?>