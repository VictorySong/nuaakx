<?php
include("SaeMysql.php");

//receive http json begin
header("Access-Control-Allow-Origin:*"); 
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 

$rws_post = $GLOBALS['HTTP_RAW_POST_DATA'];
$mypost = json_decode($rws_post);
echo json_encode($mypost);

//{"0":{"num":"2583","vue":"78"},"1":{"num":"2583","vue":"71"}

$num = (string)$mypost->b->num;
$vue = (string)$mypost->b->vue;

/*//{"num":"2583","vue":"78"}
$num = (string)$mypost->num;
$vue = (string)$mypost->vue;*/

//receive http json end
if(!empty($num) && !empty($vue))
{
	$mysql=new SaeMysql();
	$mysql->runsql("INSERT INTO `text` (`num`,`vue`) VALUES ('".$num."','".$vue."') ");
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


/*
if(!empty($_POST["data"]))
{	
	$mysql=new SaeMysql();
	for(int i=0; i<25; i++){
	if($mysql->runsql("INSERT INTO `text` (`num`,`vue`) VALUES ('".$_POST["data"][i]["num"]."','".$_POST["data"][i]["vue"]."') "))
				//die($mysql->errmsg());
			
	$json["error"]=0;
	echo json_encode($json);	
	}
}
*/		

?>