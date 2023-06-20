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
                   <h5 class="card-header">High Risk Mothers List</h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>            
               <th>PICME No.</th>
               <th>Mother Name</th>
               <th>High Risk Factor</th>
                         </tr>
                       </thead>
<?php  
$pre_picme = "";
$query = "SELECT enumid,enumvalue FROM enumdata WHERE type > 0";
$exequery = mysqli_query($conn, $query);
$periodAr= array();
while ($listvalue = mysqli_fetch_assoc($exequery)) {
    $periodAr[$listvalue['enumid']] = $listvalue['enumvalue'];
}
//$listQry = "SELECT DISTINCT(hr.picmeNo),ec.motheraadhaarname,hr.highRiskFactor,ec.BlockId,ec.PhcId,ec.HscId from highriskmothers hr JOIN ecregister ec on hr.picmeNo=ec.picmeno WHERE hr.status=1";
$listQry = "SELECT DISTINCT(hr.picmeNo),hr.highRiskFactor from highriskmothers hr WHERE hr.status=1";
$orderQry = " ORDER BY hr.picmeNo ASC";

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
      }  else {
          $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
      }
                       if($ExeQuery) {
                         $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
							
							 
							 $listQry_ec = "SELECT ec.motheraadhaarname, ec.picmeno from ecregister ec";
							 $ExeQuery_ec = mysqli_query($conn,$listQry_ec);
							 while($row_e = mysqli_fetch_array($ExeQuery_ec))
							 {
								 if($pre_picme!=$row['picmeNo'])
									 
								 { 
							 if ($row['picmeNo'] == $row_e['picmeno'])
							 {
                       ?>
                                   <tr>
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['picmeNo']; ?></td>
                                       <td><?php echo $row_e['motheraadhaarname']; ?></td>
                                       <?php
                                       $highRiskFactor="";
                                        if(isset($periodAr[$row['highRiskFactor']])){
                                            $highRiskFactor = $periodAr[$row['highRiskFactor']];
                                        } 
                                       ?>
                                       <td><?php echo $highRiskFactor; ?></td>
								   </tr>
                       <?php 
                           $cnt++;
						   $pre_picme = $row['picmeNo'];
                         } 
						 }}} /* New */
                       } ?>
                     </table></div>
                   </div>
                 </div>
      <!--/ Hoverable Table rows -->
<?php include ('require/dtFooter.php'); ?>