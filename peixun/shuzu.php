
<!DOCTYPE html>
<html>
<body>

<?php
//索引数组
$cars=array("Volvo","BMW","SAAB"); 
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
echo count($cars);
$arrlength=count($cars);
for($x=0;$x<$arrlength;$x++) {
  echo $cars[$x];
  echo "<br>";
}

//关联数组
$age=array("Bill"=>"35","Steve"=>"37","Peter"=>"43");
echo "Peter is " . $age['Peter'] . " years old.";
foreach($age as $x=>$x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}
//排序
/* 
sort() - 以升序对数组排序
rsort() - 以降序对数组排序
asort() - 根据值，以升序对关联数组进行排序
ksort() - 根据键，以升序对关联数组进行排序
arsort() - 根据值，以降序对关联数组进行排序
krsort() - 根据键，以降序对关联数组进行排序
*/
?>

</body>
</html>