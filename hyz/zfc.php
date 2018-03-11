
<!DOCTYPE html>
<html>
<body>



<?php
$sz=array("V","BMW","SAAB","as","we"); 
$i=0;
$length=count($sz);
while($i<$length)
 {
     echo $sz[$i];
     echo "<br>";
     $i++;
 }
 $a="";
 for($i=0;$i<5;$i++)
  {
      $a=$a.$sz[$i];
  }
 
  echo $a;
?>  

</body>
</html>