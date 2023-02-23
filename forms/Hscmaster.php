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
              <h5 class="card-header"><span class="text-muted fw-light">Location Master /</span> PHC & HSC Centers List</h5>
                <div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
						<th>S.No</th>            
						<th>Block</th>
						<th>PHC</th>
						<th>HSC</th>
						<th>Village</th>
						<th>Panchayat</th>
						<th>Rural / Urban</th>
                      </tr>
                    </thead>
<?php  $order = "ORDER BY BlockName,PhcName,HscName,PanchayatName,VillageName ASC"; 
                if(isset($_POST['filter'])) {
                        $bloName = $_POST['BlockId']; 
                        $phcName = $_POST['PhcId'];
                      
                        if($bloName == "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT * FROM hscmaster");
                        } else if($bloName != "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT * FROM hscmaster WHERE BlockId='".$bloName."' ".$order);
                        } else if($bloName != "" && $phcName != "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT * FROM hscmaster WHERE BlockId='".$bloName."' AND PhcId='".$phcName."' ".$order);
                        }
                      }
                      
                      else if(isset($_POST['reset'])) {
                        $ExeQuery = mysqli_query($conn,"SELECT * FROM hscmaster ".$order);
                      }
                      else {
                        $ExeQuery = mysqli_query($conn,"SELECT * FROM hscmaster ".$order);
                      }

                    if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['BlockName']; ?></td>
                                <td><?php echo $row['PhcName']; ?></td>
                                <td><?php echo $row['HscName']; ?></td>
                                <td><?php echo $row['VillageName']; ?></td>
                                <td><?php echo $row['PanchayatName']; ?></td>
                                <td><?php echo $row['rutype']; ?></td>
                            </tr>
                    <?php 
                        $cnt++;
                      } 
                    }   ?>
        </table>
        </div>
      </div>
    </div>
<!-- / Content -->
<?php include ('require/dtFooter.php'); ?>