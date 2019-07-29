<?php
	echo "Masukan angka: ";
	$inputan = fopen("php://stdin","r");
	$angka = trim(fgets($inputan));
	
	echo "Rp. ".number_format($angka,2,",",".");
?>