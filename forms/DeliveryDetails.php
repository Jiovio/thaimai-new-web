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
                <h5 class="card-header"><span class="text-muted fw-light">Delivery /</span> Delivery Details List
                <a href="AddDelivery.php" type="button" class="btn btn-primary" style="float:right;">
                    <span class="bx bx-plus"></span>&nbsp; Add Delivery Details
                </a>
              </h5>
                <div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>S.No</th>    
                        <th>Mother Name</th>
                        <th>PICME Number</th>
                        <th>Delivery Date</th>
                        <th>Delivery Time</th>
						<th>View</th>
                      </tr>
                    </thead>

    <?php if(($usertype == 0) || ($usertype == 1)) {
            if(isset($_POST['filter'])) {
	            $bloName = $_POST['BlockId']; 
	            $phcName = $_POST['PhcId'];

	if($bloName == "" && $phcName == "" ){
		$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,dd.deliverydate,dd.deliverytime FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1 ORDER BY ec.motheraadhaarname ASC");
	} else if($bloName != "" && $phcName == "" ){
		$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,dd.deliverydate,dd.deliverytime FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE ec.BlockId='".$bloName."' AND dd.status=1 ORDER BY ec.motheraadhaarname ASC");
	} else if($bloName != "" && $phcName != "" ){
		$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,dd.deliverydate,dd.deliverytime FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND dd.status=1 ORDER BY ec.motheraadhaarname ASC");
	}
} else if(isset($_POST['reset'])) {
	$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,dd.deliverydate,dd.deliverytime FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1 ORDER BY ec.motheraadhaarname ASC");
} else {
	$ExeQuery = mysqli_query($conn,"SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,dd.deliverydate,dd.deliverytime FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1 ORDER BY ec.motheraadhaarname ASC");
    }
} else if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
    $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,dd.deliverydate,dd.deliverytime FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE ec.BlockId='".$BlockId."' AND dd.status=1 ORDER BY ec.motheraadhaarname ASC");
            } 
          if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['motheraadhaarname']; ?></td>
                                    <td><?php echo $row['picmeno']; ?></td>
                                    <td><?php  $dd = date('d-m-Y',strtotime($row['deliverydate'])); echo $dd; ?></td>
                                    <td><?php echo $row['deliverytime']; ?></td>
                                    <td><a href="../forms/ViewEditDelivery.php?view=<?php echo $row['id']; ?>"><i class="bx bx-show me-1"></i>View</a></td>
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