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
                  <span class="text-muted fw-light">Reports / High Risk / </span> Anemia
               </h5>  
			   
<!------------------------------------------------------------------------------------- Page Details + search button + Table -------------------------------------------------------->		   
			<div class="table-responsive text-nowrap">		 
	 
	        <div class="container"> 
	        <div class="table-responsive text-nowrap">
		
		   <table id="users-detail"  class="display nowrap" cellspacing="0" width="100%"> 
			
                       <thead>
                         <tr>
               <th>S.No</th>     
               <th>RCH ID</th>
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
			   <th>Mobile No.</th>
               <th>Obstetric score</th>
               <th>LMP</th>
               <th>EDD</th>
			   
			   <th>Weight Gain</th>
			   
			   <th>HB (Below 20 Weeks)</th> 
			   
			   <th>HB (Between 20 - 27 Weeks)</th>
			   <th>Iron Sucrose Dose 1</th>
			   <th>Iron Sucrose Dose 2</th>
			   <th>Iron Sucrose Dose 3</th>
			   <th>Iron Sucrose Dose 4</th>
			   <th>Iron Sucrose Top up(1)</th>
			   <th>Iron Sucrose Top up(2)</th>
			   
			   
               <th>HB (Between 28 - 34 Weeks)</th>
			   <th>FST (Between 28 - 34 Weeks)</th>
			   <th>Blood Transfusion (Between 28 - 34 Weeks)</th>
			   
			   <th>HB (After 34 Weeks)</th>
			   <th>Blood Transfusion (After 34 Weeks)</th>
                         </tr>
                       </thead>  
    <?php
	
	$pre_picme = "";
	$ar_picme = "";
	$pre_av_picme = "";
    $prev_picmeno = "";  
	  
      $listQry = "SELECT ar.gravida,ar.para,ar.livingChildren,ar.abortion,ar.childDeath,ar.bpSys,ar.bpDia,ar.motherWeight,ar.residenttype, ar.updatedat, ar.createdat,ar.picmeno,ar.residentType, ec.motherdob, ar.id, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, ec.motheraadhaarname,ar.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM anregistration ar JOIN ecregister ec on ec.picmeNo=ar.picmeno JOIN medicalhistory mh on mh.picmeno = ar.picmeno
	            WHERE ar.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ar.picmeno)";  

      // $listQry = "SELECT av.Hb, av.fastingSugar, av.bloodTransfusion, av.noOfIVDoses, av.picmeno,av.id, av.motherWeight, av.bpSys, av.bpDia, av.pregnancyWeek,av.urineAlbuminPresent,av.noCalcium, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
     //            WHERE av.status!=0 NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno)";  


  //   mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno	 
				   		
	  $private = " AND av.createdBy='".$userid."'";
      $orderQry = " ORDER BY ar.picmeRegDate DESC";
	  
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
						
					//	print_r("Hello!")	;
						
              if($ExeQuery) {
                $cnt=1;
                while($row = mysqli_fetch_array($ExeQuery)) {
					
					//print_r($row['picmeno'])	; 
												
				
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
							
						if(strlen($pre_picme) > 0 AND $pre_picme != $row['picmeno'])
						
						{
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
				     
				     } 
					
					 if($HB_Ind == "Y") 
					 { 
                       ?>
                        <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $prev_picmeno; ?></td>
					       <td><?php echo $prev_picmeRegDate; ?></td>
				           <td><?php echo $prev_BlockName; ?></td>
                           <td><?php echo $prev_PhcName; ?></td>
                           <td><?php echo $prev_HscName; ?></td>
			               <td><?php echo $prev_PanchayatName; ?></td>
                           <td><?php echo $prev_VillageName; ?></td>
						   
						   <td><?php echo $prev_residenttype; ?></td>
						   
                           <td><?php echo $prev_motheraadhaarname; ?></td>
					       <td><?php echo $prev_MotherAge; ?></td>
					       <td><?php echo $prev_husbandaadhaarname; ?></td>
			               <td><?php echo $prev_mothermobno; ?></td>
					       <td><?php echo $prev_obstetricCode; ?></td>									   
					       <td><?php echo $prev_lmpdate; ?></td>
                           <td><?php echo $prev_edddate; ?></td> 
						   
						   <td><?php echo $prev_motherWeight; ?></td>	
						   
						    <td><?php echo $prev_Hb1; ?></td>	
						   
						    <td><?php echo $prev_Hb2; ?></td>	
							<td><?php echo $prev_ISD1; ?></td>
                            <td><?php echo $prev_ISD2; ?></td>	
                            <td><?php echo $prev_ISD3; ?></td>
                            <td><?php echo $prev_ISD4; ?></td>
                            <td><?php echo $prev_ISDT1; ?></td>		
                            <td><?php echo $prev_ISDT2; ?></td>									
					       
					       <td><?php echo $prev_Hb3; ?></td>
						   <td><?php echo $prev_FST; ?></td>
						   <td><?php echo $prev_BT1; ?></td>
						   
						   <td><?php echo $prev_Hb4; ?></td>
						   <td><?php echo $prev_BT2; ?></td>
					     </tr>
                         <?php 
					
						   $cnt++;
						    }
						   $pre_picme = "";
						   $prev_picmeno =  ""; 
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
					
						}
						else
						{
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
						} /* $pre_picme */
						
						 }}
                         } 
				}} /*bELOW 20*/
                       }


if(strlen($prev_picmeno) > 0)
{
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
				     
				     } 
					   if($HB_Ind=="Y")
					   { 
					   ?>
					   <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $prev_picmeno; ?></td>
					       <td><?php echo $prev_picmeRegDate; ?></td>
				           <td><?php echo $prev_BlockName; ?></td>
                           <td><?php echo $prev_PhcName; ?></td>
                           <td><?php echo $prev_HscName; ?></td>
			               <td><?php echo $prev_PanchayatName; ?></td>
                           <td><?php echo $prev_VillageName; ?></td>
						   
						   <td><?php echo $prev_residenttype; ?></td>
						   
                           <td><?php echo $prev_motheraadhaarname; ?></td>
					       <td><?php echo $prev_MotherAge; ?></td>
					       <td><?php echo $prev_husbandaadhaarname; ?></td>
			               <td><?php echo $prev_mothermobno; ?></td>
					       <td><?php echo $prev_obstetricCode; ?></td>									   
					       <td><?php echo $prev_lmpdate; ?></td>
                           <td><?php echo $prev_edddate; ?></td> 
						   
						   <td><?php echo $prev_motherWeight; ?></td>	
						   
						    <td><?php echo $prev_Hb1; ?></td>	
						   
						    <td><?php echo $prev_Hb2; ?></td>	
							<td><?php echo $prev_ISD1; ?></td>
                            <td><?php echo $prev_ISD2; ?></td>	
                            <td><?php echo $prev_ISD3; ?></td>
                            <td><?php echo $prev_ISD4; ?></td>
                            <td><?php echo $prev_ISDT1; ?></td>		
                            <td><?php echo $prev_ISDT2; ?></td>									
					       
					       <td><?php echo $prev_Hb3; ?></td>
						   <td><?php echo $prev_FST; ?></td>
						   <td><?php echo $prev_BT1; ?></td>
						   
						   <td><?php echo $prev_Hb4; ?></td>
						   <td><?php echo $prev_BT2; ?></td>
					     </tr>
	   <?php
}
					 }
?>
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
    <form action="AnemiaListExp.php" method="post" id="filterform" style="width:100%";>	
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
<?php include ('require/dtFooter.php'); ?>		
		 
		