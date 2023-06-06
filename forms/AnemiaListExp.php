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
    
	$pre_picme = "";
	$ar_picme = "";
	$pre_av_picme = "";
    $prev_picmeno = ""; 

    $listQry = "SELECT ar.gravida,ar.para,ar.livingChildren,ar.abortion,ar.childDeath,ar.bpSys,ar.bpDia,ar.motherWeight,ar.residenttype, ar.updatedat, ar.createdat,ar.picmeno,ar.residentType, ec.motherdob, ar.id, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, ec.motheraadhaarname,ar.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM anregistration ar JOIN ecregister ec on ec.picmeNo=ar.picmeno JOIN medicalhistory mh on mh.picmeno = ar.picmeno
	            WHERE ar.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ar.picmeno)";
				
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
	//print_r("Going 1"); 
	
	 if($ExeQuery) {
                while($row = mysqli_fetch_array($ExeQuery)) {
				//	print_r("Going 2"); 
				$search_flag = false; 	
				$ar_picme = $row['picmeno'];
				
			                 $row['Hb1'] = "";
				
						     $row['Hb2'] = "";	
							 $row['ISD1'] = "";
                             $row['ISD2'] = "";	
                             $row['ISD3'] = "";
                             $row['ISD4'] = "";
                             $row['ISDT1'] = "";		
                             $row['ISDT2'] = "";									
					       
					        $row['Hb3'] = "";
						    $row['FST'] = "";
						    $row['BT1'] = "";
						   
						    $row['Hb4'] = ""; 
						    $row['BT2'] = "";
							
							$row_av['Hb1'] = "";
							$HB_Ind = "N";
							$HB1_Ind = "";
							$HB2_Ind = "";
							$HB3_Ind = "";
							$HB4_Ind = "";
					
							
							
				$AVQry = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno";
								
				$AVRes =  mysqli_query($conn,$AVQry);
                if($AVRes) {	
                while($row_av = mysqli_fetch_array($AVRes)) {
					
					if($row_av['pregnancyWeek'] < "20") 
					{	
					$row['pregnancyWeek'] = $row_av['pregnancyWeek'];
					$row['Hb1'] = $row_av['Hb'];
					}
					else
					{
					if($row_av['pregnancyWeek'] > "19" AND $row_av['pregnancyWeek'] <= "27") 	
					{
						$row['Hb2'] = $row_av['Hb'];
						$HB2_Ind = "N";	
						
						if($row_av['bloodTransfusion'] == "3")
						{	
										
                    if(strlen($row['ISD1']) == 0 OR strlen($row['ISDT2']) > 0)
                    {	
                
						$row['ISD1'] = $row_av['noOfIVDoses'];
					}	
					else
					if(strlen($row['ISD2']) == 0 OR strlen($row['ISDT2']) > 0)	
					{	
                        $row['ISD2'] = $row_av['noOfIVDoses'];
					}
					else
                    if(strlen($row['ISD3']) == 0 OR strlen($row['ISDT2']) > 0)	 
					{	
					 $row['ISD3'] = $row_av['noOfIVDoses'];
					}
					else
					if(strlen($row['ISD4']) == 0 OR strlen($row['ISDT2']) > 0)	 
					{	
                        $row['ISD4'] = $row_av['noOfIVDoses'];
					}
                    else
					if(strlen($row['ISDT1']) == 0 OR strlen($row['ISDT2']) > 0)	 
                    {						
                        $row['ISDT1'] = $row_av['noOfIVDoses'];	
                    }
                    else
					if(strlen($row['ISDT2']) == 0 OR strlen($row['ISDT2']) > 0)
                    {						
                        $row['ISDT2'] = $row_av['noOfIVDoses'];	
					}}}}
					
					if($row_av['pregnancyWeek'] > "27" AND $row_av['pregnancyWeek'] <= "34")
					{
						
					$row['Hb3'] = $row_av['Hb'] ;
				    $row['FST'] = $row_av['fastingSugar'];
				    $row['BT1'] = $row_av['bloodTransfusion'];	
					if($row_av['bloodTransfusion'] == "1")
						{	
							$row['BT1'] = "Normal";
						}
                        else
						if($row_av['bloodTransfusion'] == "2")	
						{	
							$row['BT1'] = "Blood Transfussion";
						}	
						 else
						if($row_av['bloodTransfusion'] == "3")	
						{	
							$row['BT1'] = "Iron Sucrose";
						}
					$HB3_Ind = "N";	
					
					}
					else
					if($row_av['pregnancyWeek'] > "34")
					{
						
					$row['Hb4'] = $row_av['Hb'] ;
				    $row['BT2'] = $row_av['bloodTransfusion'];
                    if($row_av['bloodTransfusion'] == "1")
						{	
							$row['BT2'] = "Normal";
						}
                        else
						if($row_av['bloodTransfusion'] == "2")	
						{	
							$row['BT2'] = "Blood Transfussion";
						}	
						 else
						if($row_av['bloodTransfusion'] == "3")	
						{	
							$row['BT2'] = "Iron Sucrose";
						}						
					$HB4_Ind = "N";	
					
					}
											
				$HscQry = "SELECT * From hscmaster";				 
				$HscRes =  mysqli_query($conn,$HscQry);
                if($HscRes) {
                  while($rowh = mysqli_fetch_array($HscRes)) {
				     if($row['HscId']==$rowh['HscId'] AND
					    $row['BlockId']==$rowh['BlockId'] AND
					    $row['PhcId']==$rowh['PhcId'] AND
						$row['VillageId']==$rowh['VillageId'] AND
						$row['PanchayatId']==$rowh['PanchayatId'])
						{
							
							if($row['residenttype'] == "1")
							{
							 $row['residenttype'] = "RESIDENT";
							}
							
							if($row['residenttype'] == "2")	
							{
							 $row['residenttype'] = "VISITOR";
							}	
							
				  /*}}
				   }*/
                        
                    /*	if($row['Transfusion'] == "1")
						{	
							$row['Transfusion'] = "Normal";
						}
                        else
						if($row['Transfusion'] == "2")	
						{	
							$row['Transfusion'] = "Blood Transfussion";
						}	
						 else
						if($row['Transfusion'] == "3")	
						{	
							$row['Transfusion'] = "Iron Sucrose";
						}	*/   
					//	print_r("Going outside else strlen".strlen($pre_picme).$pre_picme."*"); 
						
			if(strlen($pre_picme) > 0 AND $pre_picme != $row['picmeno']) /* Here is for else */
			{
			
				$pre_picme = "";
				$pre_picme = $row['picmeno'];
						    
				
					if(strlen($prev_Hb4) != 0) 
					 {	
				       if($prev_Hb4 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     }
					else
					  if(strlen($prev_Hb3) != 0) 
					 {	
				     if($prev_Hb3 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     }
					 else
						 if(strlen($prev_Hb2) != 0)
					 {	
				      if($prev_Hb2 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     }
					 else
						 if(strlen($prev_Hb1) != 0)
					 {	
				     if($prev_Hb1 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     } /*over*/
					 
				//	 print_r($row['picmeno']."   ");
					 
					 if($HB_Ind == "Y") 
					 { 
			         //	 print_r("Diff".$prev_picmeno); 
				        $row_pre['picmeno'] = $prev_picmeno;
					    $row_pre['picmeRegDate'] = $prev_picmeRegDate;  
				        $row_pre['BlockName'] = $prev_BlockName; 
                        $row_pre['PhcName'] = $prev_PhcName;  
                        $row_pre['HscName'] = $prev_HscName;
			            $row_pre['PanchayatName'] = $prev_PanchayatName;  
                        $row_pre['VillageName'] = $prev_VillageName;  
						   
						$row_pre['residenttype'] = $prev_residenttype; 
						   
                        $row_pre['motheraadhaarname'] = $prev_motheraadhaarname;
					    $row_pre['MotherAge'] = $prev_MotherAge; 
					    $row_pre['husbandaadhaarname'] = $prev_husbandaadhaarname;  
			            $row_pre['mothermobno'] = $prev_mothermobno;   
					    $row_pre['obstetricCode'] = $prev_obstetricCode;  
					    $row_pre['lmpdate'] = $prev_lmpdate;
                        $row_pre['edddate'] = $prev_edddate;   
						$row_pre['motherWeight'] = $prev_motherWeight;  
						$row_pre['Hb1'] = $prev_Hb1;  	
						   
						$row_pre['Hb2'] = $prev_Hb2;	
						$row_pre['ISD1'] = $prev_ISD1; 
                        $row_pre['ISD2'] = $prev_ISD2;	
                        $row_pre['ISD3'] = $prev_ISD3;
                        $row_pre['ISD4'] = $prev_ISD4;
                        $row_pre['ISDT1'] = $prev_ISDT1; 		
                        $row_pre['ISDT2'] =	$prev_ISDT2;  						
					       
					    $row_pre['Hb3'] = $prev_Hb3;   
						$row_pre['FST'] = $prev_FST;
						$row_pre['BT1'] = $prev_BT1;  
						   
						$row_pre['Hb4'] = $prev_Hb4;
						$row_pre['BT2'] = $prev_BT2; 			
				 
                        $wild_srch = "";   
	                    if(strlen($search_text_input) > 0 )
	                    {	 
                            $wild_srch =  $wild_cnt++."||".  
	   						$row_pre['picmeno']."||".
					        $row_pre['picmeRegDate']."||".
				            $row_pre['BlockName']."||".  
                            $row_pre['PhcName']."||".  
                            $row_pre['HscName']."||".
			                $row_pre['PanchayatName']."||". 
                            $row_pre['VillageName']."||".
						   
						    $row_pre['residenttype']."||".
						   
                            $row_pre['motheraadhaarname']."||".
					        $row_pre['MotherAge']."||". 
					        $row_pre['husbandaadhaarname']."||".
			                $row_pre['mothermobno']."||".  
					        $row_pre['obstetricCode']."||".
					        $row_pre['lmpdate']."||".
                            $row_pre['edddate']."||".
							$row_pre['motherWeight']."||".
							$row_pre['Hb1']."||".
						   
						    $row_pre['Hb2']."||".	
							 $row_pre['ISD1']."||".  
                             $row_pre['ISD2']."||". 	
                             $row_pre['ISD3']."||". 
                             $row_pre['ISD4']."||".  
                             $row_pre['ISDT1']."||".  		
                             $row_pre['ISDT2']."||".							
					       
					        $row_pre['Hb3']."||".  
						    $row_pre['FST']."||".
						    $row_pre['BT1']."||".  
						   
						    $row_pre['Hb4']."||".
						    $row_pre['BT2'];		
                    
                       //     print_r("org".$wild_srch);					
	   
	                        if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	                        {
		                     $search_flag = true;   
	                        }
                            } /* Wild Card Search */
							
							 
							 
							 
							if($search_flag || strlen($search_text_input) == 0 ) /* Search Flag True */
							
	                        {
							//	print_r($row_pre); 
	                         $developer_records[] = $row_pre;
							 
						//	 print_r($row['picmeno']."   ");
							 } /* Search Flag True */
							 
	                         
					        $prev_picmeRegDate =  "";
				            $prev_BlockName =  "";
                            $prev_PhcName =  "";  
                            $prev_HscName =  ""; 
			                $prev_PanchayatName =  "";  
                            $prev_VillageName =  ""; 
						   
						    $prev_residenttype =  "";
						   
                            $prev_motheraadhaarname =  ""; 
					        $prev_MotherAge =  "";  
					        $prev_husbandaadhaarname =  "";
			                $prev_mothermobno =  "";
					        $prev_obstetricCode =  "";  									   
					        $prev_lmpdate =  "";  
                            $prev_edddate =  "";   
						   
						    $prev_motherWeight =  ""; 	
						   
						     $prev_Hb1 =  "";  	
						   
						     $prev_Hb2 =  "";
							 $prev_ISD1 =  "";
                             $prev_ISD2 =  ""; 	
                             $prev_ISD3 =  "";  
                             $prev_ISD4 =  ""; 
                             $prev_ISDT1 =  "";		
                             $prev_ISDT2 =  "";  									
					       
					        $prev_Hb3 =  "";  
						    $prev_FST =  "";
						    $prev_BT1 =  ""; 
						   
						    $prev_Hb4 =  "";  
						    $prev_BT2 =  "";
						   
						   $pre_picme = $row['picmeno'];
						   $prev_picmeno = $row['picmeno'];  
					        $prev_picmeRegDate = date('d-m-Y', strtotime($row['picmeRegDate']));  
				            $prev_BlockName = $rowh['BlockName'];  
                            $prev_PhcName = $rowh['PhcName'];  
                            $prev_HscName = $rowh['HscName'];  
			                $prev_PanchayatName = $rowh['PanchayatName'];  
                            $prev_VillageName = $rowh['VillageName'];  
						   
						    $prev_residenttype = $row['residenttype'];  
						   
                            $prev_motheraadhaarname = $row['motheraadhaarname'];  
					        $prev_MotherAge = $row['MotherAge'];  
					        $prev_husbandaadhaarname = $row['husbandaadhaarname'];  
			                $prev_mothermobno = $row['mothermobno'];  
					        $prev_obstetricCode = $row['obstetricCode'];  									   
					        $prev_lmpdate = date('d-m-Y', strtotime($row['lmpdate']));  
                            $prev_edddate = date('d-m-Y', strtotime($row['edddate']));   
						   
						    $prev_motherWeight = $row['motherWeight'];  	
						   
						     $prev_Hb1 = $row['Hb1'];  	
						   
						     $prev_Hb2 = $row['Hb2'];  	
							 $prev_ISD1 = $row['ISD1'];  
                             $prev_ISD2 = $row['ISD2'];  	
                             $prev_ISD3 = $row['ISD3'];  
                             $prev_ISD4 = $row['ISD4'];  
                             $prev_ISDT1 = $row['ISDT1'];  		
                             $prev_ISDT2 = $row['ISDT2'];  									
					       
					        $prev_Hb3 = $row['Hb3'];  
						    $prev_FST = $row['FST'];  
						    $prev_BT1 = $row['BT1'];  
						   
						    $prev_Hb4 = $row['Hb4'];  
						    $prev_BT2 = $row['BT2'];  
					
                            
							 
					 } /* Hb Ind over */
	 
					 
						} /* if over */
						else
													{
					//	 print_r("Same".$row['picmeno']); 
							$pre_picme = $row['picmeno'];
							 
						    $prev_picmeno = $row['picmeno'];  
					        $prev_picmeRegDate = date('d-m-Y', strtotime($row['picmeRegDate']));  
				            $prev_BlockName = $rowh['BlockName'];  
                            $prev_PhcName = $rowh['PhcName'];  
                            $prev_HscName = $rowh['HscName'];  
			                $prev_PanchayatName = $rowh['PanchayatName'];  
                            $prev_VillageName = $rowh['VillageName'];  
						   
						    $prev_residenttype = $row['residenttype'];  
						   
                            $prev_motheraadhaarname = $row['motheraadhaarname'];  
					        $prev_MotherAge = $row['MotherAge'];  
					        $prev_husbandaadhaarname = $row['husbandaadhaarname'];  
			                $prev_mothermobno = $row['mothermobno'];  
					        $prev_obstetricCode = $row['obstetricCode'];  									   
					        $prev_lmpdate = date('d-m-Y', strtotime($row['lmpdate']));  
                            $prev_edddate = date('d-m-Y', strtotime($row['edddate']));   
						   
						    $prev_motherWeight = $row['motherWeight'];  	
						   
						     $prev_Hb1 = $row['Hb1'];  	
						   
						     $prev_Hb2 = $row['Hb2'];  	
							 $prev_ISD1 = $row['ISD1'];  
                             $prev_ISD2 = $row['ISD2'];  	
                             $prev_ISD3 = $row['ISD3'];  
                             $prev_ISD4 = $row['ISD4'];  
                             $prev_ISDT1 = $row['ISDT1'];  		
                             $prev_ISDT2 = $row['ISDT2'];  									
					       
					        $prev_Hb3 = $row['Hb3'];  
						    $prev_FST = $row['FST'];  
						    $prev_BT1 = $row['BT1'];  
						   
						    $prev_Hb4 = $row['Hb4'];  
						    $prev_BT2 = $row['BT2'];  
						}
				}}}}	//} /* $pre_picme */
				}}} /*Hsc*/
				
				
				if(strlen($prev_Hb4) != 0) /* For Last REcord */
					 {	
				       if($prev_Hb4 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     }
					else
					  if(strlen($prev_Hb3) != 0) 
					 {	
				     if($prev_Hb3 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     }
					 else
						 if(strlen($prev_Hb2) != 0)
					 {	
				      if($prev_Hb2 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     }
					 else
						 if(strlen($prev_Hb1) != 0)
					 {	
				     if($prev_Hb1 < "10")
					   {
                       $HB_Ind = "Y";
					   }
				     } /*over*/
					 
				//	 print_r($row['picmeno']."   ");
					 
					 if($HB_Ind == "Y") 
					 { 
			         //	 print_r("Diff".$prev_picmeno); 
				        $row_pre['picmeno'] = $prev_picmeno;
					    $row_pre['picmeRegDate'] = $prev_picmeRegDate;  
				        $row_pre['BlockName'] = $prev_BlockName; 
                        $row_pre['PhcName'] = $prev_PhcName;  
                        $row_pre['HscName'] = $prev_HscName;
			            $row_pre['PanchayatName'] = $prev_PanchayatName;  
                        $row_pre['VillageName'] = $prev_VillageName;  
						   
						$row_pre['residenttype'] = $prev_residenttype; 
						   
                        $row_pre['motheraadhaarname'] = $prev_motheraadhaarname;
					    $row_pre['MotherAge'] = $prev_MotherAge; 
					    $row_pre['husbandaadhaarname'] = $prev_husbandaadhaarname;  
			            $row_pre['mothermobno'] = $prev_mothermobno;   
					    $row_pre['obstetricCode'] = $prev_obstetricCode;  
					    $row_pre['lmpdate'] = $prev_lmpdate;
                        $row_pre['edddate'] = $prev_edddate;   
						$row_pre['motherWeight'] = $prev_motherWeight;  
						$row_pre['Hb1'] = $prev_Hb1;  	
						   
						$row_pre['Hb2'] = $prev_Hb2;	
						$row_pre['ISD1'] = $prev_ISD1; 
                        $row_pre['ISD2'] = $prev_ISD2;	
                        $row_pre['ISD3'] = $prev_ISD3;
                        $row_pre['ISD4'] = $prev_ISD4;
                        $row_pre['ISDT1'] = $prev_ISDT1; 		
                        $row_pre['ISDT2'] =	$prev_ISDT2;  						
					       
					    $row_pre['Hb3'] = $prev_Hb3;   
						$row_pre['FST'] = $prev_FST;
						$row_pre['BT1'] = $prev_BT1;  
						   
						$row_pre['Hb4'] = $prev_Hb4;
						$row_pre['BT2'] = $prev_BT2; 			
				 
                        $wild_srch = "";   
	                    if(strlen($search_text_input) > 0 )
	                    {	 
                            $wild_srch =  $wild_cnt++."||".  
	   						$row_pre['picmeno']."||".
					        $row_pre['picmeRegDate']."||".
				            $row_pre['BlockName']."||".  
                            $row_pre['PhcName']."||".  
                            $row_pre['HscName']."||".
			                $row_pre['PanchayatName']."||". 
                            $row_pre['VillageName']."||".
						   
						    $row_pre['residenttype']."||".
						   
                            $row_pre['motheraadhaarname']."||".
					        $row_pre['MotherAge']."||". 
					        $row_pre['husbandaadhaarname']."||".
			                $row_pre['mothermobno']."||".  
					        $row_pre['obstetricCode']."||".
					        $row_pre['lmpdate']."||".
                            $row_pre['edddate']."||".
							$row_pre['motherWeight']."||".
							$row_pre['Hb1']."||".
						   
						    $row_pre['Hb2']."||".	
							 $row_pre['ISD1']."||".  
                             $row_pre['ISD2']."||". 	
                             $row_pre['ISD3']."||". 
                             $row_pre['ISD4']."||".  
                             $row_pre['ISDT1']."||".  		
                             $row_pre['ISDT2']."||".							
					       
					        $row_pre['Hb3']."||".  
						    $row_pre['FST']."||".
						    $row_pre['BT1']."||".  
						   
						    $row_pre['Hb4']."||".
						    $row_pre['BT2'];	

                      //      print_r($wild_srch);						
	   
	                        if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	                        {
		                     $search_flag = true;   
	                        }
                            } /* Wild Card Search */
							
							 
							 
							 
							if($search_flag || strlen($search_text_input) == 0 ) /* Search Flag True */
							
	                        {
							//	print_r($row_pre); 
	                         $developer_records[] = $row_pre;
					 }}
							 
							 
						
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
			 
		$h = array("S.No","RCH ID","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No", "Obstetric score","LMP","EDD","Weight Gain","HB (Below 20 Weeks)", "HB (Between 20 - 27 Weeks)","Iron Sucrose Dose 1","Iron Sucrose Dose 2","Iron Sucrose Dose 3","Iron Sucrose Dose 4","Iron Sucrose Top up(1)","Iron Sucrose Top up(2)","HB (Between 28 - 34 Weeks)","FST (Between 28 - 34 Weeks)","Blood Transfusion (Between 28 - 34 Weeks)","HB (After 34 Weeks)","Blood Transfusion (After 34 Weeks)");
			
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
