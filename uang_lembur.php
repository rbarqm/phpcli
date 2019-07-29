<?php
	echo "Total jam lembur selama sebulan : ";
	$input_jam = fopen("php://stdin","r");
	$waktu = trim(fgets($input_jam));
	
	echo "Hari kerja / Hari libur? : ";
	$input_hari = fopen("php://stdin","r");
	$hari = trim(fgets($input_hari));
	
	//echo "Berapa hari anda lembur? : ";
	//$input_lembur = fopen("php://stdin","r");
	//$lembur = trim(fgets($input_hari));
	
	echo "Gaji anda dalam sebulan? : ";
	$input_gaji = fopen("php://stdin","r");
	$gaji = trim(fgets($input_gaji));
	
	switch($hari){
		case 'kerja':
			$upah = $waktu*(2*((1/173)*$gaji));
		break;
		
		case 'libur':
			$upah = $waktu*(3*((1/173)*$gaji));
		break;
		
		default:
			$upah = $waktu*(1.5*((1/173)*$gaji));
		break;
	}
	
	echo "Upah lembur anda adalah : Rp ".number_format($upah,0,",",".");
?>