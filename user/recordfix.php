<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"])&& !empty($_POST["problem"]) && !empty($_POST["time"])&& !empty($_POST["phone"]) && !empty($_POST["email"])&& !empty($_POST["place"]))
{
	$mysql=new SaeMysql();
    $time=date("Y-m-d");
	$sql="SELECT `stId` FROM `wxyy` WHERE `date`='".$_POST["time"]."'";
	$result=mysql_query($sql,$mysql->ico);
	$counts=mysql_num_rows($result);
	$stdcounts=$mysql->getLine("SELECT `numperday` FROM `KxFixConf` WHERE 1");
	$data=$mysql->getLine("SELECT `num` FROM `wxyy` WHERE `date`='".$_POST["time"]."' && `stId`='".$_SESSION["stId"]."'");
	if(empty($data) && $counts<$stdcounts["numperday"])
	{    
	   if($_POST["time"]==$time && date("G")<"21")
	   {
		if(!$mysql->runsql("INSERT INTO `wxyy` (`stId`,`problem`,`date`,`place`) VALUES ('".$_SESSION["stId"]."','".$_POST["problem"]."','".$_POST["time"]."','".$_POST["place"]."')")&&!$mysql->runsql("UPDATE `app_nuaakexie`.`wx_user` SET `phone` = '".$_POST["phone"]."', `email` = '".$_POST["email"]."' WHERE `wx_user`.`number` = '".$_SESSION["stId"]."' "))
		{
		    
			$json["error"]=0;
			
			echo json_encode($json);
	
		}
	   }
	   else if($_POST["time"]>$time){
	    
		   if(!$mysql->runsql("INSERT INTO `wxyy` (`stId`,`problem`,`date`,`place`) VALUES ('".$_SESSION["stId"]."','".$_POST["problem"]."','".$_POST["time"]."','".$_POST["place"]."')")&&!$mysql->runsql("UPDATE `app_nuaakexie`.`wx_user` SET `phone` = '".$_POST["phone"]."', `email` = '".$_POST["email"]."' WHERE `wx_user`.`number` = '".$_SESSION["stId"]."' "))
			{
				
				$json["error"]=0;
				
				echo json_encode($json);
		
			}
 
	   }
	   else{
		   $json["error"]=1;
	   }
	} 
}
	


?>