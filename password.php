<?php
	echo "Masukan kata :";
	$kata = fopen("php://stdin","r");	
	$string = trim(fgets($kata));
	
	echo "action (enkrip/dekrip):";
	$lakukan = fopen("php://stdin","r");	
	$action = trim(fgets($lakukan));
	
	$encrypt_method = "AES-256-CBC";
	//$secret_key = 'This is my secret key';
	//$secret_iv = 'This is my secret iv';
	$secret_key = 'Bismillah';
	$secret_iv = 'Astagfirullah';

	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	// iv == initialization vector
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	
	switch($action)
	{
		case 'enkrip':
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);//$output3 = md5($output2);
			echo "Hasil enkripsi : ".$output;
		break;
		
		case 'dekrip':
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);			
			echo "Hasil dekripsi : ".$output;
		break;
		
		default:
			echo "Wrong Action";
		break;		
	}
?>