<?php
/**
  * wechat php test
  */
//define your token
define("TOKEN", "ermeng");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
 
class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
 
        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
 
    public function responseMsg()
    {
        //get post data, May be due to the different environments

        //$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];  这是古老的写法，最后有解释
        $postStr = file_get_contents("php://input");
          //extract post data
        if (!empty($postStr)){
                 
                  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = $postObj->Content;
                $time = time();
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";            
                if(!empty( $keyword ))
                {
                      $msgType = "text";
                    $contentStr = "欢迎访问神雕微信小助手!你的id是" + $toUsername;
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }else{
                    echo "Input something...";
                }
 
        }else {
            echo "";
            exit;
        }
    }
         
    private function checkSignature()
    {
        
		$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
 
?>
