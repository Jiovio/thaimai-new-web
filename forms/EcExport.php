<?php
include_once("../config/db_connect.php");
$query = "SELECT ec.ecfrno,ec.picmeNo,ec.motheraadhaarid,ec.motheraadhaarname,ec.mothermobno,hm.BlockName,hm.PhcName,hm.HscName,hm.PanchayatName,hm.VillageName,ar.anRegDate FROM ecregister ec LEFT JOIN hscmaster hm ON hm.BlockId=ec.BlockId AND hm.PhcId=ec.PhcId AND hm.HscId=ec.HscId AND hm.PanchayatId=ec.PanchayatId AND hm.VillageId=ec.VillageId LEFT JOIN anregistration ar ON ar.motheraadhaarid=ec.motheraadhaarid";
if(isset($_POST["export_data"])) {	
$sql_query = $query;
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
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
		  // display field/column names in first row
		  echo ucwords(implode("\t", array_keys($record))) . "\n";
		  $show_coloumn = true;
		}
		echo implode("\t", array_values($record)) . "\n";
	  }
	}
	exit;  
}

if(isset($_POST["teenPregExp"])) {	
	$sql_query = $query." WHERE TIMESTAMPDIFF(YEAR, motherdob,CURDATE())>18";
	$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
	$developer_records = array();
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
			  echo ucwords(implode("\t", array_keys($record))) . "\n";
			  $show_coloumn = true;
			}
			echo implode("\t", array_values($record)) . "\n";
		  }
		}
		exit;  
	}

?>