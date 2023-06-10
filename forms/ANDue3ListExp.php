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

//if(strlen($search_text_input) > 0 )

    $listQry = "SELECT av.picmeno,av.id, av.symptomsHighRisk, av.residenttype, av.motherWeight, av.Hb, av.bpSys, av.bpDia, av.HighRisk, ec.address, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno) AND (TIMESTAMPDIFF(MONTH, CURRENT_DATE(), mh.edddate) <= 3)";   		
				   
    $orderQry = " ORDER BY ar.anRegDate DESC";  	
		
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
	   
  //  if(strlen($search_text_input) > 0 )
//	{					  
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
//	}
                $rows['BlockName'] = $rowh['BlockName'];       
                $rows['PhcName'] = $rowh['PhcName']; 
                $rows['HscName'] = $rowh['HscName'];
			    $rows['PanchayatName'] = $rowh['PanchayatName']; 
                $rows['VillageName'] = $rowh['VillageName']; 					  

                            if($rows['residenttype'] == "1")
							{
							 $rows['residenttype'] = "RESIDENT";
							}
							
							if($rows['residenttype'] == "2")	
							{
							 $rows['residenttype'] = "VISITOR";
							}	
							
							if($rows['HighRisk'] == "1")
							{
							 $rows['HighRisk'] = "Yes";
							}
							
							if($rows['HighRisk'] == "0")	
							{
							 $rows['HighRisk'] = "No";
							}	
		  $wild_srch = "";   
	 if(strlen($search_text_input) > 0 )
	 {	 
       $wild_srch =  $wild_cnt++."||".  
	   $rows['picmeno']."||".  
	   date('d-m-Y', strtotime($rows['anRegDate']))."||".  
	   $rows['BlockName']."||".   
       $rows['PhcName']."||".  
       $rows['HscName']."||".  
	   $rows['PanchayatName']."||".  
       $rows['VillageName']."||".  
	   $rows['residenttype']."||". 
       $rows['motheraadhaarname']."||".  
	   $rows['MotherAge']."||".  
	   $rows['husbandaadhaarname']."||".  
	   $rows['mothermobno']."||".  
	   $rows['pregnancyWeek']."||".
	   $rows['address']."||".
	   $rows['motherWeight']."||".
	   $rows['Hb']."||".
	   $rows['bpSys']."||".
	   $rows['bpDia']."||".
	   $rows['HighRisk'];					   
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;   
	   }
}
	// $wild_cnt++;
	if($search_flag || strlen($search_text_input) == 0 )
	{
	  $developer_records[] = $rows;
}}	
	}}}
	$filename = "AN_Delivery_Due_List_(3 Months EDD)".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("AN Delivery Due Report (3 Months EDD) as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No","RCH ID","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No", "Gestational Age in Weeks","Address","Weight Gain","HB","BP Systolic","BP Diastolic","High Risk (Yes/No)?");
			
		$excelData = implode("\t", array_values($h)) . "\n";
		$show_coloumn = true;
		}
		$lineData = array(
		$sno++, 
		$record['picmeno'], 
		date('d-m-Y', strtotime($record['anRegDate'])), 
		$record['BlockName'], 
		$record['PhcName'], 
		$record['HscName'], 
		$record['PanchayatName'], 
		$record['VillageName'],
		 $record['residenttype'],
		$record['motheraadhaarname'],
		$record['MotherAge'],
		$record['husbandaadhaarname'],
		$record['mothermobno'],
		$record['pregnancyWeek'],
		$record['address'],
		$record['motherWeight'],
		$record['Hb'],
		$record['bpSys'],
		$record['bpDia'],
		$record['HighRisk']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>
