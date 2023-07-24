
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
                   <h5 class="card-header"><span class="text-muted fw-light">Pregnancy Status /</span> Mother Pregnancy Status
                   </h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th> 
               <th>Mother Name</th>
               <th>PICME Number</th>
               <th>Mother Status</th>
                         </tr>
                       </thead>
   
    <?php 
  //  $listQry = "SELECT * FROM `ecregister` WHERE status NOT IN(0,1) AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ec.picmeNo)";
    $listQry = "SELECT * FROM `ecregister` ec WHERE status NOT IN(0,1) AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ec.picmeNo)";
	$private = " AND createdBy='".$userid."'";
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
                                       <td><?php echo $row['motheraadhaarname']; ?></td>
                                       <td><?php echo $row['picmeNo']; ?></td>
                                       <td><?php $mstatus=$row['status'];
                                       if($mstatus==2){ echo "Antenatal"; }
                                       else if($mstatus==3){ echo "Postnatal"; }
                                       else if($mstatus==5){ echo "Teenage Pregnancy"; } 
                                       else if($mstatus==6){ echo "High Risk Pregnancy"; } ?></td>
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
