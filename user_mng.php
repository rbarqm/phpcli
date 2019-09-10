<?php
	$servername = '10.54.36.51';
	$username = 'appradar';
	$password = 'radarapp#123';
	$database = 'availability';	
	//$conn = new mysqli($servername,$username,$password,$database);
	$conn = new mysqli('localhost','root','','ketersediaan');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'This is my secret key';
	$secret_iv = 'This is my secret iv';
	
	$key = hash('sha256', $secret_key);// hash

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	// iv == initialization vector
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	
	echo "super admin : ";
	$input_admin = fopen("php://stdin","r");
	$userAdmin = trim(fgets($input_admin));//user_radar
	$admins = md5($userAdmin);
	$admins = substr($admins,5,7);
	
	echo "password : ";
	echo "\033[30;40m";
	$input_pass = fopen("php://stdin","r");//userapp#123
	$passAdmin = trim(fgets($input_pass));
	$output = openssl_encrypt($passAdmin, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($output);
	$output = md5($output);
	$output = substr($output,3,5);
	echo "\033[0m";
	
	if($admins == "2dc0a62" && $output == "62301" ){
		actionMain();
	}
	
	function pilihan($choice){
		global $encrypt_method,$key,$iv;
		switch($choice){
			case '1':
				echo "\n";
				echo "--------- Create New User ---------";echo "\n";
				echo "Nama Depan : ";
				$input_namaDepan = fopen("php://stdin","r");
				$namaDepan = trim(fgets($input_namaDepan));
				
				echo "Nama Belakang : ";
				$input_namaBelakang = fopen("php://stdin","r");
				$namaBelakang = trim(fgets($input_namaBelakang));
				
				echo "Email : ";
				$input_email = fopen("php://stdin","r");
				$email = trim(fgets($input_email));
				
				echo "Phone Number : ";
				$input_phone = fopen("php://stdin","r");
				$phoneNumber = trim(fgets($input_phone));
				
				echo "Group ID : ";
				$input_group = fopen("php://stdin","r");
				$groupId = trim(fgets($input_group));
				
				echo "username : ";
				$input_username = fopen("php://stdin","r");
				$username = trim(fgets($input_username));
				
				echo "password : ";
				echo "\033[30;40m";
				$input_password = fopen("php://stdin","r");
				$password = trim(fgets($input_password));
				echo "\033[0m";
				
				echo "repeat password : ";
				echo "\033[30;40m";
				$input_repPassword = fopen("php://stdin","r");
				$repeatPassword = trim(fgets($input_repPassword));
				echo "\033[0m";			
				
				CreateUser($namaDepan,$namaBelakang,$username,$password,$email,$phoneNumber,$groupId,$repeatPassword);
			break;
			
			case '2':
				echo "\n";
				echo "--------- Change Password ---------";echo "\n";
				echo "username : ";
				$input_username = fopen("php://stdin","r");
				$username = trim(fgets($input_username));
				
				echo "old password : ";
				echo "\033[30;40m";
				$input_oldPassword = fopen("php://stdin","r");
				$old_password = trim(fgets($input_oldPassword));
				echo "\033[0m";
				
				echo "New password : ";
				echo "\033[30;40m";
				$input_newPassword = fopen("php://stdin","r");
				$new_password = trim(fgets($input_newPassword));
				echo "\033[0m";
				
				echo "repeat new password : ";
				echo "\033[30;40m";
				$input_repeatNewPassword = fopen("php://stdin","r");
				$repeat_password = trim(fgets($input_repeatNewPassword));
				echo "\033[0m";
				
				ChangePassword($username,$old_password,$new_password,$repeat_password);
			break;
			
			case '3':
				echo "password : ";
				//system('stty -echo');
				echo "\033[30;40m";
				$input_superAdmin = fopen("php://stdin","r");				
				$superAdmin = trim(fgets($input_superAdmin));//perlakuanKhusus
				$output = openssl_encrypt($superAdmin, $encrypt_method, $key, 0, $iv);
				$output = base64_encode($output);
				$output = md5($output);
				$output = substr($output,5,3);
				echo "\033[0m";
				if($output == 'f13'){
					echo "\n";
					echo "--------- Forgot Password ---------";echo "\n";			
					echo "username : ";
					$input_username = fopen("php://stdin","r");
					$username = trim(fgets($input_username));
					
					ForgotPassword($username);
				}
			break;
			
			case '4':
				echo "--------- Edit Profile User ---------";echo "\n";
				echo "Username : ";
				$input_username = fopen("php://stdin","r");
				$username = trim(fgets($input_username));
				
				/*echo "Password : ";
				echo "\033[30;40m";
				$input_password = fopen("php://stdin","r");
				$password = trim(fgets($input_password));
				echo "\033[0m";*/
				
				EditProfile($username);//,$password
			break;
			
			case '5':
				echo "--------- List User ---------";echo "\n";
				ListUsers();				
			break;
			
			case '6':
				echo "Authentication key : ";
				echo "\033[30;40m";
				$auths = trim(fgets(STDIN));//howtoDeleteUser
				$output = openssl_encrypt($auths, $encrypt_method, $key, 0, $iv);
				$output = base64_encode($output);
				$output = md5($output);
				$auths = substr($output,7,3);
				echo "\033[0m";
				if($auths == '7d3'){
					echo "--------- Delete User ---------";echo "\n";
					echo "Username : ";
					$input_username = fopen("php://stdin","r");
					$username = trim(fgets($input_username));
					DeleteUsers($username);
				}				
			break;
			
			case '7':
				echo "Bye bye. See you next time.";echo "\n";
				die();
			break;
			
			default:
				echo "Pilihan salah";				
			break;
		}		
		return actionMain();
	}
	
	function actionMain()
	{
		echo "\n";
		echo "------------------- USER MANAGEMENT -------------------";echo "\n";
		echo "1. Create New User";echo "\n";
		echo "2. Change Password";echo "\n";
		echo "3. Forgot Password";echo "\n";
		echo "4. Edit Profile User";echo "\n";
		echo "5. List User";echo "\n";
		echo "6. Delete User";echo "\n";		
		echo "7. Exit";echo "\n";		
		echo "To do : ";
		$input_awal = fopen("php://stdin","r");
		$choice = trim(fgets($input_awal));
		
		pilihan($choice);
	}
	
	function CreateUser($namaDepan,$namaBelakang,$username,$password,$email,$phoneNumber,$groupId,$repeatPassword)
	{
		global $conn,$encrypt_method,$key,$iv;
		if($password == $repeatPassword){
			$password = openssl_encrypt($password, $encrypt_method, $key, 0, $iv);
			$password = base64_encode($password);
			
			$sql = "INSERT INTO user_table (first_name,last_name,username,password,email,phone,group_id) VALUES ('$namaDepan','$namaBelakang','$username','$password','$email','$phoneNumber','$groupId')";
			$conn->query($sql);
		}else{
			echo "password tidak sama";echo "\n";
		}
		
	}
	
	function ChangePassword($username,$old_password,$new_password,$repeat_password)
	{
		global $conn,$encrypt_method,$key,$iv;
		$old_password = openssl_encrypt($old_password, $encrypt_method, $key, 0, $iv);
		$old_password = base64_encode($old_password);	
		
		$sql = "SELECT username, password FROM user_table WHERE username = '$username' AND password = '$old_password'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			if($new_password == $repeat_password){
				$new_password = openssl_encrypt($new_password, $encrypt_method, $key, 0, $iv);
				$new_password = base64_encode($new_password);
				$sql = "UPDATE user_table SET password = '$new_password' WHERE username = '$username'";
				$conn->query($sql);
			}else{
				echo "password tidak sama";
			}
		}else{
			echo "username/password tidak valid";
		}
	}
	
	function ForgotPassword($username)
	{
		global $conn,$encrypt_method,$key,$iv;
		
		$sql = "SELECT password FROM user_table WHERE username = '$username'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$password = $row["password"];
			}
			$output = openssl_decrypt(base64_decode($password), $encrypt_method, $key, 0, $iv);
			echo "Password user ".$username." adalah ".$output;
			echo "\n";
		}else{
			echo "Username tidak terdaftar";echo "\n";
		}	
	}
	
	function EditProfile($username)
	{
		global $conn;
		$sql = "SELECT * FROM user_table WHERE username = '$username'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "|| Username || First Name || Last Name || Phone || Email || Group ||";echo "\n";
			echo "--------------------------------------------------------------------";echo "\n";
			while($row = $result->fetch_assoc()){
				$userId = $row["id"];
				$userName1 = $row["username"];
				$firstName1 = $row["first_name"];
				$lastName1 = $row["last_name"];
				$phoneNumb1 = $row["phone"];
				$emailAddr1 = $row["email"];
				$groupId1 = $row["group_id"];
				echo "|| $userName1 || $firstName1 || $lastName1 || $phoneNumb1 || $emailAddr1 || $groupId1 ||";echo "\n";
			}
			echo "\n";
			echo "Input want to change, skip when ignore";echo "\n";
			echo "Username : ";
			$userName = trim(fgets(STDIN));			
			
			echo "Nama Depan : ";
			$firstName = trim(fgets(STDIN));			
			
			echo "Nama Belakang : ";
			$lastName = trim(fgets(STDIN));			
			
			echo "No. HP : ";
			$phoneNumb = trim(fgets(STDIN));			
			
			echo "Email : ";
			$emailAddr = trim(fgets(STDIN));	
			
			echo "Group : ";
			$groupId = trim(fgets(STDIN));
			
			if(empty($groupId)){$groupId = $groupId1;}
			if(empty($userName)){$userName = $userName1;}
			if(empty($firstName)){$firstName = $firstName1;}
			if(empty($lastName)){$lastName = $lastName1;}
			if(empty($phoneNumb)){$phoneNumb = $phoneNumb1;}
			if(empty($emailAddr)){$emailAddr = $emailAddr1;}
			
			$pembaruan = "UPDATE user_table SET username = '$userName', first_name = '$firstName', last_name = '$lastName', phone = '$phoneNumb', email = '$emailAddr', group_id = '$groupId' WHERE id = '$userId'";
			$hasil = $conn->query($pembaruan);
			echo "\n";
			echo "Success update profile";echo "\n";
		}else{
			echo "Username tidak valid";echo "\n";
		}
	}
	
	function ListUsers(){
		global $conn;
		
		$kueri = "SELECT username, first_name, last_name, phone FROM user_table";
		$hasil = $conn->query($kueri);
		if($hasil->num_rows > 0){
			$i = 1;
			echo "--------------------------------------------------------------------------------------------------";echo "\n";
			echo "|| No ||		Username	||		First Name	||		Last Name	||";echo "\n";
			echo "--------------------------------------------------------------------------------------------------";echo "\n";
			while($row = $hasil->fetch_assoc()){
				$userName = $row["username"];
				$firstName = $row["first_name"];
				$lastName = $row["last_name"];
				$i=$i+1;
				echo "|| $i ||$userName		||		$firstName		||		$lastName		||";echo "\n";
			}
			echo "--------------------------------------------------------------------------------------------------";echo "\n";
		}
	}
	
	function DeleteUsers($username)
	{
		global $conn;
		
		$kueri = "SELECT * FROM user_table WHERE username = '$username'";
		$hasil = $conn->query($kueri);		
		if($hasil->num_rows > 0){
			echo "are you sure want to delete user $username?";
			echo "(Y/N)";echo "\n";
			$asal = trim(fgets(STDIN));			
			if($asal == 'Y' || $asal == 'y'){
				$perintah = "DELETE FROM user_table WHERE username = '$username'";
				if($conn->query($perintah)){
					echo "Berhasil Hapus User $username";echo "\n";
				}
			}
		}else{
			echo "User tidak terdaftar";echo "\n";
		}		
	}
?>