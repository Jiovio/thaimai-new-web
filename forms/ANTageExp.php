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

    $listQry = "SELECT ar.picmeno,ar.residentType, ar.picmeRegDate, ec.motherdob, mh.reg12weeks, ar.id, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, ec.motheraadhaarname,ar.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM anregistration ar JOIN ecregister ec on ec.picmeNo=ar.picmeno JOIN medicalhistory mh on mh.picmeno = ar.picmeno
                  WHERE ar.status!=0 AND ar.MotherAge < 20 AND NOT EXISTS (SELECT av.picmeno FROM antenatalvisit av WHERE av.picmeno = ar.picmeno)";  		
				   
    $orderQry = " ORDER BY ar.picmeRegDate DESC";	
		
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
			  
       $HscQry = "SELECT * From hscmaster";				 
	   $HscRes =  mysqli_query($conn,$HscQry);
       if($HscRes) {
         while($rowh = mysqli_fetch_array($HscRes)) 
		 {
		  if($rows['HscId']==$rowh['HscId'] AND
			 $rows['BlockId']==$rowh['BlockId'] AND
			 $rows['PhcId']==$rowh['PhcId'] AND
			 $rows['VillageId']==$rowh['VillageId'] AND
			 $rows['PanchayatId']==$rowh['PanchayatId'])
			 {
                $rows['BlockName'] = $rowh['BlockName'];       
                $rows['PhcName'] = $rowh['PhcName']; 
                $rows['HscName'] = $rowh['HscName'];
			    $rows['PanchayatName'] = $rowh['PanchayatName']; 
                $rows['VillageName'] = $rowh['VillageName']; 					  
}}}
		
		 if($rows['residentType'] == "1")
							{
							 $rows['residentType'] = "RESIDENT";
							}
							
							if($rows['residentType'] == "2")	
							{
							 $rows['residentType'] = "VISITOR";
							}	
							if($rows['reg12weeks'] == "1")
							{
							    $rows['reg12weeks'] = "No";
							}	
							if($rows['reg12weeks'] == "0")	
							{
							 $rows['reg12weeks'] = "Yes";
							}		
						
		$wild_srch = "";				     
	 if(strlen($search_text_input) > 0 )
	 {	 
       
       $wild_srch = $wild_cnt."||".   
	   $rows['picmeno']."||".
	   date('d-m-Y', strtotime($rows['picmeRegDate']))."||".
	   $rows['BlockName']."||".
       $rows['PhcName']."||".
       $rows['HscName']."||".
	   $rows['PanchayatName']."||".
       $rows['VillageName']."||".
	   $rows['residentType']."||".
       $rows['motheraadhaarname']."||".
	   $rows['MotherAge']."||".
	   $rows['husbandaadhaarname']."||".
	   $rows['mothermobno']."||".
	   date('d-m-Y', strtotime($rows['motherdob']))."||".
	   $rows['obstetricCode']."||".								   
	   date('d-m-Y', strtotime($rows['lmpdate']))."||".
       date('d-m-Y', strtotime($rows['edddate']))."||".
	   $rows['reg12weeks'];
	   
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
	$filename = "Teenage_Pregnancy_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Teenage Pregnancy List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No", "RCH ID","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No","Mother DOB", "Obstetric score","LMP","EDD","Late Registration (Yes/No)?");
			
		$excelData = implode("\t", array_values($h)) . "\n";
		$show_coloumn = true;
		}
		$lineData = array(
		$sno++, 
		$record['picmeno'],
	   date('d-m-Y', strtotime($record['picmeRegDate'])),
	   $record['BlockName'],
       $record['PhcName'],
       $record['HscName'],
	   $record['PanchayatName'],
       $record['VillageName'],
	   $record['residentType'],
       $record['motheraadhaarname'],
	   $record['MotherAge'],
	   $record['husbandaadhaarname'],
	   $record['mothermobno'],
	   date('d-m-Y', strtotime($record['motherdob'])),
	   $record['obstetricCode'],								   
	   date('d-m-Y', strtotime($record['lmpdate'])),
       date('d-m-Y', strtotime($record['edddate'])),
	   $record['reg12weeks']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>
