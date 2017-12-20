
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<?php
echo "<h2>学习 很有趣！</h2>";
echo "我爱学习!<br>";
echo "学习使我快乐！<br>";
echo "这段话", "由", "多个", "字符串", "串接而成。";

$txt1="Learn PHP";
$txt2="W3School.com.cn";
$cars=array("Volvo","BMW","SAAB");

echo $txt1;
echo "<br>";
echo "Study PHP at $txt2";
echo "My car is a {$cars[0]}";

//print会默认返回1 所以慢 且不能同时输出多个字符串
#所以输出一般使用echo
print "<h2>PHP is fun!</h2>";
print "Hello world!<br>";
print "I'm about to learn PHP!";

$txt3="Learn PHP";
$cars1=array("Volvo","BMW","SAAB");

print $txt3;
print "<br>";
print "My car is a {$cars1[0]}";

//字符串变量连接
$a = "Hello";
$b = $a . " world!";
echo $b; // 输出 Hello world!

$x="Hello";
$x .= " world!";
echo $x;
?>

</body>
</html>