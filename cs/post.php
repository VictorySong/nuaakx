<?php
include("SaeMysql.php");

if(!empty($_POST["number"]))
{
	$mysql=new SaeMysql();
	$department=$_POST["department"];
	if($mysql->runsql("INSERT INTO `cs1` (`stId`) VALUES ('".$_POST["number"]."'"))
				die($mysql->errmsg());
			
	$json["error"]=0;
	echo json_encode($json);
	
}
		

?>