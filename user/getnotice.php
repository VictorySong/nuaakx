<?php
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
		/*通知分多个表记录时
		$external=$mysql->getData("SELECT `title`,`description`,`url`,`date` FROM `KxExternalNotice` WHERE 1 order by `date` desc");
		$internal=$mysql->getData("SELECT `title`,`description`,`url`, `date` FROM `KxInternalNotice` WHERE 1 order by `date` desc");
		$personal=$mysql->getData("SELECT `title`,`description`,`url`,`date` FROM `KxPersonalNotice` WHERE `tostId`='".$_SESSION["stId"]."' order by `date` desc");
		$json["notice"]=array_merge($external,$internal,$personal);
		*/
		$json["notice"]=$mysql->getData("SELECT `noticeid`,`title`,`description`,`url`,`date` FROM `Notice` WHERE `tostId`='".$_SESSION["stId"]."'");
		
		
	}
	else
	{
		$json["error"]=0;
		/*通知分多个表记录时
		$external=$mysql->getData("SELECT `title`,`description`,`url`,`date` FROM `KxExternalNotice` WHERE 1 order by `date` desc");
		//$internal=$mysql->getData("SELECT `title`,`description`,`url` FROM `KxInternalNotice` WHERE 1 order by `date` desc");
		$personal=$mysql->getData("SELECT `title`,`description`,`url`,`date` FROM `KxPersonalNotice` WHERE `tostId`='".$_SESSION["stId"]."' order by `date` desc");
		
		$json["notice"]=array_merge($external,$personal);*/
        
		$json["notice"]=$mysql->getData("SELECT `noticeid`,`title`,`description`,`url`,`date` FROM `Notice` WHERE `tostId`='".$_SESSION["stId"]."'");
	}
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