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
                  <span class="text-muted fw-light">Reports / Eligible Couples / </span> Above Teenage List (Non Pregnant Couples)
               </h5>  
			   
<!------------------------------------------------------------------------------------- Page Details + search button + Table -------------------------------------------------------->		   
			<div class="table-responsive text-nowrap">		 
	 
	        <div class="container"> 
			<div class="table-responsive text-nowrap">	
	       		
		   <table id="users-detail"  class="display nowrap" cellspacing="0" width="100%"> 
			
                       <thead>
                         <tr>
               <th>S.No</th> 
			   <th>ECFR No</th>
               <th>RCHID (PICME) No.</th>
			   <th>EC Registered Date</th>
			   <th>Mother's Aadhar No</th>
			   <th>Mother's Aadhar Name</th>
			   <th>Mother's Mobile No</th>
			   <th>Mother's Age @ EC Registration</th>
               <th>Block</th>
               <th>PHC</th>
               <th>HSC</th>
			   <th>VP / TP / Mpty</th>
               <th>Village / Ward</th>
			  
                         </tr>
                       </thead>  
					   
    <?php
      $listQry = "SELECT ec.picmeNo, ec.id, hs.BlockName,hs.PhcName,hs.HscName, hs.PanchayatName, hs.VillageName,ec.ecfrno, ec.HscId, ec.VillageId, ec.PanchayatId, ec.dateecreg, ec.motherageecreg, ec.motheraadhaarname, ec.BlockId,ec.PhcId, ec.mothermobno,ec.motheraadhaarid FROM ecregister ec INNER JOIN hscmaster hs on (ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId = hs.HscId AND ec.VillageId = hs.VillageId AND ec.PanchayatId = hs.PanchayatId) WHERE ec.status!= 0 
                  AND ec.motherageecreg >= 18 AND NOT EXISTS (SELECT ar.picmeno FROM anregistration ar WHERE ar.picmeno = ec.picmeNo)";   
	 
	  //$listQry = "SELECT DISTINCT(ec.motheraadhaarid),id,picmeno, ecfrno, HscId, VillageId, PanchayatId, dateecreg, motherageecreg, motheraadhaarname, BlockId, PhcId, mothermobno FROM ecregister WHERE status!=0 AND 
        //          ec.motherageecreg >= 18";  
	
	 
       
	  $private = " AND ec.createdBy='".$userid."'";
      $orderQry = " ORDER BY ec.dateecreg DESC";
	  
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
                       $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$BlockId."'".$orderQry);
                       }  else {
                       $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
                        } 
						
              if($ExeQuery) {
                $cnt=1;
                while($row = mysqli_fetch_array($ExeQuery)) {
						  ?>
                        <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $row['ecfrno']; ?></td>
						   <td><?php echo $row['picmeno']; ?></td>
						   <td><?php echo date('d-m-Y', strtotime($row['dateecreg'])); ?></td>
						   <td><?php echo $row['motheraadhaarid']; ?></td>
						   <td><?php echo $row['motheraadhaarname']; ?></td>
						   <td><?php echo $row['mothermobno']; ?></td>
						   <td><?php echo $row['motherageecreg']; ?></td>
						   <td><?php echo $row['BlockName']; ?></td>
                           <td><?php echo $row['PhcName']; ?></td>
                           <td><?php echo $row['HscName']; ?></td>
			               <td><?php echo $row['PanchayatName']; ?></td>
                           <td><?php echo $row['VillageName']; ?></td>
					     </tr>
                         <?php 
                           $cnt++;
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
    <form action="ECAbvTageExp.php" method="post" id="filterform" style="width:100%";>	
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
		 
		