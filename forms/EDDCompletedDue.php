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
                <h5 class="card-header"><span class="text-muted fw-light"> Due List /</span> EDD Crossed Mother's List</h5>
				<div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No.</th>            
                        <th>PICME Number</th>
						<th>Mother's Aadhaar Name</th>
                        <th>EDD Completed Date</th>
						<th>Mother's Mobile No.</th>
						<th>Village Id</th>
						<th>Entered By</th>
						<!--<th>View</th>-->
                      </tr>
                    </thead>
<?php 
  $listQry = "SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.id,mh.edddate,ec.mothermobno,mh.createdBy,ec.BlockId,u.name, ec.PhcId,ec.HscId FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy WHERE 
NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = mh.picmeno) AND
date_format(str_to_date(mh.edddate, '%m/%d/%Y'), '%Y-%m-%d') < CURRENT_DATE() AND mh.status!=0";
$private = " AND mh.createdBy='".$userid."'";
$orderQry = " ORDER BY mh.edddate DESC";
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
      $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
  }
                   if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['picmeno']; ?></td>
									<td><?php echo $row['motheraadhaarname']; ?></td>
		                            <td><?php $dd = date('Y-m-d',strtotime($row['edddate'])); echo $dd;?></td>
									
                                    <td><?php echo $row['mothermobno']; ?></td>
									<td><?php echo $row['PhcId']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
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