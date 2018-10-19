<?php
include("SaeMysql.php");

//receive aes begin
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;
$key = "abcdefgh01234567";
$aes = new Aes($key, 'ECB');

$rws_post = $GLOBALS['HTTP_RAW_POST_DATA'];
$aes_post = $aes->decrypt(base64_decode($rws_post));
$mypost = json_decode($aes_post,ture);
//receive aes end


/*
$rws_post = $GLOBALS['HTTP_RAW_POST_DATA'];
$mypost = json_decode($rws_post,ture);
*/
$mysql=new SaeMysql();
//10min_data ,then delete
$sql="SELECT `num`,`vue` FROM `text`";
$result=mysql_query($sql,$mysql->ico);
$rows=mysql_num_rows($result);
if($rows>300)
{
	$mysql->runsql("DELETE FROM `text`");
}
//[{"num":"2583","vue":"78"},{"num":"2583","vue":"71"},...]
for($i=0;$i<150;$i++){
	$num = (string)$mypost[$i]['num'];
	$vue = (string)$mypost[$i]['vue'];

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