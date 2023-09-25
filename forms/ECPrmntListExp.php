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

    $listQry = "SELECT pv.picmeNo,pv.id, pv.ppcMethod, ec.HscId, ar.anRegDate, pv.pncPeriod, ar.obstetricCode, ar.livingChildren, ec.VillageId, ec.PanchayatId, ar.MotherAge, ec.motheraadhaarname,pv.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno FROM postnatalvisit pv JOIN ecregister ec on ec.picmeNo=pv.picmeNo JOIN anregistration ar on ar.picmeno=pv.picmeNo
        WHERE pv.status!=0 AND (pv.ppcMethod = 4 OR pv.ppcMethod = 6 OR pv.ppcMethod = 5) AND pv.pncPeriod = (SELECT max(pv1.pncPeriod) From postnatalvisit pv1 where pv1.picmeNo = pv.picmeNo)";
				  	
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
        $ppcQry = "SELECT ppcMethod,picmeNo From postnatalvisit";		/*Fetching ppcMethod From postnatalvisit*/		 
	    $ppcRes =  mysqli_query($conn,$ppcQry);
        if($ppcRes) {
         while($rowp = mysqli_fetch_array($ppcRes)) 
		 {
		if($rows['picmeNo']==$rowp['picmeNo']) 
			 {
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
       
       $wild_srch = $wild_cnt++."||".  /* "*" - separates serails no */
	   $rows['picmeNo']."||".
					       date('d-m-Y', strtotime($rows['anRegDate']))."||".
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
						   $rows['livingChildren']."||".
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
		
	}
	//   print_r($rows['BlockName']);
	//		 print_r($rows['PhcName']);
	//		 print_r($rows['HscName']);
	//		 print_r($rows['PanchayatName']);
	//		 print_r($rows['VillageName']); exit;
}}	
}}//}
 //print_r("$ppcMethod"); print_r($ppcMethod); exit;
	$filename = "ECs_Following_Permanent_FW_Method_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("ECs Following Permanent FW Method List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No", "RCHID (PICME) No.","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Mother Name","Age","Husband Name","Mobile No", "Temporary Family Welfare Method");
			
		$excelData = implode("\t", array_values($h)) . "\n";
		$show_coloumn = true;	
		}
		
		$lineData = array(
		$sno++,
						    $record['picmeNo'],
					        date('d-m-Y', strtotime($record['anRegDate'])),
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
						    $record['livingChildren'],
					        $record['ppcMethod']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
	   
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 


