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
                  <span class="text-muted fw-light">Reports / High Risk / </span> PIH
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
			   
               <th>BP Systolic</th>
			   <th>BP Diastolic</th>
			   <th>Mid-Trimester Fall</th>
			   <th>Urine Albumin Present (Yes/No)?</th>
			   <th>No of Calcium Tablet</th>
			   <th>Treatment</th>
			       
			   
			   
                         </tr>
                       </thead>  
    <?php
     
      $listQry = "SELECT av.picmeno,av.id, av.motherWeight, av.bpSys, av.bpDia, av.pregnancyWeek,av.urineAlbuminPresent,av.noCalcium, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND av.symptomsHighRisk = 6 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno) AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)";
	
	  $private = " AND av.createdBy='".$userid."'";
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
						//	  print_r($row['HscId']);
						//	 if($row['HscId']== $Hsc_val)
							// {print_r($rowh['BlockName']); exit;}
						
						$row['treatment'] = "Taken";
						
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
							if($row['urineAlbuminPresent'] == "1")
							{
							    $row['urineAlbuminPresent'] = "Yes";
							}	
							if($row['urineAlbuminPresent'] == "0")	
							{
							 $row['urineAlbuminPresent'] = "No";
							}		
							if($row['urineAlbuminPresent'] == "0")	
							
                            $Week_13_28 = "";						
							$Week_13_28 = $row['pregnancyWeek'];
								
					if($Week_13_28 > 13 AND $Week_13_28 < 28)
					{
			        	$row['pregnancyWeek'] = $row['pregnancyWeek'];
					}
					else
					{
			        	$row['pregnancyWeek'] = "";
					}	
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
						   
						   <td><?php echo $row['residenttype']; ?></td>
						   
                           <td><?php echo $row['motheraadhaarname']; ?></td>
					       <td><?php echo $row['MotherAge']; ?></td>
					       <td><?php echo $row['husbandaadhaarname']; ?></td>
			               <td><?php echo $row['mothermobno']; ?></td>
					       <td><?php echo $row['obstetricCode']; ?></td>									   
					       <td><?php echo date('d-m-Y', strtotime($row['lmpdate'])); ?></td>
                           <td><?php echo date('d-m-Y', strtotime($row['edddate'])); ?></td> 
						   
						   <td><?php echo $row['motherWeight']; ?></td>	
						   <td><?php echo $row['bpSys']; ?></td>	
						   <td><?php echo $row['bpDia']; ?></td>	
						   <td><?php echo $row['pregnancyWeek']; ?></td>
						   <td><?php echo $row['urineAlbuminPresent']; ?></td>	
						   <td><?php echo $row['noCalcium']; ?></td>
					       
					       <td><?php echo $row['treatment']; ?></td>
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
    <form action="PIHListExp.php" method="post" id="filterform" style="width:100%";>	
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
		 
		