<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_SESSION["stId"]) && !empty($_POST["description"]) && !empty($_POST["p"]))
{
	$p=(int)$_POST["p"];
	if($p<1)
		die();
	$type=(empty($_POST["type"])? "all": $_POST["type"]);
	
	$key="/".$_POST["description"]."/";
	$mysql=new SaeMysql();
	if($type=="all")
		$da=$mysql->getData("SELECT `postid` ,`title`, `description` FROM `PostRecord` WHERE 1 order by `date` desc");
	else
		$da=$mysql->getData("SELECT `postid` ,`title`, `description` FROM `PostRecord` WHERE `type`='".$type."' order by `date` desc");
	$data=array();
	$i=0;
	$j=0;
	foreach($da as $value)
	{
		if(preg_match($key,$value["title"]) || preg_match($key,$value["description"]))
		{
			if($i>($p*10-1))
				break;
			else if($i>(($p-1)*10-1))
			{
				$data[$j]=$mysql->getLine("SELECT `postid`,`stId`,`type`,`date`,`description`,`imageurl`,`url`,`title` FROM `PostRecord` WHERE `postid`='".$value["postid"]."'");
				$j++;
			}
			$i++;
		}
	}

	foreach($data as $key=>$value)
	{
		$inf=$mysql->getLine("SELECT `nickname` FROM `wx_user` WHERE `number`='".$value["stId"]."'");
		
		if(!empty($inf["nickname"]))
			$data[$key]["nickname"]=$inf["nickname"];
		$sql="SELECT `stId` FROM `PostThumbs` WHERE `postid`='".$value["postid"]."'";
		$result=mysql_query($sql,$mysql->ico);
		$data[$key]["thumbs"]=mysql_num_rows($result);//获取点赞数
		//获取请求对象是否点赞
		$alreadythumb=$mysql->getLine("SELECT `stId` FROM `PostThumbs` WHERE `postid`='".$value["postid"]."' && `stId`='".$value["stId"]."'");
		if(!empty($alreadythumb))
			$data[$key]["alreadythumb"]="true";
		else
			$data[$key]["alreadythumb"]="false";
		//获取评论 每个获取三条 并获取总评论数
		$sql="SELECT `stId` FROM `PostComment` WHERE `postid`='".$value["postid"]."'";
		$result=mysql_query($sql,$mysql->ico);
		$data[$key]["commentnum"]=mysql_num_rows($result);
		$datacomment=$mysql->getData("SELECT `stId` ,`content` , `commentid`  FROM `PostComment` WHERE `postid`='".$value["postid"]."' order by `date` desc LIMIT 0,3");
		foreach($datacomment as $key1=>$value1)
		{
			$commentinf=$mysql->getLine("SELECT `nickname` FROM `wx_user` WHERE `number`='".$value1["stId"]."'");
			$datacomment[$key1]["nickname"]=$commentinf["nickname"];
		}
		$data[$key]["comment"]=$datacomment;
		
	}
	
	if(!$mysql->errno())
	{
		echo json_encode($data);
	}
}		

?>