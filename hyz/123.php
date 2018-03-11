<html>
<meta charset="utf-8">
<body>

<form method="post" action="<?php echo $_SERVER["php_SELF"]; ?>">
  id<input type="text" name="abc">
  <input type="submit">
 </form>
 
 <?php 
  
    $a=$_POST["abc"];
    echo $a;
 ?>
 
</body>
</html>