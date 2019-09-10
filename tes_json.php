<?php
	if(!isset($obj))
	$obj = new stdClass();
	$obj->name = "Lutfi";
	$obj->age = 23;
	$obj->jurusan = "Ilmu Komputasi";

	$object = json_encode($obj);

	echo $object;
?>
<?php
	$json_string = 'http://www.domain.com/jsondata.json';
	$jsondata = file_get_contents($json_string);
	$obj = json_decode($jsondata,true);
	echo "<pre>";
	print_r($obj);
?>