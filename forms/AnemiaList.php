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
	
      $listQry = "SELECT av.ancPeriod, av.Hb, av.fastingSugar, av.bloodTransfusion, av.noOfIVDoses, av.picmeno,av.id, av.motherWeight, av.bpSys, av.bpDia, av.pregnancyWeek,av.urineAlbuminPresent,av.noCalcium, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno)
				  AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno) AND av.Hb < 10";    		
				   	
	  $private = " AND av.createdBy='".$userid."'";
	  
      $orderQry = " ORDER BY av.picmeno DESC";
	  
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
                while($row = mysqli_fetch_array($ExeQuery))	
				{
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
							
							
				$AVQry = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND av.pregnancyWeek < 20 ";
								
				$AVRes =  mysqli_query($conn,$AVQry);
                if($AVRes) {	
                while($row_av = mysqli_fetch_array($AVRes)) {
					
																			
					
					$row['pregnancyWeek'] = $row_av['pregnancyWeek'];
					$row['Hb1'] = $row_av['Hb'];
					
				}}
				
				$AVQry2 = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND 
				           av.pregnancyWeek > 19 AND av.pregnancyWeek <= 27";
								
				$AVRes2 =  mysqli_query($conn,$AVQry2);
                if($AVRes2) {	
                while($row_av2 = mysqli_fetch_array($AVRes2)) {
				//	$row['pregnancyWeek'] = $row_av['pregnancyWeek'];
					$row['Hb2'] = $row_av2['Hb'];
					if($row_av2['bloodTransfusion'] == "3")
						{					
                    if(strlen($row['ISD1']) == 0 OR strlen($row['ISDT2']) > 0)
                    {	
                
						$row['ISD1'] = $row_av2['noOfIVDoses'];
					}	
					else
					if(strlen($row['ISD2']) == 0 OR strlen($row['ISDT2']) > 0)	
					{	
                        $row['ISD2'] = $row_av2['noOfIVDoses'];
					}
					else
                    if(strlen($row['ISD3']) == 0 OR strlen($row['ISDT2']) > 0)	 
					{	
					 $row['ISD3'] = $row_av2['noOfIVDoses'];
					}
					else
					if(strlen($row['ISD4']) == 0 OR strlen($row['ISDT2']) > 0)	 
					{	
                        $row['ISD4'] = $row_av2['noOfIVDoses'];
					}
                    else
					if(strlen($row['ISDT1']) == 0 OR strlen($row['ISDT2']) > 0)	 
                    {						
                        $row['ISDT1'] = $row_av2['noOfIVDoses'];	
                    }
                    else
					if(strlen($row['ISDT2']) == 0 OR strlen($row['ISDT2']) > 0)
                    {						
                        $row['ISDT2'] = $row_av2['noOfIVDoses'];	
					}}}}
					
				
				$AVQry3 = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND 
				           av.pregnancyWeek > 27 AND av.pregnancyWeek <= 34";
								
				$AVRes3 =  mysqli_query($conn,$AVQry3);
                if($AVRes3) {	
                while($row_av3 = mysqli_fetch_array($AVRes3)) {	
					
						
					$row['Hb3'] = $row_av3['Hb'] ;
				    $row['FST'] = $row_av3['fastingSugar'];
				    $row['BT1'] = $row_av3['bloodTransfusion'];
	                  if($row_av3['bloodTransfusion'] == "1")
						{	
							$row['BT1'] = "Normal";
						}
                        else
						if($row_av3['bloodTransfusion'] == "2")	
						{	
							$row['BT1'] = "Blood Transfussion";
						}	
						 else
						if($row_av3['bloodTransfusion'] == "3")	
						{	
							$row['BT1'] = "Iron Sucrose";
						}	
				}}
					
					$AVQry4 = "SELECT * From antenatalvisit av where $ar_picme = av.picmeno AND 
				           av.pregnancyWeek > 34";
								
				$AVRes4 =  mysqli_query($conn,$AVQry4);
                if($AVRes4) {	
                while($row_av4 = mysqli_fetch_array($AVRes4)) {	
					
					$row['Hb4'] = $row_av4['Hb'] ;
				    $row['BT2'] = $row_av4['bloodTransfusion'];	
						if($row_av4['bloodTransfusion'] == "1")
						{	
							$row['BT2'] = "Normal";
						}
                        else
						if($row_av4['bloodTransfusion'] == "2")	
						{	
							$row['BT2'] = "Blood Transfussion";
						}	
						 else
						if($row_av4['bloodTransfusion'] == "3")	
						{	
							$row['BT2'] = "Iron Sucrose";
						}	
					
				}}
						
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
                       ?>
                        <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $row['picmeno']; ?></td>
					       <td><?php echo date('d-m-Y', strtotime($row['anRegDate' ])); ?></td>
				           <td><?php echo $rowh['BlockName']; ?></td>
                           <td><?php echo $rowh['PhcName']; ?></td>
                           <td><?php echo $rowh['HscName']; ?></td>
			               <td><?php echo $rowh['PanchayatName']; ?></td>
                           <td><?php echo $rowh['VillageName']; ?></td>
						   
						   <td><?php echo $row['residenttype']; ?></td>
						   
                           <td><?php echo $row['motheraadhaarname']; ?></td>
					       <td><?php echo $row['MotherAge']; ?></td>
					       <td><?php echo $row['husbandaadhaarname']; ?></td>
			               <td><?php echo $row['mothermobno']; ?></td>
					       <td><?php echo $row['obstetricCode']; ?></td>									   
					       <td><?php echo date('d-m-Y', strtotime($row['lmpdate' ])); ?></td>
                           <td><?php echo date('d-m-Y', strtotime($row['edddate' ])); ?></td> 
						   
						   <td><?php echo $row['motherWeight']; ?></td>	
						   
						    <td><?php echo $row['Hb1']; ?></td>	
						   
						    <td><?php echo $row['Hb2']; ?></td>	
							<td><?php echo $row['ISD1']; ?></td>
                            <td><?php echo $row['ISD2']; ?></td>	
                            <td><?php echo $row['ISD3']; ?></td>
                            <td><?php echo $row['ISD4']; ?></td>
                            <td><?php echo $row['ISDT1']; ?></td>		
                            <td><?php echo $row['ISDT2']; ?></td>									
					       
					       <td><?php echo $row['Hb3']; ?></td>
						   <td><?php echo $row['FST']; ?></td>
						   <td><?php echo $row['BT1']; ?></td>
						   
						   <td><?php echo $row['Hb4']; ?></td>
						   <td><?php echo $row['BT2']; ?></td>
					     </tr>
                         <?php 
                           $cnt++;
						}
							
						 }}
                         } 
                       } ?>
	   
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
		 