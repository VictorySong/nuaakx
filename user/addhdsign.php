<?php

/**
 * @author 宋胜利
 * @copyright 2017
 */
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["hdid"]))
{
	$mysql=new SaeMysql();
	$data=$mysql->getLine("SELECT `stId` FROM `Hdsign` WHERE `hdid`='".$_POST["hdid"]."' && `stId`='".$_SESSION["stId"]."'");
	if(empty($data))
    {
        if(!$mysql->runsql("INSERT INTO `Hdsign` (`hdid`,`stId`) VALUES ('".$_POST["hdid"]."' ,'".$_SESSION["stId"]."') "))
        {
             $json["error"]=0;
        }
    }
    else{
        $json["error"]=1;
    }
	echo json_encode($json);
}


?>