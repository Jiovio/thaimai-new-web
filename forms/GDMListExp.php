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
	  $wild_cnt = 0;     /*Serial No search */
	}

    $pre_picmeno = "";
		$pre_gct_st = "";
		$pre_motherWeight  = "";
		$pre_GCTWeek1 = "";
		$pre_GCTWeek2 = "";
		$pre_GCTWeek3 = "";
		 $rows['GCTWeek1'] = "";
	     $rows['GCTWeek2'] = "";
	     $rows['GCTWeek3'] = "";	
         $fpre_GCTWeek1 = "";
         $fpre_GCTWeek2 = "";	
         $fpre_GCTWeek3 = "";		
		 	

   $listQry = "SELECT av.picmeno, av.gctStatus, av.id, av.symptomsHighRisk, av.residenttype, av.motherWeight, av.gctValue, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno) AND av.gctStatus != 4 AND av.gctValue > 140";  		
				   
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
                $rows['BlockName'] = $rowh['BlockName']; 
                $rows['PhcName'] = $rowh['PhcName']; 
                $rows['HscName'] = $rowh['HscName'];
			    $rows['PanchayatName'] = $rowh['PanchayatName']; 
                $rows['VillageName'] = $rowh['VillageName']; 
	  // }}}
        if($rows['residenttype'] == "1") /*Resident/Visitor*/
							{
							 $rows['residenttype'] = "RESIDENT";
							}
							
							if($rows['residenttype'] == "2")	
							{
							 $rows['residenttype'] = "VISITOR";
							}	
						
	/*	$wild_srch = "";				     
	    if(strlen($search_text_input) > 0 )
	    {	 
       
       $wild_srch = $wild_cnt. "||".  /* "*" - separates serails no */
	 /*  $rows['picmeno']."||".
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
						   $rows['address']."||". 
						   date('d-m-Y', strtotime($rows['deliverydate']))."||". 
					       $rows['hospitaltype']."||". 									   
					       $rows['deliverytype']."||". 
						   $rows['deliveryOutcome']."||".  
					       $rows['ppcMethod']; */
	   
	/*   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	 //  {
	//	$search_flag = true;  
//print_r($wild_srch); 		
	//	print_r($ppcMethod); exit;
	//   }
//}
    
	 
	//  if($wild_cnt == "181"){
	//  print_r($wild_cnt);
	 // print_r($rows['picmeno']); exit;}
	 //  $wild_cnt++;
	
	//if($search_flag || strlen($search_text_input) == 0 )
//	{
	//	print_r($rows['VillageName']); exit;		
	                    if($rows['gctStatus'] == "1")
						{
							
						 $pre_GCTWeek1 = $rows['gctValue'];
					     $rows['GCTWeek1'] = $rows['gctValue'];
						 
						}
						else
						if($rows['gctStatus'] == "2") /* Here not used. But for extra check */
						{
						 $pre_GCTWeek2 = $rows['gctValue'];
					     $rows['GCTWeek2'] = $rows['gctValue'];
						}
						else
						if($rows['gctStatus'] == "3") /* Here not used. But for extra check */
						{
						 $pre_GCTWeek3 = $rows['gctValue'];
						 $rows['GCTWeek3'] = $rows['gctValue'];
						}
						
						$pre_rows = $rows;    /*For next record */		
						
						if($pre_picmeno != $rows['picmeno'])
						{
							if(strlen($pre_picmeno)>0)
							{
					  $pre_rows['picmeno'] = $fpre_picmeno;  
					  $pre_rows['picmeRegDate' ] = date('d-m-Y', strtotime($fpre_picmeRegDate));  
				      $pre_rows['BlockName'] = $fpre_BlockName;  
                      $pre_rows['PhcName'] = $fpre_PhcName;  
                      $pre_rows['HscName'] = $fpre_HscName;  
			          $pre_rows['PanchayatName'] = $fpre_PanchayatName;  
                      $pre_rows['VillageName']  = $fpre_VillageName;  
					  $pre_rows['residenttype'] = $fpre_residenttype;  
                      $pre_rows['motheraadhaarname'] = $fpre_motheraadhaarname ;  
					  $pre_rows['MotherAge'] = $fpre_MotherAge;  
					  $pre_rows['husbandaadhaarname'] = $fpre_husbandaadhaarname;  
			          $pre_rows['mothermobno'] = $fpre_mothermobno;  
					  $pre_rows['obstetricCode'] = $fpre_obstetricCode ;  								   
					  $pre_rows['lmpdate'] = date('d-m-Y', strtotime($fpre_lmpdate));  
                      $pre_rows['edddate'] = date('d-m-Y', strtotime($fpre_edddate )); 
					  $pre_rows['GCTWeek1'] = $fpre_GCTWeek1;
					  $pre_rows['motherWeight'] = $fpre_motherWeight ;
					  $pre_rows['GCTWeek2'] = $fpre_GCTWeek2;
					  $pre_rows['GCTWeek3'] = $fpre_GCTWeek3;
					  
					  $wild_srch = "";   
	 if(strlen($search_text_input) > 0 )
	 {	 
       $wild_srch =  $wild_cnt."||".  
	   $fpre_picmeno."||".  
       $fpre_picmeRegDate."||".   
	   $fpre_BlockName."||". 
       $fpre_PhcName."||".  
       $fpre_HscName."||". 
	   $fpre_PanchayatName."||".   
       $fpre_VillageName."||".   
	   $fpre_residenttype."||".   
       $fpre_motheraadhaarname."||". 
	   $fpre_MotherAge."||".  
	   $fpre_husbandaadhaarname."||". 
	   $fpre_mothermobno."||".  
	   $fpre_obstetricCode."||".   								   
	   $fpre_lmpdate."||".   
       $fpre_edddate."||".  
       $fpre_motherWeight ."||".
       $fpre_GCTWeek1."||". 
	   $fpre_GCTWeek2."||".
	   $fpre_GCTWeek3;
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;   
	   }
}
	 
	 $wild_cnt++;
	 
	 if($search_flag || strlen($search_text_input) == 0 )
	{
	  $developer_records[] = $pre_rows;	
}}
}}}
						
						
					  $fpre_picmeno = $rows['picmeno'] ;  
					  $fpre_picmeRegDate = date('d-m-Y', strtotime($rows['picmeRegDate' ]));  
				      $fpre_BlockName = $rows['BlockName'] ;  
                      $fpre_PhcName = $rows['PhcName'] ;  
                      $fpre_HscName = $rows['HscName'] ;  
			          $fpre_PanchayatName =  $rows['PanchayatName'] ;  
                      $fpre_VillageName = $rows['VillageName'] ;  
					  $fpre_residenttype =  $rows['residenttype'] ;  
                      $fpre_motheraadhaarname = $rows['motheraadhaarname'] ;  
					  $fpre_MotherAge =    $rows['MotherAge'] ;  
					  $fpre_husbandaadhaarname  =   $rows['husbandaadhaarname'] ;  
			          $fpre_mothermobno = $rows['mothermobno'] ;  
					  $fpre_obstetricCode =  $rows['obstetricCode'] ;  								   
					  $fpre_lmpdate = date('d-m-Y', strtotime($rows['lmpdate'] ));  
                      $fpre_edddate = date('d-m-Y', strtotime($rows['edddate'] )); 
					  $fpre_GCTWeek1 = $rows['GCTWeek1'];
					//  print_r($fpre_GCTWeek1);
					  $fpre_motherWeight = $rows['motherWeight'];
					  
					  
					  
					//	}
											  
						
	                       $pre_picmeno = $rows['picmeno'];
						}
						else
						{
						if($rows['gctStatus'] == "2") /* Here not used. But for extra check */
						{
					//	 $pre_GCTWeek2 = $rows['gctValue'];
					      $rows['GCTWeek2'] = $rows['gctValue'];
						  $fpre_GCTWeek2 = $rows['GCTWeek2'];
						  $fpre_motherWeight = $rows['motherWeight'];
				      //   $developer_records[] = $rows;
						}
						else
						if($rows['gctStatus'] == "3") /* Here not used. But for extra check */
					{
					//	 $pre_GCTWeek3 = $rows['gctValue'];
					     $rows['GCTWeek3'] = $rows['gctValue'];
						 $fpre_GCTWeek3 = $rows['GCTWeek3'];
						 $fpre_motherWeight = $rows['motherWeight'];
					//	 $developer_records[] = $rows;
						 						//  $rows['GCTWeek3'] = $rows['gctValue'];
						}	
						}
						
	//   print_r($rows['BlockName']);
	//		 print_r($rows['PhcName']);
	//		 print_r($rows['HscName']);
	//		 print_r($rows['PanchayatName']);
	//		 print_r($rows['VillageName']); exit;
