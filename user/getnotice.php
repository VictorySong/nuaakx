<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
	$mysql=new SaeMysql();
	$json["notice"]=$mysql->getData("SELECT `noticeid`,`title`,`description`,`url`,`date` FROM `Notice` WHERE `tostId`='".$_SESSION["stId"]."'");
    foreach($json["notice"] as $key=>$value){
        $data1=$mysql->getLine("SELECT `num` FROM `ReadNotice` WHERE `noticeid`='".$value["noticeid"]."' && `stId`='".$_SESSION["stId"]."'");
        if(empty($data1))
            $json["notice"][$key]["already"]=0;
        else
            $json["notice"][$key]["already"]=1;
    }
	echo json_encode($json);
}
		

?>