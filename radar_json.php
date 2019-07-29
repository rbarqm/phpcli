<?php
$json = file_get_contents('http://localhost/radar/request/area');
$obj = json_decode($json);

for($a = 0; $a <= 3;$a++){
	echo $obj[$a]->AREA_ID;echo "\n";
}
?>