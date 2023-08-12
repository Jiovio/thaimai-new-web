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
                  <span class="text-muted fw-light">Reports / Antenatal Visit / </span> GDM
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
			   <th>GCT Weeks (12-16)</th>
			   <th>GCT Weeks (24-28)</th>
			   <th>GCT Weeks (32-34)</th>
			   
        <!--       <th>PPBS</th>  !Not present in form
			   <th>Metformin Treatment</th>
			   <th>Insulin Treatment</th> --!>
                         </tr>
                       </thead>  
    <?php
    
      $listQry = "SELECT av.picmeno, av.gctStatus, av.ancPeriod, av.id, av.symptomsHighRisk, av.residenttype, av.motherWeight, av.gctValue, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status!=0 AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno) AND av.gctStatus != 4 
				  AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)
				  AND av.gctValue > 140";  		
				  
				  //  AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)
				   	
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
					$gdm_picme = "";
					$gdm_picme = $row['picmeno'];
					$row['gctweek1'] = "";
					$row['gctweek2'] = "";
					$row['gctweek3'] = "";
					$listQry_GCT_Week1 = "SELECT av.gctStatus, av.gctValue, av.motherWeight FROM antenatalvisit av WHERE av.picmeno = $gdm_picme and av.gctStatus = 1";
					                  //    av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)))"; 
					$ExeQuery_Week1 = mysqli_query($conn, $listQry_GCT_Week1); 
					if($ExeQuery_Week1) {
						while($wk1 = mysqli_fetch_array($ExeQuery_Week1))
						{
						//	print_r("I am here First"); 
							
							$row['gctweek1'] = $wk1['gctValue'];  
							
							$row['motherWeight'] = $wk1['motherWeight'];
						//	print_r($wk1['gctweek1']); 
	                    }}
						
					$listQry_GCT_Week2 = "SELECT av.gctStatus, av.gctValue, av.motherWeight FROM antenatalvisit av WHERE av.picmeno = $gdm_picme and av.gctStatus = 2";
					                  //    av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)))"; 
					$ExeQuery_Week2 = mysqli_query($conn, $listQry_GCT_Week2); 
					if($ExeQuery_Week2) {
						while($wk2 = mysqli_fetch_array($ExeQuery_Week2))
						{
						//	print_r("I am here Second"); 
							
							$row['gctweek2'] = $wk2['gctValue'];
							
							$row['motherWeight'] = $wk2['motherWeight'];
						//	print_r($wk2['gctweek2']); 
	                    }}
						
						$listQry_GCT_Week3 = "SELECT av.gctStatus, av.gctValue, av.motherWeight FROM antenatalvisit av WHERE av.picmeno = $gdm_picme and av.gctStatus = 3";
					                  //    av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)))"; 
					$ExeQuery_Week3 = mysqli_query($conn, $listQry_GCT_Week3); 
					if($ExeQuery_Week3) {
						while($wk3 = mysqli_fetch_array($ExeQuery_Week3))
						{
						//	print_r("I am here Third"); 
							
							$row['gctweek3'] = $wk3['gctValue'];
							
							$row['motherWeight'] = $wk3['motherWeight'];
						//	print_r($wk3['gctweek3']); exit;
	                    }}
						
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
							
                            						
                       ?>
                        <tr>
                          <td><?php echo $cnt; ?></td>  
						   <td><?php echo $row['picmeno'] ;  ?></td> 
					       <td><?php echo date('d-m-Y', strtotime($row['anRegDate' ]));  ?></td> 
				           <td><?php echo $rowh['BlockName'] ;  ?></td> 
                           <td><?php echo $rowh['PhcName'] ;  ?></td> 
                           <td><?php echo $rowh['HscName'] ;  ?></td> 
			               <td><?php echo $rowh['PanchayatName'] ; ?></td>  
                           <td><?php echo $rowh['VillageName'] ;  ?></td> 
						   <td><?php echo $row['residenttype'] ; ?></td>  
                           <td><?php echo $row['motheraadhaarname'] ;  ?></td> 
					       <td><?php echo $row['MotherAge'] ;  ?></td> 
					       <td><?php echo $row['husbandaadhaarname'] ;  ?></td> 
			               <td><?php echo $row['mothermobno'] ;  ?></td> 
					       <td><?php echo $row['obstetricCode'] ;  	?></td> 								   
					       <td><?php echo date('d-m-Y', strtotime($row['lmpdate'] ));  ?></td> 
                           <td><?php echo date('d-m-Y', strtotime($row['edddate'] )); ?></td> 
						   <td><?php echo $row['motherWeight']; ?></td> 
				           <td><?php echo $row['gctweek1'] ; ?></td>
				           <td><?php echo $row['gctweek2'] ; ?></td>
					       <td><?php echo $row['gctweek3'] ; ?></td> 
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
    <form action="GDMListExp.php" method="post" id="filterform" style="width:100%";>	
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
		 
		