<?php include ('require/topHeader.php'); ?>
<body>
  <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
		
<?php include ('require/header.php'); // Menu
	  if(($usertype == 0) || ($usertype == 1)) {
	  include ('require/filter.php'); // Top Filter 
}else if(($usertype == 2)) {
    include ('require/Bfilter.php');
}else if(($usertype == 3) || ($usertype == 4)) {
    include ('require/Pfilter.php');   
}
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
			<!-- Hoverable Table rows -->
              <div class="card"><h5 class="card-header">
                  <span class="text-muted fw-light">Reports / High Risk / </span> High Risk List
               </h5>  
			   
<!------------------------------------------------------------------------------------- Page Details + search button + Table -------------------------------------------------------->		   
			<div class="table-responsive text-nowrap">		 
	 
	        <div class="container"> 
			<div class="table-responsive text-nowrap">	
	       		
		   <table id="users-detail"  class="display nowrap" cellspacing="0" width="100%"> 
			
                        <thead>
                         <tr>
               <th>S.No</th>     
               <th>RCHID (PICME) No.</th>
               <th>AN Registered Date</th>
               <th>Block</th>
               <th>PHC</th>
               <th>HSC</th>
			   <th>VP / TP / Mpty</th>
               <th>Village / Ward</th>
			   <th>Resident/Visitor</th> 
               <th>Mother Name</th>
               <th>Age</th>
               <th>Husband Name</th>
			   <th>Mobile No</th>
               <th>Obstetric score</th>
               <th>LMP</th>
               <th>EDD</th>
               <th>Gestation Period in Weeks</th> 
			   <th>High Risk Factor</th> 
			   <th>Birth Plan</th>
			   <th>Referral Date</th>
			   <th>Referral Place</th>
                         </tr>
                       </thead>  
    <?php

        $listQry = "SELECT ar.hrPregnancy,ar.gravida,ar.para,ar.livingChildren,ar.abortion,ar.childDeath,ar.bpSys,ar.bpDia,ar.motherWeight,ar.updatedat, ar.createdat,ar.picmeno,ar.residentType, ec.motherdob, ar.id, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, ec.motheraadhaarname,ar.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno FROM anregistration ar JOIN ecregister ec on ec.picmeNo=ar.picmeno
	             WHERE ar.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ar.picmeno)";
									 
	  $private = " AND ar.createdBy='".$userid."'";
      $orderQry = " ORDER BY ar.anRegDate DESC";
	  
      if(($usertype == 0) || ($usertype == 1)) {
         if(isset($_POST['filter'])) {
	        $hscName = "";
	$bloName = "";
	$phcName = "";
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
		 
              if($bloName == "" && $phcName == "" && $hscName == ""){
                $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
              } else if($bloName != "" && $phcName == "" && $hscName == ""){
                $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."'".$orderQry);
              } else if($bloName != "" && $phcName != "" && $hscName == ""){
                $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."'".$orderQry);
              } else if($bloName != "" && $phcName != "" && $hscName != ""){
                $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."'".$orderQry);
              }
            } else if(isset($_POST['reset'])) {
                      $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                   } else {
                      $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                          }
            } else if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
                       $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$BlockId."'".$orderQry);
                       }  else {
                       $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
                        } 
						
              if($ExeQuery) {
                $cnt=1;
                while($row = mysqli_fetch_array($ExeQuery)) {
					$High_Risk_Ind = "N";
					        $row['refdat'] = "";
							$row['symptomsHighRisk'] = "";
					   /*     if($row['updatedat'] == "NULL")
							{
							 if($row['createdat'] != "NULL")	
							{
							 $row['refdat'] = $row['createdat'];
							}	}
							else
							{
							$row['refdat'] = $row['updatedat'];	
							} */
						 $row['refdat'] = $row['anRegDate'];
							
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
							
							 
							 if($row['gravida'] > "2") 
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
								if($row['motherWeight'] <= "40") 
							{
							$row['symptomsHighRisk'] = "Weight below 40 kg";	
							}
							else
								if($row['bpSys'] >= "140" OR $row['bpDia'] >= "90") 
							{
							$row['symptomsHighRisk'] = "PIH/Pre Eclampsia/Eclampsia";	
							} 
							else
								if($row['MotherAge'] < "18") 
							{
							$row['symptomsHighRisk'] = "Teenage Pregnancy";	
							} 
							
							
							$lmp_fmt = "";
							$edd_fmt = "";
							$mh_hspl_ty = "";
							$ar_mh_fnd = "N";
						//	$row_mh = "";
							$row_mh['momVdrlRprResult'] = " ";
						//	print_r($row_mh['momVdrlRprResult']);
						//	print_r("break");
				
				$listQry_mh = "SELECT * FROM medicalhistory mh 
	              WHERE mh.status!=0 AND mh.picmeno = $ar_picme
				  AND NOT EXISTS (SELECT antenatalvisit.picmeno FROM antenatalvisit 
				  WHERE antenatalvisit.picmeno = mh.picmeno)";
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
										/*  if($row_mh['picmeno']=="133010154265"){
									
									
						print_r($row_mh['momVdrlRprResult']); print_r("After"); } */
						
						
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
							else	
                            if($row_mh['pastillness'] == "110")
                            {
                             $row['symptomsHighRisk'] = "Any Other Specify";
                            }
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
						 $row_mh['pastillness'] != "100")
				{
					
					$High_Risk_Ind = "Y";
				
				}
							
				  }}		
				
								
				$row['pregnancyWeek'] = "";
				//$row_av = "";
				$AR_High_Risk_Ind = "Not";
				$listQry_av = "SELECT * FROM antenatalvisit av 
	              WHERE av.status!=0 AND av.picmeno = $ar_picme AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)";
				  $ExeQuery_av = mysqli_query($conn,$listQry_av);
				  if($ExeQuery_av) { 
				  while($row_av = mysqli_fetch_array($ExeQuery_av)) {
					  $row['pregnancyWeek'] = $row_av['pregnancyWeek'];
							
							if(strlen($row_av['symptomsHighRisk']) > 0)
							{
							$row['symptomsHighRisk'] = $row_av['symptomsHighRisk'];
							}
						/*	else
							{
							$row['symptomsHighRisk'] = "Others";
							}	*/
							 if(strlen($row_av['referralDate']) > 0)
							 {
							 $row['refdat'] = $row_av['referralDate'];
							 
							 }
							 
							 if(strlen($row_av['referralPlace']) > 0)
							 {
							 $row['hospitalname'] = $row_av['referralPlace'];
							 }
							 else
								 if(isset($row_mh['hospitalname']) > 0)
								 {
							 $row['hospitalname'] = $row_mh['hospitalname'] ;
							 }
							 if(strlen($row_av['hospitalType']) > 0)
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
										   else
										/*   if($row['symptomsHighRisk'] == "47")	
										   {
                                           $row['symptomsHighRisk'] = "COthers"; 	
										   }
										   else */
										   if($row['symptomsHighRisk'] == "48")	
										   {
                                           $row['symptomsHighRisk'] = "None"; 	
										   }
							 }
							
					  $AR_High_Risk_Ind = "N";
					  if($row_av['HighRisk'] == "1" OR $row_av['Hb'] < "10" OR $row_av['urineSugarPresent'] == "1" OR $row_av['urineAlbuminPresent']  == "1" OR $row_av['gctValue']  >= "190" OR $row_av['bpSys']  >= "140" OR $row_av['bpDia']  >= "90" OR $row_av['motherWeight'] <= "40") 
					  {
					
				            $High_Risk_Ind = "Y";
							$AR_High_Risk_Ind = "N";
							 
							
				  }}	}	
				

				
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
							
							
							//(ar.gravida > 2 OR ar.para > 2 OR ar.livingChildren > 2 OR ar.abortion > 2 OR ar.childDeath > 2 OR ar.bpSys >= 140 OR ar.bpDia >= 90 OR ar.motherWeight <= 40)"; 
        		
										 /*  if($row['picmeno']=="133010407072"){
						print_r($High_Risk_Ind);print_r("After");}*/
									   
									   if($AR_High_Risk_Ind == "Not")
									   {
										   if($High_Risk_Ind == "N")
										   {
											   if($row['gravida'] > "2" OR $row['para'] > "2" OR $row['livingChildren'] > "2" OR $row['abortion'] > "2" OR $row['childDeath'] > "2" OR $row['bpSys'] >= "140" OR $row['bpDia'] >= "90" OR $row['motherWeight'] <= "40" OR $row['MotherAge'] < "18" OR $row['hrPregnancy'] == "1")
        		
											   {
												$High_Risk_Ind = "Y";   
												/* if($row['picmeno']=="133010407072"){
						print_r($High_Risk_Ind);exit;}*/
											   }
										   }
									   }
										    if($High_Risk_Ind == "Y")
											{
                       ?>
                       <tr>
                                                   <td><?php echo $cnt; ?></td>
                                                   <td><?php echo $row['picmeno']; ?></td>
                                                   <td><?php echo date('d-m-Y', strtotime($row['anRegDate'])); ?></td>
                                                   <td><?php echo $rowh['BlockName']; ?></td>
                                                   <td><?php echo $rowh['PhcName']; ?></td>
                                                   <td><?php echo $rowh['HscName']; ?></td>
                                                   <td><?php echo $rowh['PanchayatName']; ?></td>
                                                   <td><?php echo $rowh['VillageName']; ?></td>
                                                   <td><?php echo $row['residentType']; ?></td>
                                                   <td><?php echo $row['motheraadhaarname']; ?></td>
                                                   <td><?php echo $row['MotherAge']; ?></td>
                                                   <td><?php echo $row['husbandaadhaarname']; ?></td>
                                                   <td><?php echo $row['mothermobno']; ?></td>
                                                   <td><?php echo $row['obstetricCode']; ?></td>									   
                                                   <td><?php echo $lmp_fmt; ?></td>
                                                   <td><?php echo $edd_fmt; ?></td> 
                                                   <td><?php
                                                   $pregnancyWeek = $row['pregnancyWeek'];
                                                   if(empty($pregnancyWeek)){
                                                       $pregnancyWeek = numWeeks($lmp_fmt, $edd_fmt);
                                                   }
                                                   
                                                   echo $pregnancyWeek; ?></td>
                                                   <td><?php echo $row['symptomsHighRisk']; ?></td> 
                                                   <td><?php echo $mh_hspl_ty; ?></td>
                                                   <td><?php echo date('d-m-Y', strtotime($row['refdat'])); ?></td>
                                                   <td><?php echo $row['hospitalname']; ?></td>
                                               </tr> 
                         <?php 
                           $cnt++;
						
			//} /*new*/
			//	}} /*AV */
			}
				} /*Final if */
						 }}
                         } 
                       } ?> <!----------- AN Reg ---->
					   
					</table>   <!-------------------- Insert Code Here -------------->
	
