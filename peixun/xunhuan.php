
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<?php 
$x=1;
  
while($x<=5) {
   echo "数字是：$x <br>";
   $x++;
}

$y=6; 

do {
  echo "这个数字是：$y <br>";
  $y++;
} while ($y<=5); 

for ($a=0; $a<=10; $a++) {
   echo "数字是：$a <br>";
}

$colors = array("red","green","blue","yellow"); 

foreach ($colors as $value) {
  echo "$value <br>";
}
?>   

</body>
</html>