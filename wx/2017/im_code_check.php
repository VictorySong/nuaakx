<?php
  session_start();
  $post=$GLOBALS["HTTP_RAW_POST_DATA"];
  if(isset($_SESSION['authcode']))
  {
	  if($post==$_SESSION['authcode'])
		  echo "1";
  }

?>