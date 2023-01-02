<?php 
include "../config/db_connect.php"; 
include('EcExport.php');
?>
  <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar" style="height:50%";>
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse" style="margin-top: 10px;">
  <!-- Search -->
		<form action="EcExport.php" method="post" id="filterform" style="width:98%";>	
            <div class="panel-body">
                    <div class="row">
            <div class="col-md-3">
                <label>Block Name</label>
                <div class="input-group input-group-merge">
                <select name="BlockId" id="BlockId" onchange="BlockOn()" class='form-control'>
                <option value="">All Blocks</option>
				<?php
				$result = mysqli_query($conn,"SELECT DISTINCT BlockId, BlockName FROM hscmaster ORDER BY BlockName;");
				while($row = mysqli_fetch_array($result)) {
				  if(isset($_POST['BlockId'])) {
					  echo "<option value=\"".$row["BlockId"]."\"";
					  if($_POST['BlockId'] == $row['BlockId'])
					  echo 'selected';
					  echo ">".$row["BlockName"]."</option>"; 
				  } else {
            echo "<option value=\"".$row["BlockId"]."\"";
            echo ">".$row["BlockName"]."</option>"; 
          }
				}
                ?>
                </select>
                </div>
                </div>
      <div class="col-md-3">
                  <label>PHC Name</label>
                  <div class="input-group input-group-merge">
                  <select name="PhcId" id="PhcId" onchange="PhcOn()" class='form-control' disabled>
						<option value="">All PHCs</option>
              <?php
				$result = mysqli_query($conn,"SELECT DISTINCT PhcId, PhcName FROM hscmaster ORDER BY PhcName;");
        while($row = mysqli_fetch_array($result)) {
					if(isset($_POST['PhcId'])) {
						echo "<option value=\"".$row["PhcId"]."\"";
						if($_POST['PhcId'] == $row['PhcId'])
						echo 'selected';
						echo ">".$row["PhcName"]."</option>";
					} else {
            echo "<option value=\"".$row["PhcId"]."\"";
            echo ">".$row["PhcName"]."</option>"; 
          }
        }
              ?>
              </select>
        </div>
      </div>
      <div class="col-md-3">
                  <label>HSC Name</label>
                  <div class="input-group input-group-merge">
                  <select name="HscId" id="HscId" class='form-control'>
						<option value="">All HSCs</option>
            <?php
            $result = mysqli_query($conn,"SELECT DISTINCT HscId, HscName FROM hscmaster ORDER BY HscName;");
            while($row = mysqli_fetch_array($result)) {
                if(isset($_POST['HscId'])) {
                    echo "<option value=\"".$row["HscId"]."\"";
                    if($_POST['HscId'] == $row['HscId'])
                    echo 'selected';
                    echo ">".$row["HscName"]."</option>";
                } else {
        echo "<option value=\"".$row["HscId"]."\"";
        echo ">".$row["HscName"]."</option>"; 
          }
        }
              ?>
              </select>
        </div>
      </div>

      <div class="col-md-2">
                  <label>Mother Age</label>
                  <div class="input-group input-group-merge">
                  <select name="ConId" id="ConId" class='form-control' disabled>
                  <option value="">All</option>
              <?php
              $result = mysqli_query($conn,"SELECT * FROM enumdata WHERE type=52;");
			  while($row = mysqli_fetch_array($result)) {
					if(isset($_POST['ConId'])) {
						echo "<option value=\"".$row["enumid"]."\"";
						if($_POST['ConId'] == $row['enumid'])
						echo 'selected';
						echo ">".$row["enumvalue"]."</option>";
					} else {
            echo "<option value=\"".$row["enumid"]."\"";
            echo ">".$row["enumvalue"]."</option>"; 
          }
        }
              ?>
              </select>
        </div>
      </div>
  <!-- /Search -->
      <div class="col-md-1">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown" id="profile">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" style="background-color:azure;">
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
			</div>
      <h5 class="card-header" style="margin-top: 30px;">
                  <span class="text-muted fw-light">All Reports / </span>Reports
                </h5>
                <br/>
      <div class="col-md-8" style="margin-top: 20px;">
       <button type="submit" id="EcReport" name='EcReport' class="btn lt btn-primary"><span class="bx bx-download"></span>&nbsp; ECouple Report</button>
      <button type="submit" id="teenageExp" name='teenageExp' class="btn lt btn-primary"><span class="bx bx-download"></span>&nbsp; Teenage ECouple Report</button>
      </div>
		</form>
            </div>
          </nav>
        <!-- / Navbar -->