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
                  <span class="text-muted fw-light">Reports / Postnatal Visit / </span> ECs Not Following Family Welfare Methods List
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
               <th>Mother Name</th>
               <th>Age</th>
               <th>Husband Name</th>
			   <th>Mobile No</th>
               <th>Temporary Family Welfare Method</th>
                         </tr>
                       </thead>  
    <?php
      
		
      $listQry = "SELECT pv.picmeNo,pv.id, pv.ppcMethod, ec.HscId, ar.anRegDate, ec.VillageId, ec.PanchayatId, ar.MotherAge, ec.motheraadhaarname,pv.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno FROM postnatalvisit pv JOIN ecregister ec on ec.picmeNo=pv.picmeNo JOIN anregistration ar on ar.picmeno=pv.picmeNo
        WHERE pv.status!=0 AND (pv.ppcMethod = 2 OR pv.ppcMethod = 1) AND pv.pncPeriod = (SELECT max(pv1.pncPeriod) From postnatalvisit pv1 where pv1.picmeNo = pv.picmeNo)";
	
	
				     		
	  $private = " AND pv.createdBy='".$userid."'";
      $orderQry = " ORDER BY ar.anRegDate DESC";
	  
	 // print_r()
	  
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
							$ppcMethod = "";
	   $ppcQry = "SELECT ppcMethod,picmeNo From postnatalvisit";		/*Fetching ppcMethod From postnatalvisit*/		 
	   $ppcRes =  mysqli_query($conn,$ppcQry);
       if($ppcRes) {
         while($rowp = mysqli_fetch_array($ppcRes)) 
		 {
		//  if(($row['picmeno']==$rowp['picmeNo']) AND ($rowp['ppcMethod'] == "4" OR $rowp['ppcMethod'] == "5"))
			 if($row['picmeNo']==$rowp['picmeNo']) 
			 {
				 	if($rowp['ppcMethod'] == "1")	
							{
							$rowp['ppcMethod'] = "Can't decide now";}
							else								
							    if($rowp['ppcMethod'] == "2")	
							    {
								$rowp['ppcMethod'] = "None"; }
								 else
							    	 if($rowp['ppcMethod'] == "3")	
							         {
									 $rowp['ppcMethod'] = "Condom"; }
									   else 
										   if($rowp['ppcMethod'] == "4")	
										   {
                                           $rowp['ppcMethod'] = "Male sterilization"; 											   
						                   }
                                           else
	                                       if($rowp['ppcMethod'] == "5")	
										   {
                                           $rowp['ppcMethod'] = "IUCD-PP"; 											   
						                   }	
                                          else
											if($rowp['ppcMethod'] == "6")	
										   {
                                           $rowp['ppcMethod'] = "PP-PS"; 											   
						                   }	
										   else
										   if($rowp['ppcMethod'] == "7")	
										   {
                                           $rowp['ppcMethod'] = "Inj antara and Tab chaya"; 	
                                           								   
		 }		
		 if($rowp['ppcMethod'] == "8")	
										   {
                                           $rowp['ppcMethod'] = "Any Other Specify"; 	
                                           								   
		 }		
if($rowp['ppcMethod'] == "9")	
										   {
                                           $rowp['ppcMethod'] = "Any Traditional Methods"; 	
                                           								   
		 }				 			
		 $ppcMethod = $rowp['ppcMethod'];		}}
		
                       ?>
                        <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $row['picmeNo']; ?></td>
					       <td><?php echo date('d-m-Y', strtotime($row['anRegDate'])); ?></td>
				           <td><?php echo $rowh['BlockName']; ?></td>
                           <td><?php echo $rowh['PhcName']; ?></td>
                           <td><?php echo $rowh['HscName']; ?></td>
			               <td><?php echo $rowh['PanchayatName']; ?></td>
                           <td><?php echo $rowh['VillageName']; ?></td>
                           <td><?php echo $row['motheraadhaarname']; ?></td>
					       <td><?php echo $row['MotherAge']; ?></td>
					       <td><?php echo $row['husbandaadhaarname']; ?></td>
			               <td><?php echo $row['mothermobno']; ?></td>
					       <td><?php echo $ppcMethod; ?></td>
					     </tr>
                         <?php 
                           $cnt++;
						   
						}
							
						 }}
				} }
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
    <form action="ECNFWListExp.php" method="post" id="filterform" style="width:100%";>	
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
		 
		