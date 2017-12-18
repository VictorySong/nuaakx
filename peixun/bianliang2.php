
<!DOCTYPE html>
<html>
<body>

<?php
$x=5;
$y=10;

function myTest() {
   global $x,$y;
   $y=$x+$y;
   //$GLOBALS['y']=$GLOBALS['x']+$GLOBALS['y'];
} 

myTest(); // 运行函数
echo $y; // 输出变量 $y 的新值


function myTest2() {
   static $x1=0;
   echo $x1;
   $x1++;
}

myTest2();
echo "<br>";
myTest2();
echo "<br>";
myTest2();
echo "<br>";
myTest2();
echo "<br>";
myTest2();
echo "<br>";

//常量
define("GREETING", "Welcome to W3School.com.cn!", true);
echo greeting;

?>


</body>
</html>