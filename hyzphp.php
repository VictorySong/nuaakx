<?php  
    //define your token
define("TOKEN", "1021"); 
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid(); 
$wechatObj->responseMsg();
      
?>  