//}
	}	
 //print_r("$ppcMethod"); print_r($ppcMethod); exit;
	$filename = "GDM_Report_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("GDM Report as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  
	                  $pre_rows['picmeno'] = $fpre_picmeno;  
					  $pre_rows['picmeRegDate' ] = date('d-m-Y', strtotime($fpre_picmeRegDate));  
				      $pre_rows['BlockName'] = $fpre_BlockName;  
                      $pre_rows['PhcName'] = $fpre_PhcName;  
                      $pre_rows['HscName'] = $fpre_HscName;  
			          $pre_rows['PanchayatName'] = $fpre_PanchayatName;  
                      $pre_rows['VillageName']  = $fpre_VillageName;  
					  $pre_rows['residenttype'] = $fpre_residenttype;  
                      $pre_rows['motheraadhaarname'] = $fpre_motheraadhaarname ;  
					  $pre_rows['MotherAge'] = $fpre_MotherAge;  
					  $pre_rows['husbandaadhaarname'] = $fpre_husbandaadhaarname;  
			          $pre_rows['mothermobno'] = $fpre_mothermobno;  
					  $pre_rows['obstetricCode'] = $fpre_obstetricCode ;  								   
					  $pre_rows['lmpdate'] = date('d-m-Y', strtotime($fpre_lmpdate));  
                      $pre_rows['edddate'] = date('d-m-Y', strtotime($fpre_edddate )); 
					  $pre_rows['GCTWeek1'] = $fpre_GCTWeek1;
					  $pre_rows['motherWeight'] = $fpre_motherWeight ;
					  $pre_rows['GCTWeek2'] = $fpre_GCTWeek2;
					  $pre_rows['GCTWeek3'] = $fpre_GCTWeek3;
					  
					  $wild_srch = "";   
	 if(strlen($search_text_input) > 0 )
	 {	 
       $wild_srch =  $wild_cnt."||".  
	   $fpre_picmeno."||".  
       $fpre_picmeRegDate."||".   
	   $fpre_BlockName."||". 
       $fpre_PhcName."||".  
       $fpre_HscName."||". 
	   $fpre_PanchayatName."||".   
       $fpre_VillageName."||".   
	   $fpre_residenttype."||".   
       $fpre_motheraadhaarname."||". 
	   $fpre_MotherAge."||".  
	   $fpre_husbandaadhaarname."||". 
	   $fpre_mothermobno."||".  
	   $fpre_obstetricCode."||".   								   
	   $fpre_lmpdate."||".   
       $fpre_edddate."||".  
       $fpre_motherWeight ."||".
       $fpre_GCTWeek1."||". 
	   $fpre_GCTWeek2."||".
	   $fpre_GCTWeek3;
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;   
	   }
}
	 
	 $wild_cnt++;
	 
	 if($search_flag || strlen($search_text_input) == 0 )
	{
	  $developer_records[] = $pre_rows;	
}
								
							  
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No","RCH ID","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No", "Obstetric score","LMP","EDD","Weight Gain","GCT Weeks (12-16)","GCT Weeks (24-28)","GCT Weeks (32-34)");
			
		$excelData = implode("\t", array_values($h)) . "\n";
		$show_coloumn = true;	
	/*	$record['GCTWeek1'] = $pre_GCTWeek1;
	  $record['GCTWeek2'] = $pre_GCTWeek2;
	  $record['GCTWeek3'] = $pre_GCTWeek3; */
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
						    $record['residenttype'],
                            $record['motheraadhaarname'],
					        $record['MotherAge'],
					        $record['husbandaadhaarname'],
			                $record['mothermobno'],
							$record['obstetricCode'], 	 								   
					       date('d-m-Y', strtotime($record['lmpdate'] )),  
                           date('d-m-Y', strtotime($record['edddate'] )), 
						 $record['motherWeight'],
		                 $record['GCTWeek1'],
		                 $record['GCTWeek2'],
		                 $record['GCTWeek3'] 
						   
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
	   
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 


