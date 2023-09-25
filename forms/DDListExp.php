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

    $listQry ="SELECT dd.picmeno,ar.residentType, dd.deliverydate, dd.hospitaltype, dd.deliverytype,dd.deliveryOutcome, dd.id, ec.address, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.MotherAge, ec.motheraadhaarname,dd.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno
             	  FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno JOIN anregistration ar on dd.picmeno = ar.picmeno
                  WHERE dd.status!=0 AND NOT EXISTS (SELECT pv.picmeNo FROM postnatalvisit pv WHERE pv.picmeNo = dd.picmeno)";  		
    $orderQry = " ORDER BY dd.deliverydate DESC";
		
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
		
	//	print_r($rows['address']); exit;
    
	//		 print_r($rows['BlockId']);
	//		 print_r($rows['PhcId']);
	//         print_r($rows['HscId']);
			
	//	 print_r($rows['PanchayatId']); 
	// print_r($rows['VillageId']);exit;
	
             $rows['BlockName'] = "";
			 $rows['PhcName'] = "";
			 $rows['HscName'] = "";
			 $rows['PanchayatName'] = "";
			 $rows['VillageName'] = "";	 
			 $rows['ppcMethod'] = "";				  
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
               			 	
				
//print_r($rows['HscId']); exit;				
//}}}
        if($rows['residentType'] == "1") /*Resident/Visitor*/
							{
							 $rows['residentType'] = "RESIDENT";
							}
							
							if($rows['residentType'] == "2")	
							{
							 $rows['residentType'] = "VISITOR";
							}	
							
							if($rows['deliverytype'] == "1") /*delivery Type*/
							{
							$rows['deliverytype'] = "Normal";
							}	
							if($rows['deliverytype'] == "2")	
							{
							 $rows['deliverytype'] = "Caesarian";
							}	
							if($rows['deliverytype'] == "3")	
							{
							 $rows['deliverytype'] = "Assisted";
							}	
							
							if($rows['deliveryOutcome'] == "1")	/*delivery Outcome*/
							{
							$rows['deliveryOutcome'] = "Live Birth";}
							else								
							if($rows['deliveryOutcome'] == "2")	
							{
							$rows['deliveryOutcome'] = "Still Birth"; }
							else
							if($rows['deliveryOutcome'] == "3")	
							{
							$rows['deliveryOutcome'] = "IUD"; }
							else
							if($rows['deliveryOutcome'] == "4")	
							{
                            $rows['deliveryOutcome'] = "Live Birth and Still Birth"; 											   
						    }	
							
							if($rows['hospitaltype'] == "1")	/*delivery Happened @*/
							{
							$rows['hospitaltype'] = "HSC";}
							else								
							if($rows['hospitaltype'] == "2")	
							{
							$rows['hospitaltype'] = "PHC"; }
							else
							if($rows['hospitaltype'] == "3")	
							{
							$rows['hospitaltype'] = "UG PHC"; }
							else 
							if($rows['hospitaltype'] == "4")	
							{
                            $rows['hospitaltype'] = "GH"; 											   
						    }
                            else
	                        if($rows['hospitaltype'] == "5")	
							{
                            $rows['hospitaltype'] = "MCH"; 											   
						    }	
                            else
							if($rows['hospitaltype'] == "6")	
							{
                            $rows['hospitaltype'] = "Private Hospital"; 											   
						    }	
							else
							if($rows['hospitaltype'] == "7")	
							{
                            $rows['hospitaltype'] = "PNH"; 											   
						    }	
                            if($rows['hospitaltype'] == "8")	
							{
                            $rows['hospitaltype'] = "Home"; 			
						    }

	    $ppcQry = "SELECT ppcMethod,picmeNo From postnatalvisit";		/*Fetching ppcMethod From postnatalvisit*/		 
	    $ppcRes =  mysqli_query($conn,$ppcQry);
        if($ppcRes) {
         while($rowp = mysqli_fetch_array($ppcRes)) 
		 {
		if($rows['picmeno']==$rowp['picmeNo']) {
			if($rowp['ppcMethod'] == "1")	
							{
							$rowp['ppcMethod'] = "Can't decide now";}
							else								
							    if($rowp['ppcMethod'] == "2")	
							    {
								$rowp['ppcMethod'] = "None"; }
								 else
							    	 if($rowp['ppcMethod'] == "3")	
							         {
									 $rowp['ppcMethod'] = "Condom"; }
									   else 
										   if($rowp['ppcMethod'] == "4")	
										   {
                                           $rowp['ppcMethod'] = "Male sterilization"; 											   
						                   }
                                           else
	                                       if($rowp['ppcMethod'] == "5")	
										   {
                                           $rowp['ppcMethod'] = "IUCD-PP"; 											   
						                   }	
                                          else
											if($rowp['ppcMethod'] == "6")	
										   {
                                           $rowp['ppcMethod'] = "PP-PS"; 											   
						                   }	
										   else
										   if($rowp['ppcMethod'] == "7")	
										   {
                                           $rowp['ppcMethod'] = "Inj antara and Tab chaya"; 	
                                           								   
		 }		
		 if($rowp['ppcMethod'] == "8")	
										   {
                                           $rowp['ppcMethod'] = "Any Other Specify"; 	
                                           								   
		 }		
if($rowp['ppcMethod'] == "9")	
										   {
                                           $rowp['ppcMethod'] = "Any Traditional Methods"; 	
                                           								   
		 }				 		
		$rows['ppcMethod'] = $rowp['ppcMethod'];}}}  
	
		$wild_srch = "";				     
	    if(strlen($search_text_input) > 0 )
	    {	 
       
       $wild_srch = $wild_cnt++. "||".  /* "*" - separates serails no */
	   $rows['picmeno']."||".
					       date('d-m-Y', strtotime($rows['anRegDate']))."||".
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
					       $rows['ppcMethod']; 
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;  
//print_r($wild_srch); 		
	//	print_r($ppcMethod); exit;
	   }
}
    
	 
	//  if($wild_cnt == "181"){
	//  print_r($wild_cnt);
	 // print_r($rows['picmeno']); exit;}
	 //  $wild_cnt++;
	
	if($search_flag || strlen($search_text_input) == 0 )
	{
	//	print_r($rows['VillageName']); exit;		
	  $developer_records[] = $rows;	
	//   print_r($rows['BlockName']);
	//		 print_r($rows['PhcName']);
	//		 print_r($rows['HscName']);
	//		 print_r($rows['PanchayatName']);
	//		 print_r($rows['VillageName']); exit;
}}	
}}}
 //print_r("$ppcMethod"); print_r($ppcMethod); exit;
	$filename = "Delivered_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Delivered List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No", "RCHID (PICME) No.","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name","Mobile No", "Address","Delivery Date", "Delivery Hospital Type","Delivery Type","Outcome","Family Welfare Method");
			
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
						    $record['residentType'],
                            $record['motheraadhaarname'],
					        $record['MotherAge'],
					        $record['husbandaadhaarname'],
			                $record['mothermobno'],
						    $record['address'],
						    date('d-m-Y', strtotime($record['deliverydate'])),
					        $record['hospitaltype'],									   
					        $record['deliverytype'],
							$record['deliveryOutcome'],
					        $record['ppcMethod']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
	   
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 


