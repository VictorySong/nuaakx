<?php
/**
  * wechat php test
  */
//define your token
include("SaeMysql.php");
include('emoji.php');
include('simple_html_dom.php');
define("TOKEN", "ermeng");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
 
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
                       
   						$mysql=new SaeMysql();
						$sql="SELECT * FROM `2017picture` WHERE `openid` LIKE '".$fromUsername."'";
						$data=$mysql->getLine($sql);
						if(empty($data))
						{
							$t=true;
							while($t)
							{
								$str="";
								for($i=0;$i<3;$i++)
								{
									$str.=rand(0,9);
								}
								$sql="SELECT * FROM `2017picture` WHERE `num` LIKE '".$str."'";
								$data=$mysql->getLine($sql);
								if(empty($data))
								{
									$t=false;
									$sql="INSERT INTO `2017picture` (`openid`,`num`) VALUES ('".$fromUsername."','".$str."')";
									$mysql->runsql($sql);
								}
							}
						}
						else{
						}
						
                        $contentStr="请等待工作人员审核";
						$this->http_post(array('url'=>$postObj->PicUrl,'confirm'=>'http://1.nuaakexie.sinaapp.com/1111111confirm.php?openid='.$fromUsername),"http://nuaakx.com/ftp/send.php");
						$contentStr=array(
								array("Title"=>"科沃斯抽奖",
									  "Description"=>"欢迎报名科沃斯",
									  "PicUrl"=>"https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=551374359,3026972293&fm=117&gp=0.jpg",
									  "Url"=>"http://1.nuaakexie.sinaapp.com/1111111lottery.php?openid=".$fromUsername)
								);
						
						$resultStr = $this->transmitNews($postObj, $contentStr);
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
		
		if(empty($contentStr))
			die("");
		
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
        $stor = new SaeStorage();				//storage服务
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
                              array("Title" =>"       <欢迎订阅NUAA科协>", 
                        "Description" =>"给你20万，让你来搞事", 
                        "PicUrl" =>"http://mmbiz.qpic.cn/mmbiz_jpg/AXZnZY3B8N9kqU3zNpdCJjgQhAY7qibDKjhSvlQvicBZGGJ8N7mEAUfZYRn3KpDe2jQTneMQypwPFic72fjU0licsA/640?wx_fmt=jpeg&tp=webp&wxfrom=5&wx_lazy=1", 
                        "Url" =>"http://mp.weixin.qq.com/s/8Ju2hk0KStMSiQnyDqgiUQ"),
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
            case "CLICK":
            {
                include("click.php");
                $contentStr = click($object->EventKey,$object);
                
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
