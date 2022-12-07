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
                <h5 class="card-header"><span class="text-muted fw-light">Notified List /</span> AN Visit Due Expired</h5>
				<div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No</th>            
                        <th>PICME Number</th>
						<th>Mother Aadhaar Name</th>
                        <th>Last AN Visit Date</th>
						<th>Mother Mobile No.</th>
					</tr>
                    </thead>
<?php if(isset($_POST['filter'])) {
	$bloName = $_POST['BlockId']; 
	$phcName = $_POST['PhcId'];

	if($bloName == "" && $phcName == "" ){
		$ExeQuery = mysqli_query($conn,"SELECT av.picmeno,ec.motheraadhaarname,av.anvisitDate,ec.mothermobno,ec.BlockId,ec.PhcId FROM antenatalvisit av JOIN ecregister ec ON av.picmeno=ec.picmeNo WHERE DATEDIFF(CURDATE(),anvisitDate)>30 AND av.status=1 ORDER BY ec.motheraadhaarname");
	}
	else if($bloName != "" && $phcName != "" ){
		$ExeQuery = mysqli_query($conn,"SELECT av.picmeno,ec.motheraadhaarname,av.anvisitDate,ec.mothermobno,ec.BlockId,ec.PhcId FROM antenatalvisit av JOIN ecregister ec ON av.picmeno=ec.picmeNo WHERE DATEDIFF(CURDATE(),anvisitDate)>30 AND av.status=1 AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' ORDER BY ec.motheraadhaarname");
	}
}

else if(isset($_POST['reset'])) {
	$ExeQuery = mysqli_query($conn,"SELECT av.picmeno,ec.motheraadhaarname,av.anvisitDate,ec.mothermobno,ec.BlockId,ec.PhcId FROM antenatalvisit av JOIN ecregister ec ON av.picmeno=ec.picmeNo WHERE DATEDIFF(CURDATE(),anvisitDate)>30 AND av.status=1 ORDER BY ec.motheraadhaarname");
}
else {
	$ExeQuery = mysqli_query($conn,"SELECT av.picmeno,ec.motheraadhaarname,av.anvisitDate,ec.mothermobno,ec.BlockId,ec.PhcId FROM antenatalvisit av JOIN ecregister ec ON av.picmeno=ec.picmeNo WHERE DATEDIFF(CURDATE(),anvisitDate)>30 AND av.status=1 ORDER BY ec.motheraadhaarname");
}
                   if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['picmeno']; ?></td>
									<td><?php echo $row['motheraadhaarname']; ?></td>
									    <td><?php echo $row['anvisitDate']; ?></td>
                                    <td><?php echo $row['mothermobno']; ?></td>
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