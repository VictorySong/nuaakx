<?php
class SaeMysql{
	public $user="";
	public $secret="";
	public $database="";
	public $host="";
	public $ico="";
	public $num_rows;

	
	function __construct($database="app_nuaakexie"){
		$this->user="root";
		$this->secret="linux";
		$this->database=$database;
		$this->host="localhost";
		$this->ico=mysql_connect($this->host,$this->user,$this->secret);
		mysql_select_db($this->database,$this->ico);
	}
	public function getLine($sql){
		$result=mysql_query($sql,$this->ico);
		return mysql_fetch_assoc($result);
	}
	public function getData($sql){
		$result=mysql_query($sql,$this->ico);
		
		$this->num_rows=mysql_num_rows($result);
	
		
		$result_data=array();
		for($i=0;$i<$this->num_rows; $i++)
		{
			$result_data[$i]=mysql_fetch_assoc($result);
		}
		return $result_data;
	}
	public function runsql($sql){
		mysql_query($sql,$this->ico);
		return mysql_errno($this->ico);
	}
	public function errno(){
		return mysql_errno($this->ico);
	}
	public function errmsg(){
		return mysql_error($this->ico);
	}
	public function close(){
		if(gettype($this->ico)=="resource")
			mysql_close($this->ico);
	}
	function __destruct(){
		if(gettype($this->ico)=="resource")
			mysql_close($this->ico);
	}
}

?>