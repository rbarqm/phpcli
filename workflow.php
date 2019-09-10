<?php
	$conn = mysqli_connect('localhost','root','','ketersediaan');
	//$conn = new mysqli();
	/*if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}*/
	
	$workflowRegion = ['REG1','REG2','REG3','REG4','REG5','REG6','REG7','REG8','REG9','REG10','REG11'];
	$workflowName = ['FORCE_MAJEUR','DATABASE','FALSE_ALARM'];
	$workflowAction = ['ACT_SUBMIT','ACT_APPROVE','ACT_REJECT'];
	$workflowStatus = ['SUBMITTED_TO_IOC','SUBMITTED_TO_RANOP','APPROVED_BY_IOC','APPROVED_BY_RANOP','REJECTED_BY_IOC','REJECTED_BY_RANOP'];
	$workflowCategory = ['FORCE_MAJEUR','DATABASE','FALSE_ALARM'];
	
	foreach($workflowName as $nama){		
		foreach($workflowRegion as $region){			
			foreach($workflowAction as $aksi){				
				foreach($workflowStatus as $status){					
					foreach($workflowCategory as $kategori){						
						if($nama == $kategori){
							if($aksi == 'ACT_SUBMIT' && $status == 'SUBMITTED_TO_IOC'){
								$kata_nama = $nama."_".$region;
								$kata_aksi = $aksi;
								$kata_status = $status."_".$region;
								$kata_kategori = $kategori;
								//echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
								$data[] = "('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
							}
							if($aksi == 'ACT_SUBMIT' && $status == 'SUBMITTED_TO_RANOP'){
								$kata_nama = $nama."_".$region;
								$kata_aksi = $aksi;
								$kata_status = $status."_".$region;
								$kata_kategori = $kategori;
								//echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
								$data[] = "('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
							}
							if($aksi == 'ACT_APPROVE' && $status == 'APPROVED_BY_IOC'){
								$kata_nama = $nama."_".$region;
								$kata_aksi = $aksi;
								$kata_status = $status."_".$region;
								$kata_kategori = $kategori;
								//echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
								$data[] = "('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
							}
							if($aksi == 'ACT_APPROVE' && $status == 'APPROVED_BY_RANOP'){
								$kata_nama = $nama."_".$region;
								$kata_aksi = $aksi;
								$kata_status = $status."_".$region;
								$kata_kategori = $kategori;
								//echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
								$data[] = "('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
							}
							if($aksi == 'ACT_REJECT' && $status == 'REJECTED_BY_IOC'){
								$kata_nama = $nama."_".$region;
								$kata_aksi = $aksi;
								$kata_status = $status."_".$region;
								$kata_kategori = $kategori;
								//echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
								$data[] = "('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
							}
							if($aksi == 'ACT_REJECT' && $status == 'REJECTED_BY_RANOP'){
								$kata_nama = $nama."_".$region;
								$kata_aksi = $aksi;
								$kata_status = $status."_".$region;
								$kata_kategori = $kategori;
								//echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
								$data[] = "('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
							}
						}
					}
				}
			}
		}
	}
	$data2 = implode(",", $data);
	$masukin = "INSERT INTO t_mst_workflow_rekon (WORKFLOW_NAME,ACTION,STATUS_NE_EXCLUSION_CODE,CATEGORY) VALUES $data2";
	mysqli_query($conn, $masukin);
	
	/*$masukin = "INSERT INTO t_mst_workflow_rekon (WORKFLOW_NAME,ACTION,STATUS_NE_EXCLUSION_CODE,CATEGORY) VALUES ('$kata_nama','$kata_aksi','$kata_status','$kata_kategori')";
	if(mysqli_query($conn, $masukin)){
		echo $kata_nama."||".$kata_aksi."||".$kata_status."||".$kata_kategori;echo "\n";
	}*/
?>