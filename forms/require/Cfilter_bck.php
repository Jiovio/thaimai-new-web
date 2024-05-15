<?php include "../config/db_connect.php"; 
?>

          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse" style="margin-top: 19px;">
  <!-- Search -->
	<form action="" method="post" id="filterform" style="width:96%";>	
            <div class="panel-body">
                    <div class="row">	
  <!-- /Search -->
      <!---div class="md-12 col-12"--->
	  <div class="col-3 mb-4">
	  </div>
	  <div class="col-3 mb-4">
	  </div>
	  <div class="col-3 mb-4">
	  </div>
	  <div class="col-md-1">
	  	  
              <ul class="navbar-nav flex-row align-items-right ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown" id="profile">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img align="right" src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-Block"><?php echo $username;?></span>
                            <small class="text-muted">
							<?php
                            $query = mysqli_query($conn,"SELECT * FROM users WHERE id='$userid'");
			                $utype = mysqli_fetch_array($query);
                            $ut = $utype['usertype'];
                                if($ut==0){ echo "Super Admin"; } elseif($ut==1){ echo "Admin"; } elseif($ut==2){ echo "Block Officer"; }
                                elseif($ut==3){ echo "Medical Officer"; } elseif($ut==4){ echo "VHN"; }
                                elseif($ut==5){ echo "Private Hospital"; } elseif($ut==6){ echo "Customer"; } ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="account.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo $siteurl; ?>/logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
              </div>
              
			</div>
		</form>
            </div>
          </nav>
        <!-- / Navbar -->