<?php
include("SaeMysql.php");

if(!empty($_POST["number"]))
{
	$mysql=new SaeMysql();
	if($mysql->runsql("INSERT INTO `cs1` (`vue`) VALUES ('".$_POST["number"]."') "))
				die($mysql->errmsg());
			
	$json["error"]=0;
	echo json_encode($json);
	
}
		

?>