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
                  <span class="text-muted fw-light">Reports / Delivery Details / </span> Delivered List
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
			   <th>Mobile No</th>
			   <th>Address</th>
               <th>Delivery Date</th>
               <th>Delivery Hospital Type</th>
               <th>Delivery Type</th>
               <th>Outcome</th> 
			   <th>Family Welfare Method</th> 
                         </tr>
                       </thead>  
    <?php
	
//	$tst = "Hello  world ";
//	print_r(trim($tst)); 
	//print_r(strlen($tst)); exit;
	
      // $listQry = "SELECT av.picmeno,av.id, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy,hs.BlockName,hs.PhcName,hs.HscName, ec.BlockId,ec.PhcId, hs.PanchayatName, hs.VillageName, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN hscmaster hs on (hs.BlockId = ec.BlockId AND hs.PhcId = ec.PhcId AND ec.HscId = hs.HscId AND ec.VillageId = hs.VillageId AND ec.PanchayatId = hs.PanchayatId) JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
      //              WHERE av.status=1";             

      //  $listQry = "SELECT hs.BlockName,hs.PhcName,hs.HscName, hs.PanchayatName, hs.VillageName hscmaster hs on (hs.BlockId = ec.BlockId AND hs.PhcId = ec.PhcId AND ec.HscId = hs.HscId AND ec.VillageId = hs.VillageId AND ec.PanchayatId = hs.PanchayatId)";         
		
      $listQry = "SELECT dd.picmeno,ar.residentType, dd.deliverydate, dd.hospitaltype, dd.deliverytype,dd.deliveryOutcome, dd.id, ec.address, ec.HscId, ec.VillageId, ec.PanchayatId, ar.picmeRegDate, ar.MotherAge, ec.motheraadhaarname,dd.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno
             	  FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno JOIN anregistration ar on dd.picmeno = ar.picmeno
                  WHERE dd.status!=0 AND NOT EXISTS (SELECT pv.picmeNo FROM postnatalvisit pv WHERE pv.picmeNo = dd.picmeno)";  		
	  $private = " AND dd.createdBy='".$userid."'";
      $orderQry = " ORDER BY dd.deliverydate DESC";
	  
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
							//  print_r($row['Test']); exit;
						//	 if($row['HscId']== $Hsc_val)
							// {print_r($rowh['BlockName']); exit;}
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
							if($row['residentType'] == "1")
							{
							 $row['residentType'] = "RESIDENT";
							}
							
							if($row['residentType'] == "2")	
							{
							 $row['residentType'] = "VISITOR";
							}	
							if($row['deliverytype'] == "1")
							{
							    $row['deliverytype'] = "Normal";
							}	
							if($row['deliverytype'] == "2")	
							{
							 $row['deliverytype'] = "Caesarian";
							}	
							if($row['deliverytype'] == "3")	
							{
							 $row['deliverytype'] = "Assisted";
							}	
							
							if($row['deliveryOutcome'] == "1")	
							{
							$row['deliveryOutcome'] = "Live Birth";}
							else								
							    if($row['deliveryOutcome'] == "2")	
							    {
								$row['deliveryOutcome'] = "Still Birth"; }
								 else
							    	 if($row['deliveryOutcome'] == "3")	
							         {
									 $row['deliveryOutcome'] = "IUD"; }
									   else
										   if($row['deliveryOutcome'] == "4")	
										   {
                                           $row['deliveryOutcome'] = "Live Birth and Still Birth"; 											   
						                   }	
										   
										//   1.None2.Condom3.Male sterilization4.IUCD-PP5.PP-PS6.Any traditional methods7.Any others specify
										   
										  
						         	
       $ppcMethod = "";
	   $ppcQry = "SELECT ppcMethod,picmeNo From postnatalvisit";		/*Fetching ppcMethod From postnatalvisit*/		 
	   $ppcRes =  mysqli_query($conn,$ppcQry);
       if($ppcRes) {
         while($rowp = mysqli_fetch_array($ppcRes)) 
		 {
		//  if(($row['picmeno']==$rowp['picmeNo']) AND ($rowp['ppcMethod'] == "4" OR $rowp['ppcMethod'] == "5"))
			 if($row['picmeno']==$rowp['picmeNo']) 
			 {
				 	if($rowp['ppcMethod'] == "1")	
							{
							$rowp['ppcMethod'] = "None";}
							else								
							    if($rowp['ppcMethod'] == "2")	
							    {
								$rowp['ppcMethod'] = "Condom"; }
								 else
							    	 if($rowp['ppcMethod'] == "3")	
							         {
									 $rowp['ppcMethod'] = "Male sterilization"; }
									   else 
										   if($rowp['ppcMethod'] == "4")	
										   {
                                           $rowp['ppcMethod'] = "IUCD-PP"; 											   
						                   }
                                           else
	                                       if($rowp['ppcMethod'] == "5")	
										   {
                                           $rowp['ppcMethod'] = "PP-PS"; 											   
						                   }	
                                          else
											if($rowp['ppcMethod'] == "6")	
										   {
                                           $rowp['ppcMethod'] = "Any traditional methods"; 											   
						                   }	
										   else
										   if($rowp['ppcMethod'] == "7")	
										   {
                                           $rowp['ppcMethod'] = "Any others specify"; 	
                                           								   
		 }		
		 if($rowp['ppcMethod'] == "8")	
										   {
                                           $rowp['ppcMethod'] = "Inj antara and Tab chaya"; 	
                                           								   
		 }	
		                                   $ppcMethod = $rowp['ppcMethod'];		}}  
										   
										   	if($row['hospitaltype'] == "1")	
							{
							$row['hospitaltype'] = "HSC";}
							else								
							    if($row['hospitaltype'] == "2")	
							    {
								$row['hospitaltype'] = "PHC"; }
								 else
							    	 if($row['hospitaltype'] == "3")	
							         {
									 $row['hospitaltype'] = "UG PHC"; }
									   else 
										   if($row['hospitaltype'] == "4")	
										   {
                                           $row['hospitaltype'] = "GH"; 											   
						                   }
                                           else
	                                       if($row['hospitaltype'] == "5")	
										   {
                                           $row['hospitaltype'] = "MCH"; 											   
						                   }	
                                           else
											if($row['hospitaltype'] == "6")	
										   {
                                           $row['hospitaltype'] = "Private Hospital"; 											   
						                   }	
										   else
										   if($row['hospitaltype'] == "7")	
										   {
                                           $row['hospitaltype'] = "PNH"; 											   
						                   }	
                                           if($row['hospitaltype'] == "8")	
										   {
                                           $row['hospitaltype'] = "Home"; 											   
						                   }											   
              //  $row['hospitaltype'] = $row['hospitaltype']; 		
	
                       ?>
                        <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $row['picmeno']; ?></td>
					       <td><?php echo date('d-m-Y', strtotime($row['picmeRegDate'])); ?></td>
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
						   
						   <td><?php echo $row['address']; ?></td>
						   <td><?php echo date('d-m-Y', strtotime($row['deliverydate'])); ?></td>
					       <td><?php echo $row['hospitaltype']; ?></td>									   
					       <td><?php echo $row['deliverytype']; ?></td>
                           <td><?php echo $row['deliveryOutcome']; ?></td> 
					       <td><?php echo $ppcMethod; ?></td>
					     </tr>
                         <?php 
                           $cnt++;
						}
							
						 }}
                         } 
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
    <form action="DDListExp.php" method="post" id="filterform" style="width:100%";>	
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
		 
		