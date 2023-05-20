<?php 
//session_start();
error_reporting(E_ALL);
include "../config/db_connect.php";
 

	$hscName = "";
	$bloName = "";
	$phcName = "";
	$search_text_input = "";
   if(isset($_POST['HscId']))
	{
	  $hscName = $_POST['HscId'];
	}
	if(isset($_POST['BlockId']))
	{
	  $bloName = $_POST['BlockId'];
	} 
	if(isset($_POST['PhcId']))
	{
	  $phcName = $_POST['PhcId'];
	} 	
	if(isset($_POST['search_text_input']))
	{
	  $search_text_input = trim($_POST['search_text_input']);
	  $wild_cnt = 1;     /*Serial No search */
	} 	
//	print_r($_POST['search_text_input']); exit;

//if(strlen($search_text_input) > 0 )

    $listQry = "SELECT ec.picmeno, ec.id, hs.BlockName,hs.PhcName,hs.HscName, hs.PanchayatName, hs.VillageName,ec.ecfrno, ec.HscId, ec.VillageId, ec.PanchayatId, ec.dateecreg, ec.motherageecreg, ec.motheraadhaarname, ec.BlockId,ec.PhcId, ec.mothermobno,ec.motheraadhaarid FROM ecregister ec INNER JOIN hscmaster hs on (ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId = hs.HscId AND ec.VillageId = hs.VillageId AND ec.PanchayatId = hs.PanchayatId) WHERE ec.status!= 0 
                  AND ec.motherageecreg > 19 AND NOT EXISTS (SELECT ar.picmeno FROM anregistration ar WHERE ar.picmeno = ec.picmeno)";    		
				   
    $orderQry = " ORDER BY ec.dateecreg DESC";	
		
    if($bloName == "" && $phcName == "" && $hscName == ""){
       $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
       } else if($bloName != "" && $phcName == "" && $hscName == ""){
       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."'".$orderQry);
       } else if($bloName != "" && $phcName != "" && $hscName == ""){
       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."'".$orderQry);
       } else if($bloName != "" && $phcName != "" && $hscName != ""){
       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."'".$orderQry);
       } 
	          		                  		  
	$developer_records = array();
	$sno=1;
	while( $rows = mysqli_fetch_assoc($ExeQuery) ) {
		$search_flag = false; 
		//print_r(search_text_input); exit;
		
	 $wild_srch = "";					     
	 if(strlen($search_text_input) > 0 )
	 {	 
       $wild_srch =  $wild_cnt."||".
	   $rows['ecfrno']."||".
	   $rows['picmeno']."||".
	   date('d-m-Y', strtotime($rows['dateecreg']))."||".
	   $rows['motheraadhaarid']."||".
	   $rows['motheraadhaarname']."||".
	   $rows['mothermobno']."||".
	   $rows['motherageecreg']."||".
	   $rows['BlockName']."||".
       $rows['PhcName']."||".
       $rows['HscName']."||".
	   $rows['PanchayatName']."||".
       $rows['VillageName'];
	   //	     print_r($wild_srch); exit;
		//print_r($rows['picmeno']); exit;
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;   
		
	//	print_r($rows['picmeno']); exit;
	   }
}
	 $wild_cnt++;
	if($search_flag || strlen($search_text_input) == 0 )
	{
	  $developer_records[] = $rows;
}}	
	$filename = "EC_Teenage_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Eligible Couples Teenage List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No","ECFR No","RCH ID","EC Registered Date","Mother's Aadhar No","Mother's Aadhar Name","Mother's Mobile No","Mother's Age @ EC Registration","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward");
			
		$excelData = implode("\t", array_values($h)) . "\n";
		$show_coloumn = true;
		}
		$lineData = array(
		$sno++, 
		$record['ecfrno'],
		$record['picmeno'], 
		date('d-m-Y', strtotime($record['dateecreg'])), 
		$record['motheraadhaarid'],
		$record['motheraadhaarname'],
		$record['mothermobno'],
		$record['motherageecreg'],
		$record['BlockName'], 
		$record['PhcName'], 
		$record['HscName'], 
		$record['PanchayatName'], 
		$record['VillageName']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>

