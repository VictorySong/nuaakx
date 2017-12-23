
<!DOCTYPE html>
<html>
<body>



<?php
$sz=array(3,2,4,5,1);
$i=0;
$j=0;
$m=0;
for(;$j<4;$j++)
 {
    for($i=0;$i<4-$j;$i++)
        {
            if($sz[$i]>$sz[$i+1])
             {
                 $m=$sz[$i];
                 $sz[$i]= $sz[$i+1];
                 $sz[$i+1]=$m;
                 

             }
        }
 }
for($i=0;$i<5;$i++)
 {
     echo $sz[$i];
     echo "<br>";
 }
?>  

</body>
</html>