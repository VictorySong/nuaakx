<?php

/**
 * @author 宋胜利
 * @copyright 2017
 */
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]))
{
    $mysql=new SaeMysql();
    $department=$mysql->getLine("SELECT `Department` FROM `KxBm` WHERE `stId`='".$_SESSION["stId"]."'");
	if(!empty($department))
	{
		$json["error"]=0;
	
		$data=$mysql->getData("SELECT `noticeid` FROM `Notice` WHERE `tostId`='".$_SESSION["stId"]."'");
		
		
	}
	else
	{
		$json["error"]=1;
		
		$data=$mysql->getData("SELECT `noticeid` FROM `Notice` WHERE `tostId`='".$_SESSION["stId"]."'");
	}
    $later=0;
    foreach($data as $key=>$value){
        $data1=$mysql->getLine("SELECT `num` FROM `ReadNotice` WHERE `noticeid`='".$value["noticeid"]."' && `stId`='".$_SESSION["stId"]."'");
        if(empty($data1))
            $later++;
    }
    $json["later"]=$later;
	echo json_encode($json);

}
?>