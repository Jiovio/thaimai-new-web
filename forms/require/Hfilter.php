<!-- Category Filter - Starts-->
<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse" style="margin: 10px 0px;">
	<form action="" method="post" id="searchform" style="width:98%; margin-block-end:0em;">	
            <div class="searchBox">
            <div class="row" style="padding: 0em 1em;">
            <div class="col-md-4">
                    <label>Search By Category</label>
                <div class="input-group input-group-merge">
                <select name="category" id="category" class="form-select" onchange="SrchCtgy()" id="inputGroupSelect04">
                <option value="">Choose...</option>
                    <?php  
                   /*     $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=50";
                        $exequery = mysqli_query($conn, $query);
                        while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                    <?php  } */ ?>
                </select>
				</div>
            </div>
			<div class="col-md-4">
                <label id="chgname">Enter Category Value</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-category"></i
                        ></span>
                        <input
                            type="text"
                            name="txtchgname"
                            id="txtchgname"
                            class="form-control phone-mask"
                        />
                    </div>
            </div>
	        <div class="md-2 col-1" style="margin-top: 11px;">
                <button type="submit" name="go" class="btn btn-primary">Filter</button>
          </div>
          <?php if($usertype == 5) { ?>
            <div class="col-md-3">
              <ul class="navbar-nav flex-row align-items-center ms-auto" style="float:right; margin-right:1em;">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown" id="profile">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
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
          <?php } ?>
		  </div>
      <?php 
if(isset($_POST['go'])) {
	$category = $_POST['category'];
	$txtchgname = $_POST['txtchgname'];
	if(($category == 1) || ($category == 2) || ($category == 3) || ($category == 4)) {
    $ExeQuery = mysqli_query($conn,"SELECT id,picmeNo,motheraadhaarname,motheraadhaarid,mothermobno,husmobno FROM ecregister WHERE picmeNo='".$txtchgname."' OR motheraadhaarname LIKE '%".$txtchgname."%' OR motheraadhaarid='".$txtchgname."' OR mothermobno='".$txtchgname."' OR husmobno='".$txtchgname."';");
    while($row = mysqli_fetch_array($ExeQuery)) {
		if($row > 0)
		{
      include ('dbListView.php');
		} else {
			  echo "Incorrect Details Entered";
		  }
	  }
	}
}
?>
		</div>
		</form>
    </div>
        <!-- Category Filter - Ends -->