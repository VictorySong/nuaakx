<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
echo "haha";
die("en");
include("SaeMysql.php");
$mysql=new SaeMysql();
$sql="SELECT * FROM `helloworld` ";
var_dump($mysql->getData($sql));


 
?>
