<?php include ('require/topHeader.php'); ?>
<body>	 	
       <!-- Layout wrapper -->
       <div class="layout-wrapper layout-content-navbar">
         <div class="layout-container">
           <!-- Menu -->
<?php include ('require/header.php'); // Menu
	  include ('require/filter.php'); // Top Filter 
    ?>
             <!-- Content wrapper -->
             <div class="content-wrapper">
               <!-- Content -->
   
            <div class="container-xxl flex-grow-1 container-p-y">
             <!-- Hoverable Table rows -->
                 <div class="card">
                 <h5 class="card-header"><span class="text-muted fw-light">User Management /</span> Registered Users List
                    <a href="AddRegUser.php" id="add" type="button" class="btn btn-primary" style="float:right;">
                      <span class="bx bx-plus"></span>&nbsp; Add User
                    </a>
                    <small class="text-muted float-end"><span style="color:red; margin-right: 20px;">Super Admin &amp; Admin details will not be shown here due to security reasons</span></small>
                 </h5>
           <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>            
               <th>Name</th>
               <th>Email / Username</th>
               <th>Mobile</th>
               <th>User Type</th>
               <th>Status</th>
               <th>View</th>
                         </tr>
                       </thead>
<?php 
      $listQry = "SELECT id,name,email,mobile,usertype,status FROM users WHERE email !='test@thaimaiyudan.org' AND status='1' AND usertype NOT IN (0,1)";
      $orderQry = " ORDER BY name";

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
                      $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."'".$orderQry);
                    }
                  } else if(isset($_POST['reset'])) {
                    $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                  } else {
                    $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                  }
                  if($ExeQuery) {
                    $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                   <tr>
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['name']; ?></td>
                                       <td><?php echo $row['email']; ?></td>
                                       <td><?php echo $row['mobile']; ?></td>
                               <td><?php $ut = $row['usertype'];
                                if($ut==0){ echo "Super Admin"; } elseif($ut==1){ echo "Admin"; } elseif($ut==2){ echo "Block Officer"; }
                                elseif($ut==3){ echo "Medical Officer"; } elseif($ut==4){ echo "VHN"; }
                                elseif($ut==5){ echo "Private Hospital"; } elseif($ut==6){ echo "Customer"; } ?></td>
                               <td><?php $status=$row['status']; if($status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
                              <td ><a id="view" name="view" href="../forms/ViewEditUser.php?view=<?php echo $row['id']; ?>" ><i  class="bx bx-show me-1"></i>View</a></td>
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