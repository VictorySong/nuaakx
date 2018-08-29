<?php
header("content-type:application/json");// 尽量不要用text/json 某些浏览器会不兼容
$json='{"price":200,"midle":150,"low":100}';//注意外面的单引号
echo $json;

?>