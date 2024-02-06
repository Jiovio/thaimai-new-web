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
                  <span class="text-muted fw-light">Reports / Antenatal Visit / </span> Antenatal Visit List
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
			   <th>Antenatal Visit Count</th>
               <th>AN Registered Date</th>
               <th>Block</th>
               <th>PHC</th>
               <th>HSC</th>
			   <th>VP / TP / Mpty</th>
               <th>Village / Ward</th>
               <th>Mother Name</th>
               <th>Age</th>
               <th>Husband Name</th>
			   <th>Mobile No.</th>
               <th>Obstetric score</th>
               <th>LMP</th>
               <th>EDD</th>
               <th>Gestational Age in Weeks</th>
			   <th>High Risk Factor</th>
                         </tr>
                       </thead>  
    <?php
      // $listQry = "SELECT av.picmeno,av.id, av.symptomsHighRisk, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy,hs.BlockName,hs.PhcName,hs.HscName, ec.BlockId,ec.PhcId, hs.PanchayatName, hs.VillageName, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN hscmaster hs on (hs.BlockId = ec.BlockId AND hs.PhcId = ec.PhcId AND ec.HscId = hs.HscId AND ec.VillageId = hs.VillageId AND ec.PanchayatId = hs.PanchayatId) JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
      //              WHERE av.status=1";             

      //  $listQry = "SELECT hs.BlockName,hs.PhcName,hs.HscName, hs.PanchayatName, hs.VillageName hscmaster hs on (hs.BlockId = ec.BlockId AND hs.PhcId = ec.PhcId AND ec.HscId = hs.HscId AND ec.VillageId = hs.VillageId AND ec.PanchayatId = hs.PanchayatId)";         
		
      $listQry = "SELECT av.picmeno,av.id, av.symptomsHighRisk, av.ancPeriod, ec.HscId, ec.VillageId, ec.PanchayatId, ar.anRegDate, ar.obstetricCode, ar.MotherAge, av.residenttype,av.placeofvisit,av.anvisitDate, av.pregnancyWeek,ec.motheraadhaarname,av.createdBy, ec.BlockId,ec.PhcId, ec.husbandaadhaarname, ec.mothermobno, mh.picmeno,mh.lmpdate, mh.edddate FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN anregistration ar on ar.picmeno=av.picmeno JOIN medicalhistory mh on mh.picmeno = av.picmeno
                  WHERE av.status=1 
				  AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)
				  AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = av.picmeno)";    		
				     		
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
						 $sym_hr_id = "";
                         $sym_hr_id = $row['symptomsHighRisk'];						 
						 $enumQry = "SELECT * From enumdata where enumdata.id = '$sym_hr_id' and enumdata.type = '51'";				 
			             $enumRes =  mysqli_query($conn,$enumQry);
							
							
							
                       ?>
                        <tr>
                           <td><?php echo $cnt; ?></td>
						   <td><?php echo $row['picmeno']; ?></td>
						   <td><?php echo $row['ancPeriod']; ?></td>
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
					       <td><?php echo $row['obstetricCode']; ?></td>									   
					       <td><?php echo date('d-m-Y', strtotime($row['lmpdate'])); ?></td>
                           <td><?php echo date('d-m-Y', strtotime($row['edddate'])); ?></td> 
					       <td><?php echo $row['pregnancyWeek']; ?></td>
					       <td><?php echo $enumRes['enumvalue']; ?></td>
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
    <form action="AVEcExport.php" method="post" id="filterform" style="width:100%";>	
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
		 
		