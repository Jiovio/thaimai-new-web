<?php include ('require/topHeader.php'); ?>
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

    $listQry = "SELECT av.picmeno, av.gctStatus, av.id, av.symptomsHighRisk, av.residenttype, av.motherWeight, av.gctValue, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno) 
				  AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)
				  AND av.gctStatus != 4 AND av.gctValue > 140";  		
				   	
    $orderQry = " ORDER BY av.picmeno DESC";
		
    if($bloName == "" && $phcName == "" && $hscName == ""){
       $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
       } else if($bloName != "" && $phcName == "" && $hscName == ""){
       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."'".$orderQry);
       } else if($bloName != "" && $phcName != "" && $hscName == ""){
       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."'".$orderQry);
       } else if($bloName != "" && $phcName != "" && $hscName != ""){
       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."'".$orderQry);
       } 
	          		                  		  
		$rows['BlockName'] = "";
			 $rows['PhcName'] = "";
			 $rows['HscName'] = "";
			 $rows['PanchayatName'] = "";
			 $rows['VillageName'] = "";	 	
	$developer_records = array();
	$sno=1;

	while( $rows = mysqli_fetch_assoc($ExeQuery) ) {
		$search_flag = false;  
$gdm_picme = "";
					$gdm_picme = $rows['picmeno'];
					$rows['gctweek1'] = "";
					$rows['gctweek2'] = "";
					$rows['gctweek3'] = "";
					$listQry_GCT_Week1 = "SELECT av.gctStatus, av.gctValue, av.motherWeight FROM antenatalvisit av WHERE av.picmeno = $gdm_picme and av.gctStatus = 1";
					                  //    av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)))"; 
					$ExeQuery_Week1 = mysqli_query($conn, $listQry_GCT_Week1); 
					if($ExeQuery_Week1) {
						while($wk1 = mysqli_fetch_array($ExeQuery_Week1))
						{
						//	print_r("I am here First"); 
							
							$rows['gctweek1'] = $wk1['gctValue'];  
							
							$rows['motherWeight'] = $wk1['motherWeight'];
						//	print_r($wk1['gctweek1']); 
	                    }}
						
					$listQry_GCT_Week2 = "SELECT av.gctStatus, av.gctValue, av.motherWeight FROM antenatalvisit av WHERE av.picmeno = $gdm_picme and av.gctStatus = 2";
					                  //    av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)))"; 
					$ExeQuery_Week2 = mysqli_query($conn, $listQry_GCT_Week2); 
					if($ExeQuery_Week2) {
						while($wk2 = mysqli_fetch_array($ExeQuery_Week2))
						{
						//	print_r("I am here Second"); 
							
							$rows['gctweek2'] = $wk2['gctValue'];
							
							$rows['motherWeight'] = $wk2['motherWeight'];
						//	print_r($wk2['gctweek2']); 
	                    }}
						
						$listQry_GCT_Week3 = "SELECT av.gctStatus, av.gctValue, av.motherWeight FROM antenatalvisit av WHERE av.picmeno = $gdm_picme and av.gctStatus = 3";
					                  //    av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)))"; 
					$ExeQuery_Week3 = mysqli_query($conn, $listQry_GCT_Week3); 
					if($ExeQuery_Week3) {
						while($wk3 = mysqli_fetch_array($ExeQuery_Week3))
						{
						//	print_r("I am here Third"); 
							
							$rows['gctweek3'] = $wk3['gctValue'];
							
							$rows['motherWeight'] = $wk3['motherWeight'];
						//	print_r($wk3['gctweek3']); exit;
	                    }}
						
                  $rows['treatment'] = "Taken";
	
			  
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
//}}
		
		if($rows['residenttype'] == "1") /*Resident/Visitor*/
							{
							 $rows['residenttype'] = "RESIDENT";
							}
							
							if($rows['residenttype'] == "2")	
							{
							 $rows['residenttype'] = "VISITOR";
							}	
							
						
		$wild_srch = "";				     
	 if(strlen($search_text_input) > 0 )
	 {	 
       
       $wild_srch = $wild_cnt++."||".   
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
	   $rows['obstetricCode']."||".								   
	   date('d-m-Y', strtotime($rows['lmpdate']))."||".
       date('d-m-Y', strtotime($rows['edddate']))."||".
	   $rows['motherWeight']."||".
       $rows['gctweek1']."||".
       $rows['gctweek2']."||".
       $rows['gctweek3'];  
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;   
		
	//	print_r($rows['picmeno']); exit;
	   }
}
//	$wild_cnt++;
	
	if($search_flag || strlen($search_text_input) == 0 )
	{
	  $developer_records[] = $rows;
}}	
}}}
	$filename = "GDM_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("GDM List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No", "RCH ID","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No", "Obstetric score","LMP","EDD","Weight Gain","GCT Weeks (12-16)","GCT Weeks (24-28)","GCT Weeks (32-34)");
			
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
	   $record['obstetricCode'],								   
	   date('d-m-Y', strtotime($record['lmpdate'])),
       date('d-m-Y', strtotime($record['edddate'])),
	   $record['motherWeight'],
	   $record['gctweek1'],
	   $record['gctweek2'],
	   $record['gctweek3']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	  }
		echo $excelData;
	}
	
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>