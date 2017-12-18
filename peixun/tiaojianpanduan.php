
<!DOCTYPE html>
<html>
<body>

<?php
$t=date("H");



if ($t<"10") {
  echo "Have a good morning!";
} elseif ($t<"20") {
  echo "Have a good day!";
} else {
  echo "Have a good night!";
}

$favcolor="pink";

switch ($favcolor) {
   case "pink":
     echo "Your favorite color is pink!";
     break;
   case "blue":
     echo "Your favorite color is blue!";
     break;
   case "green":
     echo "Your favorite color is green!";
     break;
   default:
     echo "Your favorite color is neither pink, blue, or green!";
}

?>  
</body>
</html>