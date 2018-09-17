<?php
include("SaeMysql.php");

//receive http json begin
header("Access-Control-Allow-Origin:*"); 
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 

$rws_post = $GLOBALS['HTTP_RAW_POST_DATA'];
$mypost = json_decode($rws_post,ture);
echo json_encode($mypost);

$mysql=new SaeMysql();
//[{"num":"2583","vue":"78"},{"num":"2583","vue":"71"},...]
for($i=0;$i<75;$i++){
/*$num = (string)$mypost[$i]['num'];
$vue = (string)$mypost[$i]['vue'];*/
$num = 2500;
$vue = 99;

//receive http json end
if(!empty($num) && !empty($vue))
{
	$mysql->runsql("INSERT INTO `text` (`num`,`vue`) VALUES ('".$num."','".$vue."') ");
}
}


/*
if(!empty($_POST["num"]) && !empty($_POST["vue"]))
{
	$mysql=new SaeMysql();
	if($mysql->runsql("INSERT INTO `text` (`num`,`vue`) VALUES ('".$_POST["num"]."','".$_POST["vue"]."') "))
				//die($mysql->errmsg());
			
	$json["error"]=0;
	echo json_encode($json);	
}
*/

?>