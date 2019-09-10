<?php
	$conn = mysqli_connect('10.53.193.98','appstiara','tiaraapps123','tiara_master');
	$sql1 = "SELECT COUNT(*) as ujung FROM t_mst_workflow_detail_request";
	$ujung1 = mysqli_query($conn,$sql1);
	while($row = mysqli_fetch_array($ujung1)){
		$maks = $row['ujung'];
	}
	//die($maks);
	for($i =1;$i <= $maks;$i++){
		echo $i;echo "\n";
		//$kuery = "UPDATE t_mst_workflow_detail_request SET WORKFLOW_ID = '$i' WHERE WORKFLOW_ID IS NOT NULL";
		//$ahsiap = mysqli_query($conn,$kuery);
	}
?>