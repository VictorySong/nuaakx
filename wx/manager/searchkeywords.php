<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();

if(!empty($_SESSION["tableName"]))
{
	if(isset($_GET["keywords"]) && !empty($_GET["keywords"]) )
	{
		$mysql=new SaeMysql();
		$data=$mysql->getData("SELECT `keywords` FROM `CustomizeKeyWords`");
		$result=array();
		foreach($data as $key=>$value)
		{
			if(preg_match($value["keywords"],$_GET["keywords"]))
			{
				array_push($result,$mysql->getLine("SELECT * FROM  `CustomizeKeyWords` WHERE `keywords`='".$value["keywords"]."'"));
			}
		}
		if(!empty($result))
		{
			for($i= 0; $i <count($result); $i++)
			{
				if(substr($result[$i]['keywords'],0,1)=="/")
					$result[$i]['keywords']=substr($result[$i]['keywords'],1);
				if(substr($result[$i]['keywords'],-1,1)=="/")
					$result[$i]['keywords']=substr($result[$i]['keywords'],0,-1);
			}
			echo json_encode($result);
		}
	}
}
?>