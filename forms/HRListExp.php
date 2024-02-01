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

//if(isset($search_text_input) > 0 )

    $listQry = "SELECT ar.hrPregnancy,ar.gravida,ar.para,ar.livingChildren,ar.abortion,ar.motherHeight,ar.childDeath,ar.bpSys,ar.bpDia,ar.motherWeight,ar.updatedat, ar.createdat,ar.picmeno,ar.residentType, ec.motherdob, ar.id, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, ec.motheraadhaarname,ar.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno FROM anregistration ar JOIN ecregister ec on ec.picmeNo=ar.picmeno
	             WHERE ar.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ar.picmeno)";		
				   
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
	while( $row = mysqli_fetch_assoc($ExeQuery) ) {
		$High_Risk_Ind = "N";
				$row['refdat'] = "";
				$row['refdat'] = $row['anRegDate'];
				$row['symptomsHighRisk'] = "";
							
				$ar_picme = "";
				$ar_picme = $row['picmeno'];
				
				$row['lmpdate'] = "";
							$row['edddate'] = "";
							$row['hospitalType'] = "";
							$row['hospitalname'] = "";
							
							if($row['residentType'] == "1")
							{
							 $row['residentType'] = "RESIDENT";
							}
							
							if($row['residentType'] == "2")	
							{
							 $row['residentType'] = "VISITOR";
							}	
							
							if($row['gravida'] > "2" OR $row['livingChildren'] > "2" OR $row['abortion'] > "2" OR $row['childDeath'] > "2") 
							{
							$row['symptomsHighRisk'] = "Multiple Pregnancy";	
							}
							 else
							if($row['livingChildren'] > "2" OR $row['abortion'] > "2" OR $row['childDeath'] > "2") 
							{
							$row['symptomsHighRisk'] = "Previous bad obstetric history";	
							}
							else
								if($row['para'] > "2") 
							{
							$row['symptomsHighRisk'] = "Multi Para";	
							}
							else
								if($row['bpSys'] > "130" OR $row['bpDia'] > "90") 
							{
							$row['symptomsHighRisk'] = "PIH/Pre Eclampsia/Eclampsia";	
							} 
							else
								if($row['MotherAge'] > 0 AND $row['MotherAge'] < 18) 
							{
							$row['symptomsHighRisk'] = "Teenage Pregnancy";	
							} 
							else
								if($row['MotherAge'] > "30")
								{
									$row['symptomsHighRisk'] = "Mothers age > 30";	
							} 
							
							else 
							if($row['motherWeight'] > 0 AND $row['motherWeight'] < 40) 
							{
							$row['symptomsHighRisk'] = "Weight below 40 kg";	
							}
							else
							if($row['motherHeight'] < '145') 
							{
							$row['symptomsHighRisk'] = "Height below 145 cm";
							}
							else
							if($row['hrPregnancy'] == '1')
								{
									
									$row['symptomsHighRisk'] = "High Risk Pregnancy";
							} 
							
							$lmp_fmt = "";
							$edd_fmt = "";
							$mh_hspl_ty = "";
							$ar_mh_fnd = "N";
							$row_mh['momVdrlRprResult'] = " ";
											
				$listQry_mh = "SELECT * FROM medicalhistory mh 
	              WHERE mh.status!=0 AND mh.picmeno = $ar_picme";
				$ExeQuery_mh = mysqli_query($conn,$listQry_mh);
			
				  if($ExeQuery_mh) { 
				  while($row_mh = mysqli_fetch_array($ExeQuery_mh)) {
					  
					  
					$row['lmpdate'] = $row_mh['lmpdate'];
							$row['edddate'] = $row_mh['edddate'];
							$row['hospitalType'] = $row_mh['hospitaltype'];
							$row['hospitalname'] = $row_mh['hospitalname'] ;
							
							$lmp_fmt = date('d-m-Y', strtotime($row['lmpdate']));
							$edd_fmt = date('d-m-Y', strtotime($row['edddate']));
					
					
							if($row['hospitalType'] == "1")	
							{
							$row['hospitalType'] = "HSC";}
							else								
							    if($row['hospitalType'] == "2")	
							    {
								$row['hospitalType'] = "PHC"; }
								 else
							    	 if($row['hospitalType'] == "3")	
							         {
									 $row['hospitalType'] = "UG PHC"; }
									   else 
										   if($row['hospitalType'] == "4")	
										   {
                                           $row['hospitalType'] = "GH"; 											   
						                   }
                                           else
	                                       if($row['hospitalType'] == "5")	
										   {
                                           $row['hospitalType'] = "MCH"; 											   
						                   }	
                                           else
											if($row['hospitalType'] == "6")	
										   {
                                           $row['hospitalType'] = "Private Hospital"; 											   
						                   }	
										   else
										   if($row['hospitalType'] == "7")	
										   {
                                           $row['hospitalType'] = "PNH"; 											   
						                   }	
                                           if($row['hospitalType'] == "8")	
										   {
                                           $row['hospitalType'] = "Home"; 											   
						                   }	

                             $mh_hspl_ty = $row['hospitalType'];										   
																				   
							if($row_mh['momhivtestresult'] == "1") 
							{
							
							$row['symptomsHighRisk'] = "HIV affected mother";	
							}
														 else	
                          if($row_mh['hushivtestresult'] == "1") 
							{
							
							$row['symptomsHighRisk'] = "HIV affected husband";	
							}
														 else		
														 if($row_mh['momVdrlRprResult'] == "1") 
							{
							
							$row['symptomsHighRisk'] = "Mom's VDRL Positive";	
							}
							else		
														 if($row_mh['husVdrlRprResult'] == "1") 
							{
							
							$row['symptomsHighRisk'] = "Husband's VDRL Positive";	
							}
														 else
															
							 if($row_mh['momhbresult'] == "1") 
							{
							
							$row['symptomsHighRisk'] = "Hepatitis B surface antigen for mother";	
							}
							else
															
							 if($row_mh['hushbresult'] == "1") 
							{
							
							$row['symptomsHighRisk'] = "Hepatitis B surface antigen for husband";	
							}
														 else
							if($row_mh['totPregnancy'] > "2") 
							{
							$row['symptomsHighRisk'] = "Multiple Pregnancy";	
							}
						/*	else
								
								 if($row_mh['momhbresult'] == "3") 
							{
							$row['symptomsHighRisk'] = "HBsAG test not done for mother";	
							}	
else
								 if($row_mh['hushbresult'] == "3") 
							{
							$row['symptomsHighRisk'] = "HBsAG test not done for husband";	
							}
else
								 if($row_mh['momhivtestresult'] == "3") 
							{
							$row['symptomsHighRisk'] = "HIV test not done for mother";	
							}	
							else
								 if($row_mh['hushivtestresult'] == "3") 
							{
							$row['symptomsHighRisk'] = "HIV test not done for husband";	
							} */

                            if($row_mh['pastillness'] == "101")
                            {
                             $row['symptomsHighRisk'] = "TB";
                            }
                            else	
                            if($row_mh['pastillness'] == "102")
                            {
                             $row['symptomsHighRisk'] = "Diabetes";
                            }		
                             else	
                            if($row_mh['pastillness'] == "103")
                            {
                             $row['symptomsHighRisk'] = "Hypertension";
                            }	
                            else	
                            if($row_mh['pastillness'] == "104")
                            {
                             $row['symptomsHighRisk'] = "Heart Disease";
                            }	
                            else	
                            if($row_mh['pastillness'] == "105")
                            {
                             $row['symptomsHighRisk'] = "Epilepsy";
                            }	
                            else	
                            if($row_mh['pastillness'] == "106")
                            {
                             $row['symptomsHighRisk'] = "RTI / STI";
                            }
                            else	
                            if($row_mh['pastillness'] == "107")
                            {
                             $row['symptomsHighRisk'] = "HIV Positive";
                            }		
                            else	
                            if($row_mh['pastillness'] == "108")
                            {
                             $row['symptomsHighRisk'] = "Asthma";
                            }									
						    else	
                            if($row_mh['pastillness'] == "109")
                            {
                             $row['symptomsHighRisk'] = "Hep B";
                            }	
						/*	else	
                            if($row_mh['pastillness'] == "110")
                            {
                             $row['symptomsHighRisk'] = "Any Other Specify";
                            } */
                            else	
                            if($row_mh['pastillness'] == "111")
                            {
                             $row['symptomsHighRisk'] = "Gestational Diabete";
                            }	
                            else	
                            if($row_mh['pastillness'] == "112")
                            {
                             $row['symptomsHighRisk'] = "Hypothyroidism";
                            }								
											  										  
					  
					 if($row_mh['momVdrlRprResult'] == "1" OR 
					  //   $row_mh['momVdrlRprResult'] == "3" OR 
						 $row_mh['husVdrlRprResult'] == "1" OR 
					//	 $row_mh['husVdrlRprResult'] == "3" OR 
						 $row_mh['hushbresult'] == "1" OR 
				//		 $row_mh['hushbresult'] == "3" OR
						 $row_mh['momhbresult'] == "1" OR 
					//	 $row_mh['momhbresult'] == "3" OR
				         $row_mh['momhivtestresult'] == "1" OR 
					//	 $row_mh['momhivtestresult'] == "3" OR 
						 $row_mh['hushivtestresult'] == "1" OR 
					//	 $row_mh['hushivtestresult'] == "3" OR 
						 $row_mh['totPregnancy'] > "2" OR 
						 $row_mh['momBGtype'] == "5" OR 
						 $row_mh['momBGtype'] == "6" OR 
						 $row_mh['momBGtype'] == "7" OR 
						 $row_mh['momBGtype'] == "8" OR 
						 $row_mh['momBGtype'] == "10" OR 
						 $row_mh['pastillness'] != "100")
				{
					
					$High_Risk_Ind = "Y";
				}
							
				  }}		
				
								
				$row['pregnancyWeek'] = "";
				$AR_High_Risk_Ind = "N";
				
				$listQry_av = "SELECT * FROM antenatalvisit av 
	              WHERE av.status!=0 AND av.picmeno = $ar_picme AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)";
				  $ExeQuery_av = mysqli_query($conn,$listQry_av);
				  if($ExeQuery_av) { 
				  while($row_av = mysqli_fetch_array($ExeQuery_av)) {
					  $row['pregnancyWeek'] = $row_av['pregnancyWeek'];
					  if($row_av['symptomsHighRisk'] != 0)
							{
							$row['symptomsHighRisk'] = $row_av['symptomsHighRisk'];
							}
						/*	else
							{
							$row['symptomsHighRisk'] = "Others";
							}	*/
							 if($row_av['motherWeight'] > "0" AND $row_av['motherWeight'] < '40') 
							{
							$row['symptomsHighRisk'] = "Weight below 40 kg";
							}
							else
							if($row_av['motherWeight'] > 0 AND $row_av['motherWeight'] < 40) 
							{
							$row['symptomsHighRisk'] = "Weight below 40 kg";	
							}
							else
							if($row_av['Hb'] > '0' AND $row_av['Hb'] < '10') 
							{
							$row['symptomsHighRisk'] = "Severe Anaemia";
							}
							
							if(isset($row_av['referralDate']) > 0)
							 {
							 $row['refdat'] = $row_av['referralDate'];
							 
							 }
							 
							if(isset($row_av['referralPlace']) > 0)
							 {
							 $row['hospitalname'] = $row_av['referralPlace'];
							 }
							 else
								 if(isset($row_mh['hospitalname']) > 0)
								 {
							 $row['hospitalname'] = $row_mh['hospitalname'] ;
							 }
							 if(isset($row_av['hospitalType']) > 0)
							 {
							 $row['hospitalType'] = $row_av['hospitalType'];
							 }
							 else
								  if(isset($row_mh['hospitaltype']) > 0)
								 {
							 $row['hospitalType'] = $row_mh['hospitaltype'];
							 }
							 
							 if($row['hospitalType'] == "1")	
							{
							$row['hospitalType'] = "HSC";}
							else								
							    if($row['hospitalType'] == "2")	
							    {
								$row['hospitalType'] = "PHC"; }
								 else
							    	 if($row['hospitalType'] == "3")	
							         {
									 $row['hospitalType'] = "UG PHC"; }
									   else 
										   if($row['hospitalType'] == "4")	
										   {
                                           $row['hospitalType'] = "GH"; 											   
						                   }
                                           else
	                                       if($row['hospitalType'] == "5")	
										   {
                                           $row['hospitalType'] = "MCH"; 											   
						                   }	
                                           else
											if($row['hospitalType'] == "6")	
										   {
                                           $row['hospitalType'] = "Private Hospital"; 											   
						                   }	
										   else
										   if($row['hospitalType'] == "7")	
										   {
                                           $row['hospitalType'] = "PNH"; 											   
						                   }	
                                           if($row['hospitalType'] == "8")	
										   {
                                           $row['hospitalType'] = "Home"; 											   
						                   }		
							 
							 if(isset($row['symptomsHighRisk']))
							 {
							 if($row['symptomsHighRisk'] == "1")	
							{
							$row['symptomsHighRisk'] = "Teenage Pregnancy";}
							else								
							    if($row['symptomsHighRisk'] == "2")	
							    {
								$row['symptomsHighRisk'] = "Elderly Primi"; }
								 else
							    	 if($row['symptomsHighRisk'] == "3")	
							         {
									 $row['symptomsHighRisk'] = "Elderly Multi "; }
									   else 
										   if($row['symptomsHighRisk'] == "4")	
										   {
                                           $row['symptomsHighRisk'] = "Short Primi"; 											   
						                   }
                                           else
	                                       if($row['symptomsHighRisk'] == "5")	
										   {
                                           $row['symptomsHighRisk'] = "Severe Anaemia"; 											   
						                   }	
                                          else
											if($row['symptomsHighRisk'] == "6")	
										   {
                                           $row['symptomsHighRisk'] = "PIH/Pre Eclampsia/Eclampsia"; 											   
						                   }	
										   else
										   if($row['symptomsHighRisk'] == "7")	
										   {
                                           $row['symptomsHighRisk'] = "Hydraminios"; 	
                                           								   
	                                    	 }		
		                                   if($row['symptomsHighRisk'] == "8")	
										   {
                                           $row['symptomsHighRisk'] = "APH"; 	
                                           								   
	                                    	 }		
                                           if($row['symptomsHighRisk'] == "9")	
										   {
                                           $row['symptomsHighRisk'] = "Multi Para"; 	
                                           								   
		                                     }				 
											 
											 if($row['symptomsHighRisk'] == "10")	
							{
							$row['symptomsHighRisk'] = "Multiple Pregnancy";}
							else								
							    if($row['symptomsHighRisk'] == "11")	
							    {
								$row['symptomsHighRisk'] = "Vesicular Mole"; }
								 else
							    	 if($row['symptomsHighRisk'] == "12")	
							         {
									 $row['symptomsHighRisk'] = "Rh incompatibility"; }
									   else 
										   if($row['symptomsHighRisk'] == "13")	
										   {
                                           $row['symptomsHighRisk'] = "Previous LSCS"; 											   
						                   }
                                           else
	                                       if($row['symptomsHighRisk'] == "14")	
										   {
                                           $row['symptomsHighRisk'] = "Instrumental V.D"; 											   
						                   }	
                                          else
											if($row['symptomsHighRisk'] == "15")	
										   {
                                           $row['symptomsHighRisk'] = "Weight below 40 kg"; 											   
						                   }	
										   else
										   if($row['symptomsHighRisk'] == "16")	
										   {
                                           $row['symptomsHighRisk'] = "Heart Disease complicating pregnancy"; 	
                                           								   
	                                    	 }		
		                                   if($row['symptomsHighRisk'] == "17")	
										   {
                                           $row['symptomsHighRisk'] = "Malaria"; 	
                                           								   
	                                    	 }		
                                           if($row['symptomsHighRisk'] == "18")	
										   {
                                           $row['symptomsHighRisk'] = "Long period infertility"; 	
                                           								   
		                                     }			

											if($row['symptomsHighRisk'] == "19")	
							{
							$row['symptomsHighRisk'] = "GDM";}
							else								
							    if($row['symptomsHighRisk'] == "20")	
							    {
								$row['symptomsHighRisk'] = "Previous bad obstetric history"; }
								 else
							    	 if($row['symptomsHighRisk'] == "21")	
							         {
									 $row['symptomsHighRisk'] = "Cancer"; }
									   else 
										   if($row['symptomsHighRisk'] == "22")	
										   {
                                           $row['symptomsHighRisk'] = "Intracranial Space occupying lesion"; 											   
						                   }
                                           else
	                                       if($row['symptomsHighRisk'] == "23")	
										   {
                                           $row['symptomsHighRisk'] = "Pregnant due to contraceptive Failure"; 											   
						                   }	
                                          else
											if($row['symptomsHighRisk'] == "24")	
										   {
                                           $row['symptomsHighRisk'] = "Ectopic Pregnancy"; 											   
						                   }	
										   else
										   if($row['symptomsHighRisk'] == "25")	
										   {
                                           $row['symptomsHighRisk'] = "Malpresentation"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "26")	
										   {
                                           $row['symptomsHighRisk'] = "Congenital malformation"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "27")	/**/
										   {
                                           $row['symptomsHighRisk'] = "Differently abled mother"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "28")	
										   {
                                           $row['symptomsHighRisk'] = "Cephalo Pelvic Disproportion"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "29")	
										   {
                                           $row['symptomsHighRisk'] = "HIV affected mother"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "30")	
										   {
                                           $row['symptomsHighRisk'] = "Intra Uterine Death"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "31")	
										   {
                                           $row['symptomsHighRisk'] = "Post dated Pregnancy"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "32")	
										   {
                                           $row['symptomsHighRisk'] = "IUGR"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "33")	
										   {
                                           $row['symptomsHighRisk'] = "Epilepsy"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "34")	
										   {
                                           $row['symptomsHighRisk'] = "Foul Smelling discharge"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "35")	
										   {
                                           $row['symptomsHighRisk'] = "Diabetes Mellitus"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "36")	
										   {
                                           $row['symptomsHighRisk'] = "Chronic Hypertension"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "37")	
										   {
                                           $row['symptomsHighRisk'] = "Renal Disease"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "38")	
										   {
                                           $row['symptomsHighRisk'] = "Maternal Tetanus"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "39")	
										   {
                                           $row['symptomsHighRisk'] = "High Fever"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "40")	
										   {
                                           $row['symptomsHighRisk'] = "Still Birth"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "41")	
										   {
                                           $row['symptomsHighRisk'] = "Obstructed Labour"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "42")	
										   {
                                           $row['symptomsHighRisk'] = "Transfusion Reaction"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "43")	
										   {
                                           $row['symptomsHighRisk'] = "Maternal Tuberculosis"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "44")	
										   {
                                           $row['symptomsHighRisk'] = "Maternal Hep. B positive"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "45")	
										   {
                                           $row['symptomsHighRisk'] = "Bronchial Asthma"; 	
										   }
										   else
										   if($row['symptomsHighRisk'] == "46")	
										   {
                                           $row['symptomsHighRisk'] = "VDRL Positive"; 	
										   }
										/*   else
										   if($row['symptomsHighRisk'] == "47")	
										   {
                                           $row['symptomsHighRisk'] = "COthers"; 	
										   } */
										   else
										   if($row['symptomsHighRisk'] == "48")	
										   {
                                           $row['symptomsHighRisk'] = "None"; 	
										   }
							 }
					  
					  $AR_High_Risk_Ind = "N";
					  

					  if($row_av['HighRisk'] == "1"  OR 
					     ($row_av['Hb'] > "0" AND $row_av['Hb'] < "10") OR 
						 $row_av['urineSugarPresent'] == "1" OR 
						 $row_av['urineAlbuminPresent']  == "1" OR 
						 (isset($row_av['gctValue']) AND  $row_av['gctValue'] != "" AND $row_av['gctValue']  > '140')  OR 
						 $row_av['bpSys']  > "130"  OR 
						 $row_av['bpDia']  > "90"  OR 
						 $row_av['Tsh'] == 'yes' OR 
						 ($row_av['motherWeight'] > 0 AND $row_av['motherWeight'] < 40)  OR
	                     $row_av['fastingSugar'] > 110  OR 
                         $row_av['postPrandial'] > 140  OR
	                   ($row_av['usgFetalHeartRate'] > 0 AND $row_av['usgFetalHeartRate'] < 100)  OR 
	$row_av['usgFetalHeartRate'] > 170  
	OR ($row_av['usgFetalHeartRate1'] > 0 AND $row_av['usgFetalHeartRate1'] < 100) OR 
	$row_av['usgFetalHeartRate1'] > 170 
	OR ($row_av['usgFetalHeartRate2'] > 0 AND $row_av['usgFetalHeartRate2'] < 100) OR 
	$row_av['usgFetalHeartRate2'] > 170  OR 
	$row_av['usgFetalPosition'] == 1 OR 
	$row_av['usgFetalPosition1'] == 1 OR
	$row_av['usgFetalPosition2'] == 1 OR
	$row_av['usgFetalMovement'] == 4 OR
	$row_av['usgFetalMovement1'] == 4 OR
	$row_av['usgFetalMovement2'] == 4) 
					  {
					
				            $High_Risk_Ind = "Y";
							$AR_High_Risk_Ind = "Y";
							
							
				  }}	}	
				
             $row['BlockName'] = "";
			 $row['PhcName'] = "";
			 $row['HscName'] = "";
			 $row['PanchayatName'] = "";
			 $row['VillageName'] = "";
				
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
							$row['BlockName'] = $rowh['BlockName'];
			 $row['PhcName'] = $rowh['PhcName'];
			 $row['HscName'] = $rowh['HscName'];
			 $row['PanchayatName'] = $rowh['PanchayatName'];
			 $row['VillageName'] = $rowh['VillageName'];
							
							if($AR_High_Risk_Ind == "N")
									   {
										   if($High_Risk_Ind == "N")
										   {
											   if($row['gravida'] > "2" OR 
											      $row['para'] > "2" OR 
												  $row['livingChildren'] > "2" OR 
												  $row['abortion'] > "2" OR 
												  $row['childDeath'] > "2" OR 
												  $row['bpSys'] > "130" OR 
												  $row['bpDia'] > "90" OR
												  $row['motherHeight'] < '145' OR 
												  ($row['motherWeight'] > '0' AND $row['motherWeight'] < '40') OR 
												  $row['MotherAge'] < "18" OR
												  $row['MotherAge'] > "30" OR
												  $row['hrPregnancy'] == "1")
											   {
												$High_Risk_Ind = "Y"; 
											
											   }
									   }}
										    if($High_Risk_Ind == "Y")
											{
		$search_flag = false; 
		
		$row['lmpfmt'] = "";
		$row['eddfmt'] = "";
		$row['lmpfmt'] = $lmp_fmt;
		$row['eddfmt'] = $edd_fmt;
		
		
        $pregnancyWeek = $row['pregnancyWeek'];
        if(empty($pregnancyWeek)){
           $pregnancyWeek = numWeeks($lmp_fmt, $edd_fmt);
		   $row['pregnancyWeek'] = $pregnancyWeek;
        }
        			
		$wild_srch = "";				     
	 if(isset($search_text_input) > 0 )
	 {	 
       
       $wild_srch = $wild_cnt++."||".   
	   $row['picmeno']."||".
	   date('d-m-Y', strtotime($row['anRegDate']))."||".
	   $rowh['BlockName']."||".
       $rowh['PhcName']."||".
       $rowh['HscName']."||".
	   $rowh['PanchayatName']."||".
       $rowh['VillageName']."||".
	   $row['residentType']."||".
       $row['motheraadhaarname']."||".
	   $row['MotherAge']."||".
	   $row['husbandaadhaarname']."||".
	   $row['mothermobno']."||".
	   $row['obstetricCode']."||".								   
	   date('d-m-Y', strtotime($row['lmpfmt']))."||". 
       date('d-m-Y', strtotime($row['eddfmt']))."||".
	   $row['pregnancyWeek']."||".
	   $row['symptomsHighRisk']."||".	   
	   $row['hospitalType']."||".
	   date('d-m-Y', strtotime($row['refdat']))."||".
	   $row['hospitalname'];
	   
	   if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	   {
		$search_flag = true; 
	   }
}
	
	
	if($search_flag || isset($search_text_input) == 0 )
	{
		
	  $developer_records[] = $row;
	}}	}}}}
	$filename = "High_Risk_List_".date('d-m-Y') . ".xls";			
	  header("Content-Type: application/vnd.ms-excel");
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  $file = fopen('php://output','w');
	  $header = array("High Risk List as on ".date('d-m-Y'));
	  fputcsv($file,$header);	
	  $show_coloumn = false;
	  if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		 if(!$show_coloumn) {
			 
		$h = array("S.No", "RCHID (PICME) No.","AN Registered Date","Block","PHC","HSC"," VP / TP / Mpty","Village / Ward","Resident/Visitor","Mother Name","Age","Husband Name", "Mobile No","Obstetric score","LMP","EDD","Gestation Period in Weeks","High Risk Factor","Birth Plan","Referral Date","Referral Place");
			
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
	   $record['obstetricCode'],	
	   $record['lmpfmt'], 
       $record['eddfmt'],
	   $record['pregnancyWeek'],
	   $record['symptomsHighRisk'],
	   $record['hospitalType'],
	   date('d-m-Y', strtotime($record['refdat'])),
	   $record['hospitalname']
		  ); 
			$excelData .= implode("\t", array_values($lineData)) . "\n";
	   }
		echo $excelData;
	  }
	//  header('Location: ' . $_SERVER['HTTP_REFERER']);
	  exit; 

?>
<?php
function numWeeks($dateOne, $dateTwo){
    //Create a DateTime object for the first date.
    $firstDate = new DateTime($dateOne);
    //Create a DateTime object for the second date.
    $secondDate = new DateTime($dateTwo);
    //Get the difference between the two dates in days.
    $differenceInDays = $firstDate->diff($secondDate)->days;
    //Divide the days by 7
    $differenceInWeeks = $differenceInDays / 7;
    //Round down with floor and return the difference in weeks.
    return floor($differenceInWeeks);
}
?>
