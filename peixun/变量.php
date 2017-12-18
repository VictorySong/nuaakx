
<!DOCTYPE html>
<html>
<body>

<?php
$x=5; // global scope 
# 变量名对大小写敏感
/*
变量以 $ 符号开头，其后是变量的名称
变量名称必须以字母或下划线开头
变量名称不能以数字开头
变量名称只能包含字母数字字符和下划线（A-z、0-9 以及 _）
变量名称对大小写敏感（$y 与 $Y 是两个不同的变量）
*/
  
function myTest() {
   $y=10; // local scope
   echo "<p>在函数内部测试变量：</p>";
   echo "变量 x 是：$x";
   echo "<br>";
   echo "变量 y 是：$y";
} 

myTest();

echo "<p>在函数之外测试变量：</p>";
echo "变量 x 是：$x";
echo "<br>";
echo "变量 y 是：$y";
?>

</body>
</html>