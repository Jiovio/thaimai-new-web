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
                <h5 class="card-header">
                               
           <span class="text-muted fw-light">Eligible Couples / </span>Eligible Couples List
           <a href="AddEc.php" type="button" class="btn btn-primary" style="float:right;">
                    <span class="bx bx-plus"></span>&nbsp; Add Eligible Couple
                </a>
                </h5>    
  <div class="table-responsive text-nowrap">
			<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No</th>            
                        <th>ECFR.No</th>
                        <th>Registered Date</th>
                        <th>Mother ID</th>
                        <th>Mother Name</th>
                        <th>Husband ID</th>
						<th>View</th>
                      </tr>
                    </thead>
<?php  
  $listQry = "SELECT DISTINCT(motheraadhaarid),id,ecfrno,dateecreg,motheraadhaarname,husbandaadhaarid,BlockId,PhcId,HscId,status FROM ecregister WHERE status!=0";
  $private = " AND ec.createdBy='".$userid."'";
  $orderQry = " ORDER BY motheraadhaarname ASC";

  if(($usertype == 0) || ($usertype == 1)) {
    if(isset($_POST['filter'])) {
      $bloName = $_POST['BlockId']; 
      $phcName = $_POST['PhcId'];
      $hscName = $_POST['HscId'];        
                if($bloName == "" && $phcName == "" && $hscName == ""){
                  $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                } else if($bloName != "" && $phcName == "" && $hscName == ""){
                  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."'".$orderQry);
                } else if($bloName != "" && $phcName != "" && $hscName == ""){
                  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."'".$orderQry);
                } else if($bloName != "" && $phcName != "" && $hscName != ""){
                  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."'".$orderQry);
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
                                    <td><?php $ecreg = $row['dateecreg']; echo date("d-m-Y", strtotime($ecreg)); ?></td>
                                    <td><?php echo $row['motheraadhaarid']; ?></td>
                                    <td><?php echo $row['motheraadhaarname']; ?></td>
                                    <td><?php echo $row['husbandaadhaarid']; ?></td>
                                    <td><a href="../forms/ViewEditEc.php?view=<?php echo $row['id']; ?>"><i class="bx bx-show me-1"></i>View</a></td>
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