</div>
<!--------------------------------------------------------------------------------------------- search button + Table Ends -------------------------------------------------------->	

<!-------------------------------------------------------------- Start Download Code ------------------------------------------------------>		




<!------------------------------------------------------------------ Preparing values for next page --------------------------------------------------------------------------------->
<?php
    $hscName = "";
	$bloName = "";
	$phcName = "";
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
?>	
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------- Download button + Submitting values to next page ------------------------------------------------------------------>
    <form action="HRListExp.php" method="post" id="filterform" style="width:100%";>	
		  <div class="col-md-8" style="margin-top: 10px;">
   		
          <button type="submit" id="AVReport" name='AVReport' style = "margin-left : 450px; margin-bottom: 10px" class="btn lt btn-primary"><span class="bx bx-download"></span>&nbsp; Download</button>
	      <input type ="hidden" name="search_text_input" id="search_text_input"/>	
	      <input type="hidden" name ="BlockId" value = "<?php echo $bloName; ?>" />
          <input type="hidden" name ="HscId" value = "<?php echo $hscName; ?>" /> 
	      <input type="hidden" name ="BlockId" value = "<?php echo $bloName; ?>" />
		  <input type="hidden" name ="PhcId" value = "<?php echo $phcName; ?>" /> 
   
	      </div> 
    </form> 
<!----------------------------------------------------------------------- End Download Code ----------------------------------------------------------------------------------------->	  
 </div></div></div>
	  	
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
 
        <!-- / Navbar -->
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

include ('require/dtFooter.php'); ?>		
		 