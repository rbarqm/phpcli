<?php
	$x=1;
	echo 'List of odd numbers between 1 to 10';echo "\n";
	while ($x<=10){
		if (($x % 2)==0){
			$x++;
			continue;
		}else{
			echo $x."\n";
			$x++;
		}
	}
?>