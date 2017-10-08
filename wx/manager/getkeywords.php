<?php
//取得关键词的相关数据
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
if(!isset($_GET["p"]) || $_GET['p']<1)
	$_GET["p"]=1;
$_GET['p']=(int)$_GET['p'];
if(!empty($_SESSION["tableName"]))
{
	//下面这段先取得所有结果以计数 再取得所需结果的代码可优化 具体参看 getmembers.php
	$mysql=new SaeMysql();
	$result1=mysql_query("SELECT `keywords` FROM `CustomizeKeyWords` WHERE `stId` = '".$_SESSION['stId']."'",$mysql->ico);
	$num=mysql_num_rows($result1);
	
		$data=$mysql->getData("SELECT * FROM `CustomizeKeyWords` WHERE `stId` = '".$_SESSION['stId']."' order by `date` desc LIMIT ".(($_GET["p"]-1)*10).",10");
	
	
	for($i= 0; $i <count($data); $i++)
	{
		if(substr($data[$i]['keywords'],0,1)=="/")
			$data[$i]['keywords']=substr($data[$i]['keywords'],1);
		if(substr($data[$i]['keywords'],-1,1)=="/")
			$data[$i]['keywords']=substr($data[$i]['keywords'],0,-1);
	}
	array_push($data,$num);
	$json=json_encode($data);
	echo $json;
}
	
?>