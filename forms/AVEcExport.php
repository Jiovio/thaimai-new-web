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

    $listQry = "SELECT av.picmeno,av.id, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status=1 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno)";   		
				   
    $orderQry = " ORDER BY av.picmeno ASC";  	
		
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

       $rows['BlockName'] = "";       
                $rows['PhcName'] = ""; 
                $rows['HscName'] = "";
			    $rows['PanchayatName'] = ""; 
                $rows['VillageName'] = "";
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

 if($rows['symptomsHighRisk'] == "1")	
							{
							$rows['symptomsHighRisk'] = "Teenage Pregnancy";}
							else								
							    if($rows['symptomsHighRisk'] == "2")	
							    {
								$rows['symptomsHighRisk'] = "Elderly Primi"; }
								 else
							    	 if($rows['symptomsHighRisk'] == "3")	
							         {
									 $rows['symptomsHighRisk'] = "Elderly Multi "; }
									   else 
										   if($rows['symptomsHighRisk'] == "4")	
										   {
                                           $rows['symptomsHighRisk'] = "Short Primi"; 											   
						                   }
                                           else
	                                       if($rows['symptomsHighRisk'] == "5")	
										   {
                                           $rows['symptomsHighRisk'] = "Severe Anaemia"; 											   
						                   }	
                                          else
											if($rows['symptomsHighRisk'] == "6")	
										   {
                                           $rows['symptomsHighRisk'] = "PIH/Pre Eclampsia/Eclampsia"; 											   
						                   }	
										   else
										   if($rows['symptomsHighRisk'] == "7")	
										   {
                                           $rows['symptomsHighRisk'] = "Hydraminios"; 	
                                           								   
	                                    	 }		
		                                   if($rows['symptomsHighRisk'] == "8")	
										   {
                                           $rows['symptomsHighRisk'] = "APH"; 	
                                           								   
	                                    	 }		
                                           if($rows['symptomsHighRisk'] == "9")	
										   {
                                           $rows['symptomsHighRisk'] = "Multi Para"; 	
                                           								   
		                                     }				 
											 
											 if($rows['symptomsHighRisk'] == "10")	
							{
							$rows['symptomsHighRisk'] = "Multiple Pregnancy";}
							else								
							    if($rows['symptomsHighRisk'] == "11")	
							    {
								$rows['symptomsHighRisk'] = "Vesicular Mole"; }
								 else
							    	 if($rows['symptomsHighRisk'] == "12")	
							         {
									 $rows['symptomsHighRisk'] = "Rh incompatibility"; }
									   else 
										   if($rows['symptomsHighRisk'] == "13")	
										   {
                                           $rows['symptomsHighRisk'] = "Previous LSCS"; 											   
						                   }
                                           else
	                                       if($rows['symptomsHighRisk'] == "14")	
										   {
                                           $rows['symptomsHighRisk'] = "Instrumental V.D"; 											   
						                   }	
                                          else
											if($rows['symptomsHighRisk'] == "15")	
										   {
                                           $rows['symptomsHighRisk'] = "Weight below 40 kg"; 											   
						                   }	
										   else
										   if($rows['symptomsHighRisk'] == "16")	
										   {
                                           $rows['symptomsHighRisk'] = "Heart Disease complicating pregnancy"; 	
                                           								   
	                                    	 }		
		                                   if($rows['symptomsHighRisk'] == "17")	
										   {
                                           $rows['symptomsHighRisk'] = "Malaria"; 	
                                           								   
	                                    	 }		
                                           if($rows['symptomsHighRisk'] == "18")	
										   {
                                           $rows['symptomsHighRisk'] = "Long period infertility"; 	
                                           								   
		                                     }			

											if($rows['symptomsHighRisk'] == "19")	
							{
							$rows['symptomsHighRisk'] = "GDM";}
							else								
							    if($rows['symptomsHighRisk'] == "20")	
							    {
								$rows['symptomsHighRisk'] = "Previous bad obstetric history"; }
								 else
							    	 if($rows['symptomsHighRisk'] == "21")	
							         {
									 $rows['symptomsHighRisk'] = "Cancer"; }
									   else 
										   if($rows['symptomsHighRisk'] == "22")	
										   {
                                           $rows['symptomsHighRisk'] = "Intracranial Space occupying lesion"; 											   
						                   }
                                           else
	                                       if($rows['symptomsHighRisk'] == "23")	
										   {
                                           $rows['symptomsHighRisk'] = "Pregnant due to contraceptive Failure"; 											   
						                   }	
                                          else
											if($rows['symptomsHighRisk'] == "24")	
										   {
                                           $rows['symptomsHighRisk'] = "Ectopic Pregnancy"; 											   
						                   }	
										   else
										   if($rows['symptomsHighRisk'] == "25")	
										   {
                                           $rows['symptomsHighRisk'] = "Malpresentation"; 	
										   }				

		  $wild_srch = "";   
	 if(strlen($search_text_input) > 0 )
	 {	 
       $wild_srch =  $wild_cnt++."||".  
	   $rows['picmeno'].
	   date('d-m-Y', strtotime($rows['picmeRegDate']))."||". 
	   $rows['BlockName']."||".  
       $rows['PhcName']."||". 
       $rows['HscName']."||". 
	   $rows['PanchayatName']."||". 
       $rows['VillageName']."||". 
       $rows['motheraadhaarname']."||". 
	   $rows['MotherAge']."||". 
	   $rows['husbandaadhaarname']."||". 
	   $rows['mothermobno']."||". 
	   $rows['obstetricCode']."||". 								   
	   date('d-m-Y', strtotime($rows['lmpdate']))."||". 
       date('d-m-Y', strtotime($rows['edddate']))."||". 
	   $rows['pregnancyWeek']."||". 
	   $rows['symptomsHighRisk'];					   
	   
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
	$filename = "AV_Report_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Antenatal Visit Report as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No","RCH ID","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Mother Name","Age","Husband Name", "Mobile No", "Obstetric score","LMP","EDD","Gestational Age in Weeks","High Risk Factor");
			
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
		$record['motheraadhaarname'],
		$record['MotherAge'],
		$record['husbandaadhaarname'],
		$record['mothermobno'],
		$record['obstetricCode'],
		date('d-m-Y', strtotime($record['lmpdate'])),
		date('d-m-Y', strtotime($record['edddate'])),
		$record['pregnancyWeek'],
		$record['symptomsHighRisk']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>
