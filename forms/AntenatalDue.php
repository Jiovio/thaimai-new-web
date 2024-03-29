<?php include ('require/topHeader.php'); ?>
<body>
  	<!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu
	  include ('require/filter.php'); // Top Filter ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
			<!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header"><span class="text-muted fw-light">Current Month Due /</span> Antenatal Due List</h5>
				<div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No</th>            
                        <th>RCHID (PICME) Number</th>
						            <th>Mother's Aadhaar Name</th>
                        <th>AV Due Date</th>
						            <th>Mother's Mobile No.</th>
						            <th>Village Id</th>
						            <th>Entered By</th>
						<!--<th>View</th>-->
                      </tr>
                    </thead>
<?php  

$listQry = "SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,av.avdueDate,ec.mothermobno, av.anvisitDate, ec.picmeNo, ec.PhcId,u.name,ec.BlockId,ec.HscId FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno 
LEFT JOIN users u on av.createdBy=u.id 
WHERE YEAR(av.avdueDate) = YEAR(CURRENT_DATE()) AND Month(av.avdueDate) = Month(CURRENT_DATE()) AND av.status!=0";
$private = " AND av.createdBy='".$userid."'";
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
  }  else {
      $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
  }
                   if($ExeQuery) {
					                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['picmeNo']; ?></td>
									<td><?php echo $row['motheraadhaarname']; ?></td>
                                    <td><?php  $dd = date('m-d-Y',strtotime($row['avdueDate'])); echo $dd; ?></td>
                                    <td><?php echo $row['mothermobno']; ?></td>
									<td><?php echo $row['PhcId']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
									<!--<td><a href="../forms/ViewEditMedical.php?view=<?php echo $row['id']; ?>"><i class="bx bx-show me-1"></i>View</a></td>-->
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