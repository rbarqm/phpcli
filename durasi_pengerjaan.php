<?php
	echo "Format 24H 'H:m:s'";echo "\n";

	echo "Jam Mulai: ";
	$input_awal = fopen("php://stdin","r");
	$jam_awal = trim(fgets($input_awal));
	
	echo "Jam Selesai: ";
	$input_akhir = fopen("php://stdin","r");	
	$jam_akhir = trim(fgets($input_akhir));
	
	$mulai = explode(":",$jam_awal);
	$awal = mktime($mulai[0],$mulai[1],$mulai[2]);
	
	$selesai = explode(":",$jam_akhir);
	$akhir = mktime($selesai[0],$selesai[1],$selesai[2]);
	// $awal = strtotime($jam_awal);
	// $akhir = strtotime($jam_akhir);
	
	$selisih = $akhir - $awal;
	
	$jam = abs($selisih)/3600;
	$menit = fmod(abs($selisih),3600)/60;
	$detik = (fmod(abs($selisih),60)*60)/60;
	echo "Durasi Proses : " . floor($jam) . " Jam " . floor($menit) . " Menit " . $detik . " Detik"; echo "\n";
?>