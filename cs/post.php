<?php
include("SaeMysql.php");

//if(!empty($_POST["num"]) && !empty($_POST["vue"]))
{
	$mysql=new SaeMysql();
	if($mysql->runsql("INSERT INTO `text` (`num`,`vue`) VALUES ('".$_POST["num"]."','".$_POST["vue"]."') "))
//				die($mysql->errmsg());
			
	$json["error"]=0;
	echo json_encode($json);
	
}
		

?>