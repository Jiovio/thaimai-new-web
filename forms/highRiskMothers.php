<?php include ('require/topHeader.php'); ?>
<?php session_start(); ?>
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
} else {
    include ('require/Hfilter.php'); // Top Filter
}
?>
<!-- Content wrapper -->
      <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Hoverable Table rows -->
                 <div class="card">
                   <h5 class="card-header">High Risk Mothers List
				   
                   <a onclick="alert('Start to refresh. Please wait...');" href="<?php echo $siteurl; ?>/forms/HRRefresh.php" type="button" class="btn btn-primary" style="float:right;">
            
				  <span class="bx bx-refresh"></span> Refresh </a>				   			   
				   </h5>
				   
                   <div class="table-responsive text-nowrap">
				   
	<?php			   
/* ------------------------------------------------------ Virtual table updation starts ---------------------------------------------------- */
	 
	 $listQry_hr_upd_100 = mysqli_query($conn, "UPDATE `hr_virtual` hr 
 JOIN highriskmothers hr_mot ON hr_mot.picmeNo = hr.picmeNo 
 SET 
 hr.id = hr_mot.id,
 hr.picmeNo = hr_mot.picmeNo,
 hr.motherName = hr_mot.motherName,
 hr.highRiskFactor = hr_mot.highRiskFactor,
 hr.status = hr_mot.status
 ");
	 
	 /* ------------------------------------------------------ Virtual table updation ends ------------------------------------------------------ */
	 ?>

           <div class="container">
           <table id="highRisk-mother-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>            
               <th>RCHID (PICME) No.</th>
               <th>Mother Name</th>
               <th>High Risk Factor</th>
                         </tr>  
                       </thead>
<?php  
$pre_picme = "";
$query = "SELECT enumid,enumvalue FROM enumdata WHERE type > 0";
$exequery = mysqli_query($conn, $query);
$periodAr= array();
while ($listvalue = mysqli_fetch_assoc($exequery)) {
    $periodAr[$listvalue['enumid']] = $listvalue['enumvalue'];
}

//$listQry = "SELECT DISTINCT(hr.picmeNo),ec.motheraadhaarname,hr.highRiskFactor,ec.BlockId,ec.PhcId,ec.HscId from hr_virtual hr JOIN ecregister ec on hr.picmeNo=ec.picmeno WHERE hr.status=1";
//$listQry = "SELECT hr.picmeNo,hr.highRiskFactor from hr_virtual hr WHERE hr.status!=0";
 //$listQry = "SELECT DISTINCT(hr.picmeNo), hr.highRiskFactor, hr.status, hr.motherName  from hr_virtual hr JOIN ecregister ec on hr.picmeNo=ec.picmeNo WHERE hr.status!=0";

$listQry = "SELECT DISTINCT(hr.picmeNo), hr.highRiskFactor, hr.status, hr.motherName From hr_virtual hr JOIN ecregister ec on hr.picmeNo = ec.picmeNo 
			JOIN hscmaster hs on ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId =hs.HscId AND 
			ec.PanchayatId =hs.PanchayatId AND ec.VillageId = hs.VillageId WHERE hr.status!=0";

$orderQry = " ORDER BY hr.picmeNo ASC";

    if(($usertype == 0) || ($usertype == 1)) {
      if(isset($_POST['filter'])) {
        $bloName = $_POST['BlockId']; 
        $phcName = $_POST['PhcId'];
        $hscName = $_POST['HscId'];        
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
          $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
      }
                       if($ExeQuery) {
                         $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
							
							 
					/*		 $listQry_ec = "SELECT ec.motheraadhaarname, ec.picmeno from ecregister ec";
							 $ExeQuery_ec = mysqli_query($conn,$listQry_ec);
							 while($row_e = mysqli_fetch_array($ExeQuery_ec))
							 {
								 
								 if($pre_picme!=$row['picmeNo'])
									 
								 { 
							 if ($row['picmeNo'] == $row_e['picmeno'])
							 { */
                       ?>
                                   <tr>
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['picmeNo']; ?></td>
                                       <td><?php echo $row['motherName']; ?></td>
									   <td><?php echo $row['highRiskFactor']; ?></td>
                                       <?php 
									   
                                  /*     $highRiskFactor="";
                                        if(isset($periodAr[$row['highRiskFactor']]))
										{
                                            $highRiskFactor = $periodAr[$row['highRiskFactor']];
											$row['highRiskFactor'] = $highRiskFactor;
											if(isset($row['highRiskFactor']))
							 {
							 if($row['highRiskFactor'] == "1")	
							{
							$row['highRiskFactor'] = "Teenage Pregnancy";}
							else								
							    if($row['highRiskFactor'] == "2")	
							    {
								$row['highRiskFactor'] = "Elderly Primi"; }
								 else
							    	 if($row['highRiskFactor'] == "3")	
							         {
									 $row['highRiskFactor'] = "Elderly Multi "; }
									   else 
										   if($row['highRiskFactor'] == "4")	
										   {
                                           $row['highRiskFactor'] = "Short Primi"; 											   
						                   }
                                           else
	                                       if($row['highRiskFactor'] == "5")	
										   {
                                           $row['highRiskFactor'] = "Severe Anaemia"; 											   
						                   }	
                                          else
											if($row['highRiskFactor'] == "6")	
										   {
                                           $row['highRiskFactor'] = "PIH/Pre Eclampsia/Eclampsia"; 											   
						                   }	
										   else
										   if($row['highRiskFactor'] == "7")	
										   {
                                           $row['highRiskFactor'] = "Hydraminios"; 	
                                           								   
	                                    	 }		
		                                   if($row['highRiskFactor'] == "8")	
										   {
                                           $row['highRiskFactor'] = "APH"; 	
                                           								   
	                                    	 }		
                                           if($row['highRiskFactor'] == "9")	
										   {
                                           $row['highRiskFactor'] = "Multi Para"; 	
                                           								   
		                                     }				 
											 
											 if($row['highRiskFactor'] == "10")	
							{
							$row['highRiskFactor'] = "Multiple Pregnancy";}
							else								
							    if($row['highRiskFactor'] == "11")	
							    {
								$row['highRiskFactor'] = "Vesicular Mole"; }
								 else
							    	 if($row['highRiskFactor'] == "12")	
							         {
									 $row['highRiskFactor'] = "Rh incompatibility"; }
									   else 
										   if($row['highRiskFactor'] == "13")	
										   {
                                           $row['highRiskFactor'] = "Previous LSCS"; 											   
						                   }
                                           else
	                                       if($row['highRiskFactor'] == "14")	
										   {
                                           $row['highRiskFactor'] = "Instrumental V.D"; 											   
						                   }	
                                          else
											if($row['highRiskFactor'] == "15")	
										   {
                                           $row['highRiskFactor'] = "Weight below 40 kg"; 											   
						                   }	
										   else
										   if($row['highRiskFactor'] == "16")	
										   {
                                           $row['highRiskFactor'] = "Heart Disease complicating pregnancy"; 	
                                           								   
	                                    	 }		
		                                   if($row['highRiskFactor'] == "17")	
										   {
                                           $row['highRiskFactor'] = "Malaria"; 	
                                           								   
	                                    	 }		
                                           if($row['highRiskFactor'] == "18")	
										   {
                                           $row['highRiskFactor'] = "Long period infertility"; 	
                                           								   
		                                     }			

											if($row['highRiskFactor'] == "19")	
							{
							$row['highRiskFactor'] = "GDM";}
							else								
							    if($row['highRiskFactor'] == "20")	
							    {
								$row['highRiskFactor'] = "Previous bad obstetric history"; }
								 else
							    	 if($row['highRiskFactor'] == "21")	
							         {
									 $row['highRiskFactor'] = "Cancer"; }
									   else 
										   if($row['highRiskFactor'] == "22")	
										   {
                                           $row['highRiskFactor'] = "Intracranial Space occupying lesion"; 											   
						                   }
                                           else
	                                       if($row['highRiskFactor'] == "23")	
										   {
                                           $row['highRiskFactor'] = "Pregnant due to contraceptive Failure"; 											   
						                   }	
                                          else
											if($row['highRiskFactor'] == "24")	
										   {
                                           $row['highRiskFactor'] = "Ectopic Pregnancy"; 											   
						                   }	
										   else
										   if($row['highRiskFactor'] == "25")	
										   {
                                           $row['highRiskFactor'] = "Malpresentation"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "26")	
										   {
                                           $row['highRiskFactor'] = "Congenital malformation"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "27")	
										   {
                                           $row['highRiskFactor'] = "Differently abled mother"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "28")	
										   {
                                           $row['highRiskFactor'] = "Cephalo Pelvic Disproportion"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "29")	
										   {
                                           $row['highRiskFactor'] = "HIV affected mother"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "30")	
										   {
                                           $row['highRiskFactor'] = "Intra Uterine Death"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "31")	
										   {
                                           $row['highRiskFactor'] = "Post dated Pregnancy"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "32")	
										   {
                                           $row['highRiskFactor'] = "IUGR"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "33")	
										   {
                                           $row['highRiskFactor'] = "Epilepsy"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "34")	
										   {
                                           $row['highRiskFactor'] = "Foul Smelling discharge"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "35")	
										   {
                                           $row['highRiskFactor'] = "Diabetes Mellitus"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "36")	
										   {
                                           $row['highRiskFactor'] = "Chronic Hypertension"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "37")	
										   {
                                           $row['highRiskFactor'] = "Renal Disease"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "38")	
										   {
                                           $row['highRiskFactor'] = "Maternal Tetanus"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "39")	
										   {
                                           $row['highRiskFactor'] = "High Fever"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "40")	
										   {
                                           $row['highRiskFactor'] = "Still Birth"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "41")	
										   {
                                           $row['highRiskFactor'] = "Obstructed Labour"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "42")	
										   {
                                           $row['highRiskFactor'] = "Transfusion Reaction"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "43")	
										   {
                                           $row['highRiskFactor'] = "Maternal Tuberculosis"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "44")	
										   {
                                           $row['highRiskFactor'] = "Maternal Hep. B positive"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "45")	
										   {
                                           $row['highRiskFactor'] = "Bronchial Asthma"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "46")	
										   {
                                           $row['highRiskFactor'] = "VDRL Positive"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "47")	
										   {
                                           $row['highRiskFactor'] = "Others"; 	
										   }
										   else
										   if($row['highRiskFactor'] == "48")	
										   {
                                           $row['highRiskFactor'] = "None"; 	
										   }
							 }
										   
                                        } 
										else
										{
                                            $row['highRiskFactor'] = "Others";
                                        } 	
                                       ?>
                                    <!---   <td><//?php echo $highRiskFactor; ?></td> --->
									   <td><?php echo $row['highRiskFactor']; ?></td> 
								   </tr> */
								   ?> 
                       <?php 
                           $cnt++;
						   $pre_picme = $row['picmeNo'];
                         } 
					/*	 } */
					/*	 }} /* New */
                       } ?>
                     </table></div>
                   </div>
                 </div>
				 
				   <?php $listQry_trunc = mysqli_query($conn,"TRUNCATE hr_virtual"); ?>
      <!--/ Hoverable Table rows -->
<?php include ('require/dtFooter.php'); ?>