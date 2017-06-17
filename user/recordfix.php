<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"])&& !empty($_POST["problem"]) && !empty($_POST["time"]))
{
	$mysql=new SaeMysql();
	if(date("G")<"19")
		$time=date("Y-m-d");
	else
		$time=date("Y-m-d",time()+86400);
	$sql="SELECT `stId` FROM `wxyy` WHERE `date`='".$_POST["time"]."'";
	$result=mysql_query($sql,$mysql->ico);
	$counts=mysql_num_rows($result);
	$stdcounts=$mysql->getLine("SELECT `numperday` FROM `KxFixConf` WHERE 1");
	$data=$mysql->getLine("SELECT `num` FROM `wxyy` WHERE `date`='".$_POST["time"]."' && `stId`='".$_SESSION["stId"]."'");
	if(empty($data) && $counts<$stdcounts["numperday"] && !($_POST["time"]<$time))
	{
		if(!$mysql->runsql("INSERT INTO `wxyy` (`stId`,`problem`,`date`) VALUES ('".$_SESSION["stId"]."','".$_POST["problem"]."','".$_POST["time"]."')"))
		{
			$json["error"]=0;
			echo json_encode($json);
		}
		else
			echo $mysql->errmsg();
	}
}
	


?>