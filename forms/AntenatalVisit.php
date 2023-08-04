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
                   <h5 class="card-header"><span class="text-muted fw-light">Antenatal Visit /</span> Antenatal Visit List
                   <a href="AddAnVisit1.php" id="add" type="button" class="btn btn-primary" style="float:right;">
						<span class="bx bx-plus"></span>&nbsp; Add Antenatal Visit
					</a>
                   </h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="antenetal-visit-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>     
               <th>Mother Name</th>
               <th>PICME No.</th>
			   <th>Antenatal Visit Count</th>
               <th>Resident Type</th>
               <th>Visit Date</th>
               <th>Pregnancy Week</th>
               <th>View</th>
                         </tr>
                       </thead>                        
<?php
  $listQry = "SELECT DISTINCT(av.picmeno),av.id, av.residenttype,av.placeofvisit,av.anvisitDate,av.pregnancyWeek,av.ancPeriod,ec.motheraadhaarname,av.createdBy,ec.BlockId,ec.PhcId,ec.HscId FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE av.status=1";
  $private = " AND av.createdBy='".$userid."'";
  $orderQry = " ORDER BY av.picmeno + av.ancPeriod ASC";
    
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
            } else {
                $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
            }
              if($ExeQuery) {
                         $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
                       ?>
                                   <tr>
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['motheraadhaarname']; ?></td>
                                       <td><?php echo $row['picmeno']; ?></td>
									   <td><?php echo $row['ancPeriod']; ?></td>
                                       <td><?php $rt = $row['residenttype'];
                                    if($rt == 1) { echo "RESIDENT";}elseif($rt == 2){ echo "VISITOR"; }
                                    ?></td>
                                       <td><?php echo date('d-m-Y', strtotime($row['anvisitDate'])); ?></td>
									                     <td><?php echo $row['pregnancyWeek']; ?></td>
                                       <td ><a id="view" name="view" href="../forms/ViewEditAnVisit.php?view=<?php echo $row['id']; ?>" ><i  class="bx bx-show me-1"></i>View</a></td>

                        </tr>
                       <?php 
                           $cnt++;
                         } 
                       } ?>
                     </table></div>
                   </div>
                 </div>
                 <!--/ Hoverable Table rows -->
<?php include ('require/dtFooter.php'); ?>