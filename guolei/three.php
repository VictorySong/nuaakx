<?php
$b=array("8","3","4","9","1");
$len=count($b);
for($k=0;$k<=$len;$k++)
{
    for($j=$len-1;$j>$k;$j--){
        if($b[$j]<$b[$j-1]){
            $temp = $b[$j];
            $b[$j] = $b[$j-1];
            $b[$j-1] = $temp;
			echo $b[$j-1];
			echo "<br>";
        }
    }
}

?>