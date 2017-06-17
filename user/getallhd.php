<?php
include ("../SaeMysql.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();
if (!empty($_SESSION["stId"])) {
    $mysql = new SaeMysql();
    $data = $mysql->getData("SELECT `hdid`,`name`,`content`,`url`,`max` ,`hdsignend`FROM `HdSsh` WHERE 1 order by `date` desc");
    foreach ($data as $key => $value) {
        $result = mysql_query("SELECT `stId` FROM `Hdsign` WHERE `hdid`='" . $value["hdid"] .
            "'", $mysql->ico);
        $num = mysql_num_rows($result);
        $data[$key]["nownum"] = $num;
        $data1 = $mysql->getLine("SELECT `stId` FROM `Hdsign` WHERE `hdid`='" . $value["hdid"] .
            "' && `stId`='" . $_SESSION["stId"] . "'");
        if (!empty($data1)) {
            $data[$key]["hdalready"] = true;
        } else {
            $data[$key]["hdalready"] = false;
        }
    }
    $json["error"] = 0;
    $json["msg"] = $data;
    echo json_encode($json);
}
?>
