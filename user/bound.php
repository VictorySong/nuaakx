<?php
// 登陆提交地址
//不得不提的 ：wx_user 中的 number 其意义同 其他数据表中的 stId 均作为用户身份的唯一标识 这个值可能是学号 也可能是email 。万不可乱改表中字段名
include("../SaeMysql.php");
include_once("../simple_html_dom.php");
//session_set_cookie_params(7200*12*7,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["openid"])){
	$mysql=new SaeMysql(); 
	
		if(empty($_SESSION["stId"]) )
		{
			
			if(!isset($_POST["stId"]) || !isset($_POST["Password"]))
				die();
			$data=$mysql->getLine("SELECT `code`,`number` FROM `wx_user` WHERE `number`='".$_POST["stId"]."' || `email`= '".$_POST["stId"]."'");
			if(!empty($data))
			{
				if( $_POST["Password"] == md5($data["code"]))
				{
					$_SESSION["stId"]=$data["number"];
					bound();
					die("200");
				}
				else
				{
					/*
					if(!empty($_SESSION["curl"]) && $_SESSION["curl"]=="1")
						submit();//拿到教务处那边验证
					else
					{
						$_SESSION["curl"]="1";//标志我要去获取非MD5加密的密码 然后放到教务处那边去验证
						echo "again";
					}	*/
					if(empty($_POST["oricode"]))
					{
						die("again");
						
					}
					else
						submit();
				}
			}
			else
			{
				/*
				if(!empty($_SESSION["curl"]) && $_SESSION["curl"]=="1")
					submit();//拿到教务处那边验证
				else
				{
					$_SESSION["curl"]="1";//标志我要去获取非MD5加密的密码 然后放到教务处那边去验证
					echo "again";
				}	*/
				if(empty($_POST["oricode"]))
				{
					die("again");
				}
				else
					submit();
			}
		}
		else{
			bound();
			die("200");
		}
}
function submit()
{
	if(empty($_POST["oricode"]))
		return;
	$id_value=$_POST["stId"];
    $code_value=$_POST["oricode"];
    $id="ctl00"."$"."ContentPlaceHolder1"."$"."user_id";
    $code="ctl00"."$"."ContentPlaceHolder1"."$"."password";
    $submit="ctl00"."$"."ContentPlaceHolder1"."$"."BtnOk";
    $url="http://ded.nuaa.edu.cn/NetEa/Login.aspx";

    $htmlGet=str_get_html(http_Get($url));
    $__VIEWSTATE=$htmlGet->find('input[id=__VIEWSTATE]');
    $__VIEWSTATE_VALUE=$__VIEWSTATE[0]->attr['value'];
    $__EVENTVALIDATION=$htmlGet->find('input[id=__EVENTVALIDATION]');
    $__EVENTVALIDATION_VALUE=$__EVENTVALIDATION[0]->attr['value'];
    $htmlGet->clear();
    $Postdata=array("__VIEWSTATE"=>$__VIEWSTATE_VALUE,
                "__EVENTVALIDATION"=>$__EVENTVALIDATION_VALUE,
                $id=>$id_value,
                $code=>$code_value,
                $submit=>"登 录");

    $cookie_file="../../../tmp/".$_POST["stId"]."login.txt"; //保存cookie信息的临时文件路径
	if(file_exists($cookie_file))
		unlink($cookie_file);
    $ch=curl_init("http://ded.nuaa.edu.cn/NetEa/Login.aspx");
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_AUTOREFERER,true);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)");
    curl_setopt($ch,CURLOPT_NOPROGRESS,0);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file); //将cookie保存在文件中
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$Postdata);
    $data=curl_exec($ch);
    curl_close($ch);
	
    $ch=curl_init("http://ded.nuaa.edu.cn/NetEa/Login.aspx");
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_AUTOREFERER,true);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)");
    curl_setopt($ch,CURLOPT_NOPROGRESS,0);
   // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
    $data=curl_exec($ch);
    curl_close($ch);
	
	$data=iconv("GB2312","UTF-8//IGNORE",$data) ;//字符串编码格式转换 GB2312->UTF-8
    
    //"ctl00$ContentPlaceHolder1$password"=>"St1"
    //"ctl00$ContentPlaceHolder1$user_id"=>"151550121",
    //echo $data["ctl00$ContentPlaceHolder1$user_id"];
    //echo strip_tags(http_Post($data,$url),'span');找到span元素下内容
    
    $html=str_get_html($data);
    $username=$html->find('span[id=ctl00_lbCurrentUserName]');
    $usernameString=$username[0]->__get('plaintext');
	
    $mysql=$GLOBALS["mysql"];
	
    if(strlen($usernameString)>1)
    {
        $usernameString=substr($usernameString,0,-1);
        $sql="SELECT `name` FROM `wx_user` WHERE `number`= '".$_POST["stId"]."'";
		$data=$mysql->getLine($sql);
        
      
		if(empty($data))
		{
			
			$sql = "INSERT INTO `wx_user` (`number`, `name`,`code`,`nickname`) VALUES ('".$_POST['stId']."', '".$usernameString."', '".$_POST["oricode"]."', '".$usernameString."');";

			$mysql->runSql($sql);
			
		}
		else if($data['name']!=$usernameString)
		{
			$sql="UPDATE `wx_user` SET `name` = '".$usernameString."' WHERE `number` = '".$_POST["stId"]."'";
			$mysql->runSql($sql);
		    
		}
        
		$_SESSION['stId']=$_POST['stId'];
		
		bound();
		echo "200";
		
    }
    else
        echo '405';
    $html->clear();
}
function http_Get($url)
{
    $curl=curl_init();
    $timeout=5;
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,$timeout);
    $file_content=curl_exec($curl);
    curl_close($curl);
    return $file_content;
}
function bound(){
	$mysql=$GLOBALS["mysql"];
	$exist=$mysql->getLine("SELECT `id`,`sex`,`headimgurl` FROM `wx_user` WHERE `openid`='".$_SESSION["openid"]."'");
	$stid=empty($_POST["stId"])?$_SESSION["stId"]:$_POST["stId"];
	$exist1=$mysql->getLine("SELECT `id` FROM `wx_user` WHERE `number`='".$stid."'");
	if(!empty($exist)){
		if($exist["id"]!=$exist1["id"]){
			$mysql->runsql("DELETE FROM `wx_user` WHERE `id`='".$exist["id"]."'");
			$mysql->runsql("UPDATE `wx_user` SET `openid`='".$_SESSION["openid"]."' ,`sex`='".$exist["sex"]."', `headimgurl`='".$exist["headimgurl"]."' WHERE `number`='".$_SESSION["stId"]."'");
		}
	}
	
}
?>