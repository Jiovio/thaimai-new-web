<?php
include_once("../config/db_connect.php");
$query = "SELECT ec.ecfrno,ec.picmeNo,ec.motheraadhaarid,ec.motheraadhaarname,ec.mothermobno,hm.BlockName,hm.PhcName,hm.HscName,hm.PanchayatName,hm.VillageName,ar.anRegDate FROM ecregister ec LEFT JOIN hscmaster hm ON hm.BlockId=ec.BlockId AND hm.PhcId=ec.PhcId AND hm.HscId=ec.HscId AND hm.PanchayatId=ec.PanchayatId AND hm.VillageId=ec.VillageId LEFT JOIN anregistration ar ON ar.motheraadhaarid=ec.motheraadhaarid";
if(isset($_POST["export_data"])) {	
$sql_query = $query." order by ec.motheraadhaarname";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
$sno=1;
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$developer_records[] = $rows;
}	
$filename = "Pregnant_Report_".date('d-m-Y') . ".xls";			
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	$file = fopen('php://output','w');
	$header = array("Pregnancy Report as on ".date('d-m-Y'));
	fputcsv($file,$header);	
	$show_coloumn = false;
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

if(isset($_POST["teenPregExp"])) {	
	$sql_query = $query." WHERE TIMESTAMPDIFF(YEAR, motherdob,CURDATE())>18 order by ec.motheraadhaarname";
	$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
	$developer_records = array();
	$sno=1;
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$developer_records[] = $rows;
	}	
		$filename = "Teenage_Pregnancy_Report_".date('d-m-Y') . ".xls";			
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$file = fopen('php://output','w');
		$header = array("Teenage Pregnancy Report as on ".date('d-m-Y'));
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