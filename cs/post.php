<?php
include("SaeMysql.php");

if(!empty($_POST["number"]))
{
	$mysql=new SaeMysql();
	if($mysql->runsql("INSERT INTO `cs1` `stId` VALUES '".$_POST["number"]."' ")
	{
		$json["error"]=0;
	}
	else{
	    $json["error"]=1;
	}


	echo json_encode($json);
	
}
		

?>