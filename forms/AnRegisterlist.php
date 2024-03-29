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
              <div class="card">
                <h5 class="card-header"><span class="text-muted fw-light">Antenatal Registration /</span> Antenatal Registration List
                <a href="AnRegister.php" type="button" class="btn btn-primary" style="float:right;">
                    <span class="bx bx-plus"></span>&nbsp; Add Antenatal
                </a>
                </h5>
                <div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Mother Name</th>
                        <th>RCHID (PICME) No.</th>
                        <th>Resident Type</th>
                        <th>Pregnancy Test Result</th>
                        <th>HR Pregnancy</th>
                        <th>View</th>
                      </tr>
                    </thead>
<?php
  $listQry = "SELECT an.motheraadhaarid,an.id,an.picmeno,ec.motheraadhaarname,an.residentType,an.pregnancyTestResult,an.gravida,an.para,an.hrPregnancy,an.createdBy,ec.BlockId,ec.PhcId,ec.HscId FROM anregistration an JOIN ecregister ec on ec.motheraadhaarid=an.motheraadhaarid WHERE an.status=1"; 
  $private = " AND an.createdBy='".$userid."'";
  $orderQry = " ORDER BY ec.motheraadhaarname ASC";
    
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
                                    <td><?php $rt = $row['residentType'];
                                    if($rt == 1) { echo "RESIDENT";}elseif($rt == 2){ echo "VISITOR"; }
                                    ?></td>
                                    <td><?php $ptr = $row['pregnancyTestResult'];
                                    if($ptr == 1) { echo "Positive";}elseif($ptr == 2){ echo "Negative"; }elseif($ptr == 3){ echo "Not Done";}?></td>
                                  <td><?php $hr = $row['hrPregnancy'];
                                    if($hr == 1) { echo "Yes";}elseif($hr == 0){ echo "No"; }
                                    ?></td>
                                    <td ><a id="view" name="view" href="../forms/ViewEditAntenatal.php?view=<?php echo $row['id']; ?>" ><i  class="bx bx-show me-1"></i>View</a></td>
                                </tr>
                    <?php 
                        $cnt++;
                      } 
                    } ?>     
                  </table></div>
                </div>
              </div>
              <!--/ Hoverable Table rows -->
              <script>
  

              </script>
<?php include ('require/dtFooter.php'); ?>