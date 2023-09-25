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


    $listQry = "SELECT dd.picmeno,ar.residentType, ar.obstetricCode, dd.deliveryCompilcation, dd.infantId, dd.deliverydate,dd.childGender, dd.deliverytime, dd.deliverydistrict, dd.deliverydate, dd.hospitaltype, dd.deliverytype,dd.deliveryOutcome, dd.id, ec.address, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.MotherAge, ec.motheraadhaarname,dd.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno
             	  FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno JOIN anregistration ar on dd.picmeno = ar.picmeno
                  WHERE dd.status!=0 AND NOT EXISTS (SELECT pv.picmeNo FROM postnatalvisit pv WHERE pv.picmeNo = dd.picmeno) AND dd.deliveryCompilcation = 7";   		
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
							
							if($rows['childGender'] == "1")	/* Child Gender */
							{
							$rows['childGender'] = "Male";}
							else								
							    if($rows['childGender'] == "2")	
							    {
								$rows['childGender'] = "Female"; }
			  
	                        $rows['infage'] = "0";
						    $rows['Deathreason'] = "Delivery Complication";
							
		$wild_srch = "";				     
	    if(strlen($search_text_input) > 0 )
	    {	 
       
       $wild_srch = $wild_cnt++."||".                        /* "*" - separates serails no */
	   $rows['picmeno']."||".
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
                           $row['obstetricCode']."||".
                           $row['infantId']."||".
						   date('d-m-Y', strtotime($row['deliverydate']))."||".
						   $row['childGender']."||".
						   date('H:i:s',strtotime($row['deliverytime']))."||".
						   $row['infage']."||".
						   $row['deliverydistrict']."||".
					       $row['hospitaltype']."||".
					       $row['Deathreason']."||"; 
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true;  
	   }
}
    
	
	   
   //  $wild_cnt++;
	if($search_flag || strlen($search_text_input) == 0 )
	{
		
	  $developer_records[] = $rows;	
	
}}	
}}}
 
	$filename = "Infant_Death_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Infant Death List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No", "RCHID (PICME) No.","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Mother Name","Age","Husband Name","Mobile No", "Obstetric Score","Infant RCH ID","Infant Death Date","Gender","Infant Death Time","Infant Age @ Death","Infant Death District","Infant Death Place","Reason for Death");
			
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
                            $record['motheraadhaarname'],
					        $record['MotherAge'],
					        $record['husbandaadhaarname'],
			                $record['mothermobno'],
						   $record['obstetricCode'],
                           $record['infantId'],
						   date('d-m-Y', strtotime($record['deliverydate'])),
						   $record['childGender'],
						   date('H:i:s',strtotime($record['deliverytime'])),
						   $record['infage'],
						   $record['deliverydistrict'],
					       $record['hospitaltype'],
					       $record['Deathreason'] 
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
	   
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 


