<?php
/*
	微信后台代码 real
    作者：陈喆
  */
require_once("SaeMysql.php");
require_once('emoji.php');
require_once('simple_html_dom.php');
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();                    //被注释的token验证			 simple_html_dom 
$wechatObj->responseMsg();

$mysql = new SaeMysql();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
    private function noresponse()
    {
        echo "";
        exit;
    }
    public function responseMsg()
    {
										//新建Memcache类
		//$mc=memcache_init();
		//$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$postStr=file_get_contents("php://input");
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				$type = $postObj->MsgType;
				$customevent = $postObj->Event;
            	$eventkey = $postObj->EventKey;
				$latitude  = $postObj->Location_X;
				$longitude = $postObj->Location_Y;
                $keyword = trim($postObj->Content);
                $time = time();
            	$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>1</FuncFlag>
					</xml>";
            
				switch ($type)
				{
                    case "event";
                        {
             				$resultStr = $this->receiveEvent($postObj);
                            
                        }
             		break;
             
             //关键词回复
                    case "text";
                        {
                       
             				$resultStr = $this->receiveText($postObj);
                        }
                    break;
             
					case "image";
             		{
                       
   						$contentStr = "让我猜猜你发的是美图还是表情包呢( ⊙o⊙ )";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                	}break;
					case "location";
             		{
                        $dist=$this->GetDistance(31.939444,118.784822,floatval($latitude),floatval($longitude));  //把字符串转化为float intval 	$object->Label
						$contentStr = "你当前位置：\n纬度：{$latitude}\n经度：{$longitude}\n距离南京航空航天大学江宁校区{$dist}千米\n◆想要找我们的话/::$";
                        if($dist>=50) $contentStr = $contentStr."还是先到南京再说吧！";
                        elseif($dist>=1) $contentStr = $contentStr."到我们的江宁校区来哟~！";
                        elseif($dist>=0) $contentStr = $contentStr."直接到我们的办公室东区大学生发展中心508！";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                    }break;
					case "link" ;
             		{
						$contentStr = "你的链接不会有病毒吧？/:?/:?";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                	}break;
             		case "voice" ;
             		{
						$contentStr = "你的声音真好听！真是“余音绕梁，不绝于耳”！\n/:,@@/:,@@";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                	}break;
					default:	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "此功能尚未开发!");
             		break;
					}
            $resultStr = emoji_docomo_to_unified($resultStr);
            echo $resultStr;
            
            

        }else {
        	echo "";
        	exit;
        }
    }
    public function rad($d)
	{
   		return $d*3.14159265/180.0;
	}
	public function GetDistance($lat1,$lng1,$lat2,$lng2)
	{
   		$radLat1 = $this->rad($lat1);
   		$radLat2 = $this->rad($lat2);
   		$ra = $radLat1 - $radLat2;
   		$rb = $this->rad($lng1) - $this->rad($lng2);
   		$rs = 2*sin(sqrt(pow(sin($ra/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($rb/2),2)));
        $EARTH_RADIUS = 6378.137;
   		$rs = $rs*$EARTH_RADIUS;
   		$rs = round($rs*100)/100;
   		return $rs;
	}
    //上传图片
    private function upload_file($url,$filename,$path,$type){
        $data = array(
            'file'=>'@'.realpath($path).";type=".$type.";filename=".$filename
        );
        $ch = curl_init();
        $url="http://nuaakx.com/ftp/receive.php";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_getinfo($ch);
        $return_data = curl_exec($ch);
        curl_close($ch);
        return $return_data;
   }
    //关键词回复
	private function receiveText($object)
    {
		
		$contentStr="";
        $mysql = new SaeMysql();
		$sql= "SELECT `keywords` FROM `CustomizeKeyWords`";
		$data = $mysql->getData($sql);
		
		if(!empty($data))
		{
			
			$dataAll=array();//为了存储关键词的搜索结果
			$i=0;//为了对搜索结果进行计数；
			$newst=false;//判断关键词消息中是否有 news 类型
			//选出数据库中最靠近的关键词
			
			foreach($data as $key=>$value)
			{
				if(preg_match($value["keywords"],$object->Content))
				{
					//取出对应数据
					$sql="SELECT * FROM `CustomizeKeyWords` WHERE `keywords` = '".$value["keywords"]."'";
					$dataAll[$i]=$mysql->getLine($sql);
					if($dataAll[$i]["msgtype"]=="news")
						$newst=true;
					$i++;
				}
			}
			
			//将$dataAll以时间进行排序
			$this->keywordsSort($dataAll,0,$i-1,"date");
			
			if($newst)
			{
				//将返回数据整理进$contentStr 数组
				$contentStr=array();
				$i=0;
				foreach($dataAll as $key=>$value)
				{
					//判断消息类型并做出处理
					if($value["msgtype"]=="text")
					{
						$contentStr[$i]=array();
						$contentStr[$i]["Title"]=$value["content"];
						$i++;
					}
					else if($value["msgtype"]=="news")
					{
						$contentStr[$i]=array();
						$contentStr[$i]["Title"]=$value["title"];
						$contentStr[$i]["Description"]=$value["description"];
						$contentStr[$i]["PicUrl"]=$value["picurl"];
						$contentStr[$i]["Url"]=$value["url"];
						$i++;
					}
				}
				
			}
			else
			{
				if(!empty($dataAll))
					$contentStr=$dataAll[0]["content"];
			}
		}
		
		if(empty($contentStr)){
			$resultStr=$this->customerservice($object);
			return $resultStr;
		}
			
		
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($object, $contentStr);
        }else{
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return $resultStr;
    }
	
	//快速排序算法
	//$arr 待排序数组；
	//$i   起始位置
	//$j   终止位置
	//$acc 排序依据字段
	private function keywordsSort(&$arr,$i,$j,$acc="")
	{
		if($i<$j)
		{
			if(!empty($acc))
			{
				$a=$i;
				$b=$j;
				$x=$arr[$i];
				while($a<$b)
				{
					while($a<$b && $x[$acc]<$arr[$b][$acc])
						$b--;//从右至左找比 参考量小的
					if($a<$b)
						$arr[$a]=$arr[$b];
					while($a<$b && $x[$acc]>$arr[$a][$acc])
						$a++;
					if($a<$b)
						$arr[$b]=$arr[$a];
				}
				$arr[$a]=$x;
				$this->keywordsSort($arr,$i,$a-1,$acc);
				$this->keywordsSort($arr,$a+1,$j,$acc);
			}
			else{
				$a=$i;
				$b=$j;
				$x=$arr[$i];
				while($a<$b)
				{
					while($a<$b && $x<$arr[$b])
						$b--;//从右至左找比 参考量小的
					if($a<$b)
						$arr[$a]=$arr[$b];
					while($a<$b && $x>$arr[$a])
						$a++;
					if($a<$b)
						$arr[$b]=$arr[$a];
				}
				$arr[$a]=$x;
				$this->keywordsSort($arr,$i,$a-1);
				$this->keywordsSort($arr,$a+1,$j);
			}
		}
	}
				
				
				
    private function http_post($postdata,$url)
	{
		$cookie_file=SAE_TMP_PATH .'login.txt'; //保存cookie信息的临时文件路径
		//$post_fields="username=admin&password=123456"; //要发送的字段内容
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_AUTOREFERER,true);
		//curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)");
		curl_setopt($ch,CURLOPT_NOPROGRESS,0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file); //将cookie保存在文件中
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
		$data=curl_exec($ch);
		curl_close($ch);
		return $data;
	}
		
		
    //自定义菜单回复
    private function receiveEvent($object)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
        $contentStr = "";
       	
        switch ($object->Event)
        {
            case "subscribe":
            {

                $fromusername=$object->FromUserName;
                $time=$object->CreateTime;
                $sql="INSET INTO  `subscriber` ( `id`,`time`   ) VALUES ( '$fromusername' , '$time') ";
                $mysql=new SaeMysql();
                $mysql->runSql($sql);
                
                $contentStr = array(
                              array("Title" =>" 【南航学生科协】风雨三十八载", 
                    //    "Description" =>"【科协•招新】We Want You ", 
                        "PicUrl" =>"https://mmbiz.qpic.cn/mmbiz/AXZnZY3B8NicL1X5CerwxMiaCySQibjLlTrQoxPVgQRZox50YVPINZrb7dgsMetwicXzehjWtbpyJ5ic45eW3yVBzyw/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1", 
                        "Url" =>"http://mp.weixin.qq.com/s/IvnztAzm-i5cTsPoXu-L3Q"),
                              array("Title" =>"全景！720°的南航，你值得拥有！", 
                        "Description" =>"", 
                        "PicUrl" =>"http://mmbiz.qpic.cn/mmbiz_jpg/AXZnZY3B8N8GoV2Nau7YgBV86hicq8maant6AdwibtZ0sUXO4Cic42CYb7tss9WUvhRiclHDiclNLUibFILLYoPrTLTQ/640?wx_fmt=jpeg&tp=webp&wxfrom=5&wx_lazy=1", 
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMxODYyMA==&mid=2650194440&idx=2&sn=cfc697d07e25ba908f65140e7f33c7db&scene=4#wechat_redirect"),
                            
                				);
                
                  
            }
            	break;
            case "unsubscribe"://<a href="http://mp.weixin.qq.com/mp/getmasssendmsg?__biz=MjM5NzMxODYyMA==#wechat_webview_type=1&wechat_redirect" >点此查看历史消息</a>
            	$fromusername=$object->FromUserName;
            	$sql = "delete  FROM `subscriber` WHERE `id`='$fromusername' ";
            	
                $time=$object->CreateTime;
                
                $mysql=new SaeMysql();
                $mysql->runSql($sql);
                break;
            case "CLICK"://不知道为什么 但是click必须要大写
            {
                switch ($object->EventKey)
				{
					case "sanchuangjie":
					{
						$contentStr = array(
                              array("Title" =>"“三创节”震撼回归！", 
                        "Description" =>"“三创节”来了！小伙伴们快来围观！", 
                        "PicUrl" =>"https://mmbiz.qpic.cn/mmbiz_jpg/AXZnZY3B8Nib8UQYqwNvZc2sibAxyzN3TIH26ib6c5iawWiaJS0wMic7Eia4qp0jbic68DvElOclQLqJqBOjdzy4EPA3Yg/0?wx_fmt=jpeg", 
                        "Url" =>"https://mp.weixin.qq.com/s?__biz=MjM5NzMxODYyMA==&mid=2650195808&idx=1&sn=4125ea62ba806ec89be1e44de2be967f&chksm=bed9bdd389ae34c5b4f95ad6971ca8ce31ea8c3c5257f9f35ee3d44d01a7e9c50672ea3886b0#rd")
						     );
					}
					break ;
					case "xiaokexie":
					{
						$contentStr = array(
                              array("Title" =>"【三创节】校大学生科协趣味活动等你来战 ", 
 //                       "Description" =>"“三创节”来了！小伙伴们快来围观！", 
                        "PicUrl" =>"http://mmbiz.qpic.cn/mmbiz_png/AXZnZY3B8NibSXgu3FjGknGtlC4rtIvuRxxpp8qJp1rib16sOSbA5ib43kleqzAyDLAVwqFLXFDPrLLbLrzllmZ9g/640?wx_fmt=png&wxfrom=5&wx_lazy=1", 
                        "Url" =>"https://mp.weixin.qq.com/s?__biz=MjM5NzMxODYyMA==&mid=2650195820&idx=2&sn=60103b563e2bd8580f419a42614db38b&chksm=bed9bddf89ae34c99bc23d203865475c566261379b9f90d6317398fa18d9629f428ba5db54b5#rd")
						   
                				);
					}
					break ;
					case "yuankexie":
					{
						$contentStr = array(
                              array("Title" =>"【三创节】院科协参展项目介绍（上） ", 
 //                       "Description" =>"“三创节”来了！小伙伴们快来围观！", 
                        "PicUrl" =>"http://mmbiz.qpic.cn/mmbiz_jpg/AXZnZY3B8NibSXgu3FjGknGtlC4rtIvuRV9WG3RgkNmyJ4LbbGASoHhDfx5GsewN6s4ggW9Q7hvTDGNa1yPaEiaA/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1", 
                        "Url" =>"https://mp.weixin.qq.com/s?__biz=MjM5NzMxODYyMA==&mid=2650195820&idx=3&sn=596347359c04ab745913961a9bbb4fe5&chksm=bed9bddf89ae34c958ee4003f27e47db6627719b647acc7741989e61d85245f8f930c06d31a2#rd"),
						array("Title" =>"【三创节】院科协参展项目介绍（下） ", 
 //                       "Description" =>"“三创节”来了！小伙伴们快来围观！", 
                        "PicUrl" =>"http://mmbiz.qpic.cn/mmbiz_jpg/AXZnZY3B8NicjmJR3g55ribmvjxgQicqkyDm4bBFh0zD43KAWw5SNXYopCxsZib2wCtyGKUAaW9os5jn0ga0jMGeIw/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1", 
                        "Url" =>"https://mp.weixin.qq.com/s?__biz=MjM5NzMxODYyMA==&mid=2650195847&idx=3&sn=10755f8075c7b445bceea44c7f8530f3&chksm=bed9bd3489ae3422749d03c78687649cf92e088ffebce3938fde0416e10afa6f0c93bb7f4389#rd")
						   
                				);
					}
					break ;
					case "waixiao":
					{
						$contentStr = array(
                              array("Title" =>"【三创节】外校参展项目介绍 ", 
 //                       "Description" =>"“三创节”来了！小伙伴们快来围观！", 
                        "PicUrl" =>"http://mmbiz.qpic.cn/mmbiz_png/AXZnZY3B8NicjmJR3g55ribmvjxgQicqkyDvdZGgrv9ntGb1GrcmrrIjOWF6l5We6ViaaWSzG3Dic7ibue0uZVCDlM1A/640?wx_fmt=png&wxfrom=5&wx_lazy=1", 
                        "Url" =>"https://mp.weixin.qq.com/s?__biz=MjM5NzMxODYyMA==&mid=2650195847&idx=2&sn=d4fce994f48ca4def1faed954bac83c8&chksm=bed9bd3489ae3422f892666aeb1bcc7a81124a77d0cf7ff6eaac5a726348acd9f6f056d9d54d#rd")
						   
                				);
					}
					break ;
					default:
					break;
				}
//				$contentStr = "滚！";
                
            }
                break;
            default: 
                break;      

        }
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($object, $contentStr);
        }else{
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return $resultStr;
    }
    
    private function transmitText($object, $content, $funcFlag = 0)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>%d</FuncFlag>
					</xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
        return $resultStr;
    }
    
    private function transmitNews($object, $arr_item, $funcFlag = 0)
    {
        if(!is_array($arr_item))
            return;
        
        $itemTpl = "<item>
        			<Title><![CDATA[%s]]></Title>
        			<Description><![CDATA[%s]]></Description>
        			<PicUrl><![CDATA[%s]]></PicUrl>
        			<Url><![CDATA[%s]]></Url>
    			</item>";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        
        $newsTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>
					$item_str</Articles>
					<FuncFlag>%s</FuncFlag>
					</xml>";
        
        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;
    }
     private function customerservice($object)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[transfer_customer_service]]></MsgType>
					</xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $resultStr;
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        
        $token = "TOKEN";
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