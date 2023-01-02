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
                <h5 class="card-header"><span class="text-muted fw-light">Current Month Due /</span> Delivery Due List</h5>
				<div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No</th>            
                        <th>PICME Number</th>
						<th>Mother Aadhaar Name</th>
                        <th>EDD / Due Date</th>
						<th>Mother Mobile No.</th>
						<th>VillageId</th>
						<th>Entered By</th>
						<!--<th>View</th>-->
                      </tr>
                    </thead>
<?php if(isset($_POST['filter'])) {
	$bloName = $_POST['BlockId']; 
	$phcName = $_POST['PhcId'];

	if($bloName == "" && $phcName == "" ){
		$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.edddate,ec.mothermobno,ec.PhcId,u.name FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy JOIN enumdata ed on ed.enumid=ec.PhcId WHERE YEAR(mh.edddate) = YEAR(CURRENT_DATE()) AND MONTH(mh.edddate) = MONTH(CURRENT_DATE()) AND mh.status=1 ORDER BY mh.picmeno ASC;");
	}
	else if($bloName != "" && $phcName != "" ){
		$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.edddate,ec.mothermobno,ec.PhcId,u.name FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy JOIN enumdata ed on ed.enumid=ec.PhcId WHERE YEAR(mh.edddate) = YEAR(CURRENT_DATE()) AND MONTH(mh.edddate) = MONTH(CURRENT_DATE()) AND mh.status=1 AND ec.PhcId='".$phcName."' ORDER BY mh.picmeno ASC;");
	}
}

else if(isset($_POST['reset'])) {
	$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.edddate,ec.mothermobno,ec.PhcId,u.name FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy JOIN enumdata ed on ed.enumid=ec.PhcId WHERE YEAR(mh.edddate) = YEAR(CURRENT_DATE()) AND MONTH(mh.edddate) = MONTH(CURRENT_DATE()) AND mh.status=1 ORDER BY mh.picmeno ASC;");
}
else {
	$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.edddate,ec.mothermobno,ec.PhcId,u.name FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy JOIN enumdata ed on ed.enumid=ec.PhcId WHERE YEAR(mh.edddate) = YEAR(CURRENT_DATE()) AND MONTH(mh.edddate) = MONTH(CURRENT_DATE()) AND mh.status=1 ORDER BY mh.picmeno ASC;");
}
                   if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['picmeno']; ?></td>
									<td><?php echo $row['motheraadhaarname']; ?></td>
                                    <td><?php  $dd = date('d-m-Y',strtotime($row['edddate'])); echo $dd; ?></td>
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