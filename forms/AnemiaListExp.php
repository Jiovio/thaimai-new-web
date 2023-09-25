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

    $listQry = "SELECT av.ancPeriod, av.Hb, av.fastingSugar, av.bloodTransfusion, av.noOfIVDoses, av.picmeno,av.id, av.motherWeight, av.bpSys, av.bpDia, av.pregnancyWeek,av.urineAlbuminPresent,av.noCalcium, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno)
				  AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno) AND av.Hb < 10";  		
				   	
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
$ar_picme = $rows['picmeno'];
				
			                 $rows['Hb1'] = "";
				
						     $rows['Hb2'] = "";	
							 $rows['ISD1'] = "";
                             $rows['ISD2'] = "";	
                             $rows['ISD3'] = "";
                             $rows['ISD4'] = "";
                             $rows['ISDT1'] = "";		
                             $rows['ISDT2'] = "";									
					       
					        $rows['Hb3'] = "";
						    $rows['FST'] = "";
						    $rows['BT1'] = "";
						   
						    $rows['Hb4'] = ""; 
						    $rows['BT2'] = "";
							
							$row_av['Hb1'] = "";
							$HB_Ind = "N";
							
							
				$AVQry = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND av.pregnancyWeek < 20 ";
								
				$AVRes =  mysqli_query($conn,$AVQry);
                if($AVRes) {	
                while($row_av = mysqli_fetch_array($AVRes)) {
					
																			
					
					$rows['pregnancyWeek'] = $row_av['pregnancyWeek'];
					$rows['Hb1'] = $row_av['Hb'];
					
				}}
				
				$AVQry2 = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND 
				           av.pregnancyWeek > 19 AND av.pregnancyWeek <= 27";
								
				$AVRes2 =  mysqli_query($conn,$AVQry2);
                if($AVRes2) {	
                while($row_av2 = mysqli_fetch_array($AVRes2)) {
				//	$rows['pregnancyWeek'] = $row_av['pregnancyWeek'];
					$rows['Hb2'] = $row_av2['Hb'];
					if($row_av2['bloodTransfusion'] == "3")
						{					
                    if(strlen($rows['ISD1']) == 0 OR strlen($rows['ISDT2']) > 0)
                    {	
                
						$rows['ISD1'] = $row_av2['noOfIVDoses'];
					}	
					else
					if(strlen($rows['ISD2']) == 0 OR strlen($rows['ISDT2']) > 0)	
					{	
                        $rows['ISD2'] = $row_av2['noOfIVDoses'];
					}
					else
                    if(strlen($rows['ISD3']) == 0 OR strlen($rows['ISDT2']) > 0)	 
					{	
					 $rows['ISD3'] = $row_av2['noOfIVDoses'];
					}
					else
					if(strlen($rows['ISD4']) == 0 OR strlen($rows['ISDT2']) > 0)	 
					{	
                        $rows['ISD4'] = $row_av2['noOfIVDoses'];
					}
                    else
					if(strlen($rows['ISDT1']) == 0 OR strlen($rows['ISDT2']) > 0)	 
                    {						
                        $rows['ISDT1'] = $row_av2['noOfIVDoses'];	
                    }
                    else
					if(strlen($rows['ISDT2']) == 0 OR strlen($rows['ISDT2']) > 0)
                    {						
                        $rows['ISDT2'] = $row_av2['noOfIVDoses'];	
					}}}}
					
				
				$AVQry3 = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND 
				           av.pregnancyWeek > 27 AND av.pregnancyWeek <= 34";
								
				$AVRes3 =  mysqli_query($conn,$AVQry3);
                if($AVRes3) {	
                while($row_av3 = mysqli_fetch_array($AVRes3)) {	
					
						
					$rows['Hb3'] = $row_av3['Hb'] ;
				    $rows['FST'] = $row_av3['fastingSugar'];
				    $rows['BT1'] = $row_av3['bloodTransfusion'];
	                  if($row_av3['bloodTransfusion'] == "1")
						{	
							$rows['BT1'] = "Normal";
						}
                        else
						if($row_av3['bloodTransfusion'] == "2")	
						{	
							$rows['BT1'] = "Blood Transfussion";
						}	
						 else
						if($row_av3['bloodTransfusion'] == "3")	
						{	
							$rows['BT1'] = "Iron Sucrose";
						}	
				}}
					
					$AVQry4 = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND 
				           av.pregnancyWeek > 34";
								
				$AVRes4 =  mysqli_query($conn,$AVQry4);
                if($AVRes4) {	
                while($row_av4 = mysqli_fetch_array($AVRes4)) {	
					
					$rows['Hb4'] = $row_av4['Hb'] ;
				    $rows['BT2'] = $row_av4['bloodTransfusion'];	
						if($row_av4['bloodTransfusion'] == "1")
						{	
							$rows['BT2'] = "Normal";
						}
                        else
						if($row_av4['bloodTransfusion'] == "2")	
						{	
							$rows['BT2'] = "Blood Transfussion";
						}	
						 else
						if($row_av4['bloodTransfusion'] == "3")	
						{	
							$rows['BT2'] = "Iron Sucrose";
						}	
					
				}}
						
				$HscQry = "SELECT * From hscmaster";				 
				$HscRes =  mysqli_query($conn,$HscQry);
                if($HscRes) {
                  while($rowh = mysqli_fetch_array($HscRes)) {
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
							
							if($rows['residenttype'] == "1")
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
    
	   $wild_srch =  $wild_cnt++."||".  
	   						$rows['picmeno']."||".
					        $rows['anRegDate']."||".
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
					        $rows['lmpdate']."||".
                            $rows['edddate']."||".
							$rows['motherWeight']."||".
							$rows['Hb1']."||".
						   
						    $rows['Hb2']."||".	
							 $rows['ISD1']."||".  
                             $rows['ISD2']."||". 	
                             $rows['ISD3']."||". 
                             $rows['ISD4']."||".  
                             $rows['ISDT1']."||".  		
                             $rows['ISDT2']."||".							
					       
					        $rows['Hb3']."||".  
						    $rows['FST']."||".
						    $rows['BT1']."||".  
						   
						    $rows['Hb4']."||".
						    $rows['BT2'];		
                    
	   
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
	$filename = "Anemia_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("Anemia List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No","RCHID (PICME) No.","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No", "Obstetric score","LMP","EDD","Weight Gain","HB (Below 20 Weeks)", "HB (Between 20 - 27 Weeks)","Iron Sucrose Dose 1","Iron Sucrose Dose 2","Iron Sucrose Dose 3","Iron Sucrose Dose 4","Iron Sucrose Top up(1)","Iron Sucrose Top up(2)","HB (Between 28 - 34 Weeks)","FST (Between 28 - 34 Weeks)","Blood Transfusion (Between 28 - 34 Weeks)","HB (After 34 Weeks)","Blood Transfusion (After 34 Weeks)");
			
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
		$record['Hb1'],  	
						   
						      $record['Hb2'], 	
							  $record['ISD1'],  
                              $record['ISD2'],  	
                              $record['ISD3'],  
                              $record['ISD4'],  
                              $record['ISDT1'],  		
                              $record['ISDT2'],  									
					       
					         $record['Hb3'],  
						     $record['FST'],  
						     $record['BT1'],  
						   
						     $record['Hb4'],  
						     $record['BT2']  
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	  }
		echo $excelData;
	}
	
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>