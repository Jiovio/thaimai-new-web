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
              <h5 class="card-header">Private Hospitals List</h5>          
        <div class="table-responsive text-nowrap">
				<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
            <th>S.No</th>            
						<th>Hospital Name</th>
						<th>Reg No.</th>
						<th>Email</th>
						<th>Mobile</th>
            <th>Block Name</th>
						<th>Service</th>
                      </tr>
                    </thead>
<?php   if(isset($_POST['filter'])) {
                        $bloName = $_POST['BlockId']; 
                        $phcName = $_POST['PhcId'];
                      
                        if($bloName == "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT * FROM hospital ORDER BY district,BlockId,PhcId ASC");
                        } else if($bloName != "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT * FROM hospital WHERE BlockId='".$bloName."' ORDER BY district,BlockId,PhcId ASC");
                        } else if($bloName != "" && $phcName != "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT * FROM hospital WHERE BlockId='".$bloName."' AND PhcId='".$phcName."' ORDER BY district,BlockId,PhcId ASC");
                        }
                      }
                      
                      else if(isset($_POST['reset'])) {
                        $ExeQuery = mysqli_query($conn,"SELECT * FROM hospital ORDER BY district,BlockId,PhcId ASC");
                      }
                      else {
                        $ExeQuery = mysqli_query($conn,"SELECT * FROM hospital ORDER BY district,BlockId,PhcId ASC");
                      }

                    if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td style="text-transform: uppercase;"><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['certificateno']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['BlockId']; ?></td>
                                    <td><?php echo $row['service']; ?></td>
                                </tr>
                    <?php 
                        $cnt++;
                      } 
                    } ?>
        </table>
        </div>
      </div>
    </div>
<!-- / Content -->
<?php include ('require/dtFooter.php'); ?>