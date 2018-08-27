<?php

include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
$mysql=new SaeMysql();
if( !empty($_POST["num"]) )
{
	
	
		 if(!$mysql->runsql("UPDATE  `KxTs`  SET `ok`= 1  WHERE `num`='".$_POST["num"]."' "))
			{
				$json["error"]=0;
				echo json_encode($json);
			}
			
		
	
}
?>