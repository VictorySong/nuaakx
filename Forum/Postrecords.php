<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!empty($_POST["postid"]) )
{	
	$mysql=new SaeMysql();
	
	//获取评论 并获取总评论数
	$sql="SELECT `stId` FROM `PostComment` WHERE `postid`='".$_POST["postid"]."'";
	$result=mysql_query($sql,$mysql->ico);
	$data["commentnum"]=mysql_num_rows($result);
	$datacomment=$mysql->getData("SELECT `stId` ,`content` , `commentid`  FROM `PostComment` WHERE `postid`='".$_POST["postid"]."' order by `date` desc ");
	if(empty($datacomment))
		die();
	
	foreach($datacomment as $key1=>$value1)
	{
		//获取评论人昵称
		$commentinf=$mysql->getLine("SELECT `nickname` FROM `wx_user` WHERE `number`='".$value1["stId"]."'");
		$datacomment[$key1]["nickname"]=$commentinf["nickname"];
		//获取该评论的所有回复
		$commentresp=$mysql->getData("SELECT `stId` , `commentid`, `content` FROM `PostCommentResponse` WHERE `tocommentid`= '".$value1["commentid"]."' order by `date` desc");
		//获取该评论所有回复的nickname 并获取所有回复的回复
		foreach($commentresp as $key=>$value)
		{
			$commentinf=$mysql->getLine("SELECT `nickname` FROM `wx_user` WHERE `number`='".$value["stId"]."'");
			$commentresp[$key]["nickname"]=$commentinf["nickname"];
			$commentrespresp=$mysql->getData("SELECT `stId`,`commentid`,`content` FROM `PostCommentResponseResponse` WHERE `tocommentid`='".$value["commentid"]."' order by `date` desc");
			foreach($commentrespresp as $key2=>$value2)
			{
				$commentinf=$mysql->getLine("SELECT `nickname` FROM `wx_user` WHERE `number`='".$value2["stId"]."'");
				$commentrespresp[$key2]["nickname"]=$commentinf["nickname"];
			}
			$commentresp[$key]["resp"]=$commentrespresp;
		}
		$datacomment[$key1]["resp"]=$commentresp;
		
	}
	$data["comment"]=$datacomment;
		
	
	if(!$mysql->errno())
	{
		echo json_encode($data);
	}
}

?>