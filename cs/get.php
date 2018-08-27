<?php
include("SaeMysql.php");

    $mysql=new SaeMysql();
	$data=$mysql->getData("SELECT `num`,`vue` FROM `text` ");
	if(!empty($data))
	{
		$json["error"]=0;
		$json["department"]=$data;
		
	}		
	else{
    
          $json["error"]=1;
    }	
	echo json_encode($json);
		

?>