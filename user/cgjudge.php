<?php

include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
$mysql=new SaeMysql();
$sql="SELECT `stId` FROM `KxRecruit` WHERE `stId`='".$_SESSION["stId"]."'&& `cgjudge` is not null  ";
$data=$mysql->getLine($sql);
if(empty($data)){
	$mysql->runsql("DELETE FROM `KxRecruit` WHERE `stId`='".$_SESSION["stId"]."'");
	$json["error"]=0;
}
else{
	$json["error"]=1;
}
  echo json_encode($json);
?>