<?php
include("../SaeMysql.php");
//session_set_cookie_params(7200,'/','nuaakx.com');
session_start();
define("N",20);
if(!empty($_SESSION["tableName"]) && !empty($_POST["p"]) && !empty($_POST["tableName"]) && !empty($_POST["item"]))
{
	$mysql=new SaeMysql();
	//判断查询人是不是要查询的部门的
	$t=false;
	foreach($_SESSION["tableName"] as $value)
	{
		if($value==$_POST["tableName"])
			$t=true;
	}
	
	//报名这个部门的总人数 
	//$data=$mysql->getData("SELECT `stId`,`description` FROM `KxRecruit` AS A WHERE num = (SELECT MAX(num) FROM `KxRecruit` WHERE `stId`=A.stId order by `stId`) && `department`='".$_POST["tableName"]."' ");
   switch ($_POST["item"]) {
    case 1:
       	$sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_POST["tableName"]."'&& `first`='0'&&`second`='0'  group by `stId` order by `stId` ";
        break;
    case 2:
        $sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_POST["tableName"]."'&& `first`='1'&&`second`='0'  group by `stId` order by `stId` ";
        break;
    case 3:
        $sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_POST["tableName"]."'&& `first`='1'&&`second`='1'  group by `stId` order by `stId` ";
        break;
	case 4:
	$sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_POST["tableName"]."'&& `fromdpstId` is not null   group by `stId` order by `stId` ";
        break;
	case 5:
	$sql="SELECT `stId`,`description` FROM `KxRecruit` WHERE `department`='".$_POST["tableName"]."'&& `first`='0'&&`second`='1'   group by `stId` order by `stId` ";
        break;	
  }
	$result1=mysql_query($sql,$mysql->ico);
	$num=mysql_num_rows($result1);
	
	$j=(($_POST["p"]*N)>$num) ? $num : $_POST["p"]*N;
	$result=array();//用来存放结果
	$k=0;//用来计数
	if($t)
	{
		for($i=0;$i<$j; $i++)
		{
			if($i<(($_POST["p"]-1)*N))
				mysql_fetch_assoc($result1);
			else
			{
				$result[$k]=mysql_fetch_assoc($result1);
				$data=$mysql->getLine("SELECT `name`,`phone`,`email` FROM `wx_user` WHERE `number`='".$result[$k]["stId"]."'");
				$result[$k]["name"]=$data["name"];
				$result[$k]["phone"]=$data["phone"];
				$result[$k]["email"]=$data["email"];
				$result[$k]["department"]=$mysql->getData("SELECT `department`,`first`,`second`,`firstevaluate`,`secondevaluate`,`fromdp` FROM `KxRecruit` WHERE `stId`='".$result[$k]["stId"]."'");
				
				$k++;
			}
		}
	}
	$json["error"]=0;
	$json["msg"]=$result;
	$json["num"]=$num;
	echo json_encode($json);
}
?>