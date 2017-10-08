<?
//快速排序算法
//$arr 待排序数组；
//$i   起始位置
//$j   终止位置
//$acc 排序依据字段
function keywordsSort(&$arr,$i,$j,$acc="")
{
	if($i<$j)
	{
		if(!empty($acc))
		{
			$a=$i;
			$b=$j;
			$x=$arr[$i];
			while($a<$b)
			{
				while($a<$b && !($x[$acc]<$arr[$b][$acc]))
					$b--;//从右至左找比 参考量大的
				if($a<$b)
					$arr[$a]=$arr[$b];
				while($a<$b && !($x[$acc]>$arr[$a][$acc]))
					$a++;
				if($a<$b)
					$arr[$b]=$arr[$a];
			}
			$arr[$a]=$x;
			$this->keywordsSort($arr,$i,$a-1,$acc);
			$this->keywordsSort($arr,$a+1,$j,$acc);
		}
		else{
			$a=$i;
			$b=$j;
			$x=$arr[$i];
			while($a<$b)
			{
				while($a<$b && !($x<$arr[$b]))
					$b--;//从右至左找比 参考量小的
				if($a<$b)
					$arr[$a]=$arr[$b];
				while($a<$b && !($x>$arr[$a]))
					$a++;
				if($a<$b)
					$arr[$b]=$arr[$a];
			}
			$arr[$a]=$x;
			$this->keywordsSort($arr,$i,$a-1);
			$this->keywordsSort($arr,$a+1,$j);
		}
	}
}
?>