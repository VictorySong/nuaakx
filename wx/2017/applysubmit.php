<?php

session_start();
include_once(dirname(dirname(__FILE__))."/SaeMysql.php");
$table;
$sqlbegin;
$sqlend;

$post=$GLOBALS["HTTP_RAW_POST_DATA"];
$post=json_decode($post,true);
foreach($post as $key=>$value)
{
	$table=$key;
	$sqlbegin="INSERT INTO `".$key."` (";
	$sqlend="VALUE (";
	foreach($value as $key2=>$value2)
	{
		dealsubmit($value2);
	}
	foreach($value as $key2=>$value2)
	{
		checkassorepeat($value2);
	}
	$sqlbegin=substr($sqlbegin,0,-1);
	
	$sqlend=substr($sqlend,0,-1);
	$sqlbegin=$sqlbegin.")";
	$sqlend=$sqlend.")";
	$sql=$sqlbegin.$sqlend;
	$mysql=new SaeMysql();
	$mysql->runsql($sql);
	echo "1";
}

function checkassorepeat($obj){
	if(gettype($obj)=="array")
	{
		if(!empty($obj['assonorepeat']))
		{
			$mysql1=new SaeMysql();
			if($obj['value']!="")
			{
				$sql="SELECT * FROM `".$obj['assonorepeat']."` WHERE `".$obj['assonorepeat']."`='".$obj['value']."'";
				$data=$mysql1->getLine($sql);
				if(empty($data))
				{
					$sql="INSERT INTO `".$obj['assonorepeat']."` (`".$obj['assonorepeat']."`) VALUE ('".$obj['value']."')";
					$mysql1->runsql($sql);
				}
				else{
					die($obj['name']);
				}
			}
		}
	}
	else{
		return '0';
	}
}
function dealsubmit($obj)
{
	if(gettype($obj)=="array")
	{
		
		if(array_key_exists("name",$obj)&&array_key_exists("value",$obj)&&array_key_exists("type",$obj))
		{
			if($obj['name']=="im_code")
			{
				if(!isset($_SESSION['authcode']))
				{
					die($obj['name']);
				}
				else if($obj['value']!=$_SESSION['authcode'])
				{
					die($obj['name']);
				}
			}
			if($obj['name']=='sms_code')
			{
				if(!isset($_SESSION['sms_code']))
				{
					die($obj['name']);
				}
				else if($obj['value']!=$_SESSION['sms_code'] || (time()-$_SESSION['sms_code_time'])>600)
				{
					die($obj['name']);
				}
			}
			if($obj['name']=='phone')
			{
				if(!isset($_SESSION['phone']))
				{
					die($obj['name']);
				}
				else if($obj['value']!=$_SESSION['phone'])
				{
					die($obj['name']);
				}
			}
			if($obj['record']=="1")
			{
				if($obj['must']&&$obj['value']=="")
				{
					die($obj['name']);
				}
				switch($obj['type'])
				{
					case 'radio':
					{
						if(gettype($obj['value'])=="array")
						{
							$str="";
							foreach($obj['value'][0] as $key=>$value)
							{
								$str.=$value;
							}
							$GLOBALS['sqlbegin'].="`".$obj['name']."`,";
							$GLOBALS['sqlend'].="'".$str."',";
						}
						else
						{
							die($obj['name']);
						}
					}
					break;
					case 'text':
					{
						$GLOBALS['sqlbegin'].="`".$obj['name']."`,";
						$GLOBALS['sqlend'].="'".$obj['value']."',";
					}
					break;
					case 'texttara':
					{
						$GLOBALS['sqlbegin'].="`".$obj['name']."`,";
						$GLOBALS['sqlend'].="'".$obj['value']."',";
					}
					break;
					case 'checkbox':
					{
						if(gettype($obj['value'])=="array")
						{
							$str="";
							foreach($obj['value'][0] as $key=>$value)
							{
								$str.=$value;
							}
							$GLOBALS['sqlbegin'].="`".$obj['name']."`,";
							$GLOBALS['sqlend'].="'".$str."',";
						}
						else
						{
							die($obj['name']);
						}
					}
					break;
				}
			}
		}
	}
	else{
		return "0";
	}
}
				
						
						
						
						
						
						
						
						
?>