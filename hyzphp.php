<?php  
    $signature=$_GET['signature'];
    $timestamp=$_GET['timestatmp'];
	$nonce=$_GET['nonce'];
	$echostr=$_GET['echostr'];
	define('TOKEN','1021');
	$tmpArr=array(TOKEN,$timestamp,$nonce);
	sort($tmpArr,SORT_STRING);
	$tmpStr=join($tmpArr)
    $tmpStr=sha1($tmpStr)  
      
?>  