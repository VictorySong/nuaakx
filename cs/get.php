<?php
include("SaeMysql.php");

    $mysql=new SaeMysql();
	//$data=$mysql->getData("SELECT `num`,`vue` FROM `text` ");
	
	$sql="SELECT `num`,`vue` FROM `text`";
	$result=mysql_query($sql,$mysql->ico);
	$num=mysql_num_rows($result);
		
	$Data=array();
	for($i=0;$i<$num; $i++)
	 {
			$Data[$i]=mysql_fetch_assoc($result);
		}
	$data=array();
	for($i=0;$i<150; $i++)
	 {
			$data[$i]=$Data[$num-150+$i];
		}

	//if($num>40000)	$mysql->runsql("DELETE FROM `text`");
	//$mysql->runsql("TRUNCATE TABLE `text`");

	if(!empty($data));

	
//	if(!empty($data))

	{
		$json["error"]=0;
		$json["data"]=$data;
		
	}		
/*	else{
    
          $json["error"]=1;
    }	*/
	echo json_encode($json);
	if($num>1000)	$mysql->runsql("DELETE FROM `text`");

?>