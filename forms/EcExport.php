<?php include ('require/topHeader.php'); ?>
<?php
//ini_set("display_errors",'1');
include '../config/db_connect.php';
$listQuery = "SELECT ec.picmeNo, ec.ecfrno,ec.motheraadhaarid,ec.motheraadhaarname,ec.motherdob,ec.motheragemarriage,ec.mothermobno,hm.BlockName,hm.PhcName,hm.HscName,
hm.PanchayatName,hm.VillageName,ar.anRegDate FROM ecregister ec LEFT JOIN hscmaster hm ON hm.BlockId=ec.BlockId AND hm.PhcId=ec.PhcId 
AND hm.HscId=ec.HscId AND hm.PanchayatId=ec.PanchayatId AND hm.VillageId=ec.VillageId LEFT JOIN anregistration ar ON 
ar.motheraadhaarid=ec.motheraadhaarid WHERE ec.status=1";
$orderQry = " ORDER BY ec.motheraadhaarname ASC";
if(isset($_POST["EcReport"])) {

		$bloName = $_POST['BlockId']; 
	$phcName = $_POST['PhcId'];
	$hscName = $_POST['HscId'];
	
			if($bloName == "" && $phcName == "" && $hscName == ""){
			  $ExeQuery = mysqli_query($conn,$listQuery.$orderQry);
			} else if($bloName != "" && $phcName == "" && $hscName == ""){
			  $ExeQuery = $listQuery." AND ec.BlockId='".$bloName."'".$orderQry;
			} else if($bloName != "" && $phcName != "" && $hscName == ""){
			  $ExeQuery = mysqli_query($conn,$listQuery." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."'".$orderQry);
			} else if($bloName != "" && $phcName != "" && $hscName != ""){
			  $ExeQuery = mysqli_query($conn,$listQuery." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."'".$orderQry);
			}
		  
	$developer_records = array();
	$sno=1;
	while( $rows = mysqli_fetch_assoc($ExeQuery) ) {
	  $developer_records[] = $rows;
	}	
	$filename = "ECouple_Report_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Eligible Couple Report as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_column = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
		$h = array("S.No","Ec Fr No","PICME No.","Mother Aadhaar ID","Mother Aadhaar Name","Mother Mobile No.","Block","Phc","Hsc","Panchayat","Village", "Antenatal Register Date");
			// display field/column names in first row
		$excelData = implode("\t", array_values($h)) . "\n";
		$show_coloumn = true;
		}
		$lineData = array(
		$sno++, 
		$record['ecfrno'], 
		$record['picmeNo'], 
		$record['motheraadhaarid'], 
		$record['motheraadhaarname'], 
		$record['mothermobno'], 
		$record['BlockName'], 
		$record['PhcName'],
		$record['HscName'],
		$record['PanchayatName'],
		$record['VillageName'],
		$record['anRegDate']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
		}
		echo $excelData;
	  }
	  exit; 
}
	

if(isset($_POST["teenageExp"])) {
	$TagelistQry = "SELECT ec.picmeNo, ec.ecfrno,ec.motheraadhaarid,ec.motheraadhaarname,ec.motherdob,ec.motheragemarriage,ec.mothermobno,hm.BlockName,hm.PhcName,hm.HscName,
	hm.PanchayatName,hm.VillageName,ar.anRegDate FROM ecregister ec LEFT JOIN hscmaster hm ON hm.BlockId=ec.BlockId AND hm.PhcId=ec.PhcId 
	AND hm.HscId=ec.HscId AND hm.PanchayatId=ec.PanchayatId AND hm.VillageId=ec.VillageId LEFT JOIN anregistration ar ON 
	ar.motheraadhaarid=ec.motheraadhaarid";
	$TeenPregquery = " WHERE TIMESTAMPDIFF(YEAR, motherdob,CURDATE())<18   and ec.status=1 order by ec.motheraadhaarname";
    
	$bloName = $_POST['BlockId']; 
	$phcName = $_POST['PhcId'];
	$hscName = $_POST['HscId'];
	
			if($bloName == "" && $phcName == "" && $hscName == ""){
			  $ExeQuery = mysqli_query($conn,$TagelistQry.$TeenPregquery);
			} else if($bloName != "" && $phcName == "" && $hscName == ""){
			  $ExeQuery = $TagelistQry." AND ec.BlockId='".$bloName."'".$TeenPregquery;
			} else if($bloName != "" && $phcName != "" && $hscName == ""){
			  $ExeQuery = mysqli_query($conn,$TagelistQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."'".$TeenPregquery);
			} else if($bloName != "" && $phcName != "" && $hscName != ""){
			  $ExeQuery = mysqli_query($conn,$TagelistQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."'".$TeenPregquery);
			}
		   
	// $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
	$developer_records = array();
	$sno=1;
	while( $rows = mysqli_fetch_assoc($ExeQuery) ) {
		$developer_records[] = $rows;
	}	
		$filename = "Teenage_ECouple_Report_".date('d-m-Y') . ".xls";			
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$file = fopen('php://output','w');
		$header = array("Teenage Eligible Couple Report as on ".date('d-m-Y'));
		fputcsv($file,$header);	
		$show_coloumn = false;
		if(!empty($developer_records)) {
		  foreach($developer_records as $record) {
			if(!$show_coloumn) {

			  // display field/column names in first row
			$h = array("S.No","Ec Fr No","PICME No.","Mother Aadhaar ID","Mother Aadhaar Name","Mother Mobile No.","Block","Phc","Hsc","Panchayat","Village", "Antenatal Register Date");
			  $excelData = implode("\t", array_values($h)) . "\n";
		      $show_coloumn = true;
			}
			$lineData = array(
				$sno++, 
				$record['ecfrno'], 
				$record['picmeNo'], 
				$record['motheraadhaarid'], 
				$record['motheraadhaarname'], 
				$record['mothermobno'], 
				$record['BlockName'], 
				$record['PhcName'],
				$record['HscName'],
				$record['PanchayatName'],
				$record['VillageName'],
				$record['anRegDate']
				); 
				$excelData .= implode("\t", array_values($lineData)) . "\n";
		  }
		  echo $excelData;
		}
		exit;  
	
	}
?>