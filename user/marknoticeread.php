<?php

/**
 * @author 宋胜利
 * @copyright 2017
 */
include("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["noticeid"]))
{
    $mysql=new SaeMysql();
    if(!$mysql->runsql("INSERT INTO `ReadNotice` (`noticeid`,`stId`) VALUES ('".$_POST["noticeid"]."','".$_SESSION["stId"]."')"))
    {
        $json["error"]=0;
        echo json_encode($json);
    }
}


?>