<?php include ('require/header.php'); 
 // Menu & Top Search
    $record = mysqli_query($conn, "SELECT * FROM users WHERE id='".$userid."'");
    $n = mysqli_fetch_array($record);
    $name = $n['name'];
    $email = $n['email'];
    $phone = $n['mobile'];
    $usertype = $n['usertype'];
    $status = $n['status'];
?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> My Profile</h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="" method="post">
                      <?php
                      if (! empty($registrationResponse["status"])) {
                       
                        if ($registrationResponse["status"] == "error") {
                     ?>
				             <div class="server-response errMsg"><?php echo $registrationResponse["message"]; ?></div>
                    <?php
                             } else if ($registrationResponse["status"] == "success") {
                    ?>
                    <div class="server-response success-msg"><?php echo $registrationResponse["message"]; ?></div>
                    <?php
        }
        ?>
				<?php
    }
    ?>
				<div class="errMsg" id="errMsg"></div>
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div class="row">
						<div class="col-12 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="name"
                              class="form-control"
                              id="name"
                              value="<?php echo $name; ?>" disabled
                            />
                          </div>
                        </div>
					</div>
					<div class="row">
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input
                              type="text"
                              name="email"
                              id="email"
                              class="form-control"
                              value="<?php echo $email; ?>" disabled
                            />
                          </div>
                          <div class="form-text">You can use letters, numbers & periods</div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Username</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                            <input
                              type="text"
                              name="username"
                              id="username"
                              class="form-control"
                              value="<?php echo $username; ?>" disabled
                            />
                          </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mobile Number</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="text"
                              name="mobile"
                              id="mobile"
                              class="form-control"
                              value="<?php echo $phone; ?>" disabled
                            />
                          </div>
                        </div>
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">User Type</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bxs-user-rectangle"></i
                            ></span>
                            <input
                              type="text"
                              name="mobile"
                              id="mobile"
                              class="form-control"
                              value="<?php if($usertype==0){ echo "Super Admin"; }
                            else if($usertype==1) { echo "Admin"; }
                            else if($usertype==2) { echo "Block Officer"; }
                            else if($usertype==3) { echo "Medical Officer"; }
                            else if($usertype==4) { echo "VHN"; }
                            else if($usertype==5) { echo "Pivate Hospital"; }
                            else { echo "Customer"; } ?>" disabled
                            />
                          </div>
					            </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      <!-- / Content -->
<?php include ('require/dtFooter.php'); ?>