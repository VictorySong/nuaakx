<?php  
    /** 
      * wechat php test 
      */  
      
    //define your token  
    define("TOKEN", "skywalker");  
    $wechatObj = new wechatCallbackapiTest();  
    $wechatObj->valid();  
    //$wechatObj->responseMsg();  
      
    class wechatCallbackapiTest  
    {   
    //事物处理函数  
        public function responseMsg()  
        {  
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];  
            if (!empty($postStr)){  
                   libxml_disable_entity_loader(true);  
                    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);  
                    $fromUsername = $postObj->FromUserName;  
                    $toUsername = $postObj->ToUserName;  
                    $keyword = trim($postObj->Content);  
                    $time = time();  
                    $textTpl = "<xml>  
                                <ToUserName><![CDATA[%s]]></ToUserName>  
                                <FromUserName><![CDATA[%s]]></FromUserName>  
                                <CreateTime>%s</CreateTime>  
                                <MsgType><![CDATA[%s]]></MsgType>  
                                <Content><![CDATA[%s]]></Content>  
                                <FuncFlag>0</FuncFlag>  
                                </xml>";               
    switch($keyword){  
    case "马云":  
    $msgType = "text";  
    $contentStr="您好，马云！我知道您创建了阿里巴巴！";  
    break;  
    case "马化腾":  
    $msgType = "text";  
    $contentStr="您好，马化腾！我知道创建了企鹅帝国！";  
    break;  
    case "史玉柱":  
    $msgType = "text";  
    $contentStr="您好，史玉柱！我知道您创建了巨人网络！";  
    break;  
    default :  
    $msgType = "text";  
    $contentStr="你是谁啊？！一边凉快去！";  
    break;  
    }  
    if(!empty($contentStr)){  
    //输出到微信终端  
    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);  
    echo $resultStr;  
    }                 
                      
                      
      
            }else {  
                echo "";  
                exit;  
            }  
        }  
      
    //接口验证函数  
    public function valid()  
        {  
            $echoStr = $_GET["echostr"];  
      
            //valid signature , option  
            if($this->checkSignature()){  
                echo $echoStr;  
                //exit;  
            }  
        }  
    private function checkSignature()  
        {  
            // you must define TOKEN by yourself  
            if (!defined("TOKEN")) {  
                throw new Exception('TOKEN is not defined!');  
            }  
              
            $signature = $_GET["signature"];  
            $timestamp = $_GET["timestamp"];  
            $nonce = $_GET["nonce"];  
                      
            $token = TOKEN;  
            $tmpArr = array($token, $timestamp, $nonce);  
            // use SORT_STRING rule  
            sort($tmpArr, SORT_STRING);  
            $tmpStr = implode( $tmpArr );  
            $tmpStr = sha1( $tmpStr );  
              
            if( $tmpStr == $signature ){  
                return true;  
            }else{  
                return false;  
            }  
        } 
{
    "button": [
        {
            "name": "扫码", 
            "sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "rselfmenu_0_1", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发图", 
            "sub_button": [
                {
                    "type": "pic_sysphoto", 
                    "name": "系统拍照发图", 
                    "key": "rselfmenu_1_0", 
                   "sub_button": [ ]
                 }, 
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照或者相册发图", 
                    "key": "rselfmenu_1_1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "rselfmenu_1_2", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发送位置", 
            "type": "location_select", 
            "key": "rselfmenu_2_0"
        },
        {
           "type": "media_id", 
           "name": "图片", 
           "media_id": "MEDIA_ID1"
        }, 
        {
           "type": "view_limited", 
           "name": "图文消息", 
           "media_id": "MEDIA_ID2"
        }
    ]
}		
    }  
	

      
    ?>  