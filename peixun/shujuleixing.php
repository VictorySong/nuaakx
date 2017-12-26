

<!DOCTYPE html>
<html>

<body>

<?php 
//数据类型
/*
字符串、整数、浮点数、逻辑、数组、NULL。
*/
//字符串
$x = "Hello world!";
echo $x;
echo "<br>"; 
$x = 'Hello world!';
echo $x;

//整数
/*
整数是没有小数的数字。
整数规则：
整数必须有至少一个数字（0-9）
整数不能包含逗号或空格
整数不能有小数点
整数正负均可
可以用三种格式规定整数：十进制、十六进制（前缀是 0x）或八进制（前缀是 0）
在下面的例子中，我们将测试不同的数字。PHP var_dump() 会返回变量的数据类型和值：
*/
$y = 5985;
var_dump($y);
echo "<br>"; 
$y = -345; // 负数
var_dump($y);
echo "<br>"; 
$y = 0x8C; // 十六进制数
var_dump($y);
echo "<br>";
$y = 047; // 八进制数
var_dump($y);
//浮点数
$z = 10.365;
var_dump($z);
echo "<br>"; 
$z = 2.4e3;
var_dump($z);
echo "<br>"; 
$z = 8E-5;
var_dump($z);
//逻辑
$a=true;
$b=false;
echo $a.$b;
//数组
$cars=array("Volvo","BMW","SAAB");
var_dump($cars);
//null
$t="Hello world!";
$t=null;
var_dump($t);
?>

</body>
</html>