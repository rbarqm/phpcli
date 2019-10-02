<?php
	echo "Jam Masuk: ";
	$input_awal = fopen("php://stdin","r");
	$jam_awal = trim(fgets($input_awal));
	
	echo "Jam Pulang: ";
	$input_akhir = fopen("php://stdin","r");	
	$jam_akhir = trim(fgets($input_akhir));
	
	$awal = strtotime($jam_awal);
	$akhir = strtotime($jam_akhir);
	
	$selisih = $akhir - $awal;
	
	$jam = floor(abs($selisih)/3600);
	$menit = (fmod(abs($selisih),3600))/60;
	echo "Durasi bekerja : " . $jam . " Jam " . $menit . " Menit"; echo "\n";
	
	$lembur = $jam - 9;
	if($lembur < 0){
		$lembur = 0;
	}
	echo "Durasi lembur : ".$lembur." jam";
?>