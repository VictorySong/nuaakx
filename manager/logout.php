<?php
//负责解决退出登录
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
foreach($_SESSION as $key=>$value)
{
	unset($_SESSION[$key]);
}
?>