<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
use Phppot\Member;
if (! empty($_POST["adduser"])) {
    require_once '../Model/Member.php';
    $member = new Member();
    $registrationResponse = $member->AddRegMember($userid);
    if (!empty($registrationResponse)) {
        echo "<script>alert('Inserted Successfully');window.location.replace('http://admin.thaimaiyudan.org/forms/UserManagement.php');</script>";
      } 
}

$name = ""; $email = ""; $phone = ""; $password = ""; $pwd = ""; $usertype = ""; $status = ""; $id = 0;
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Management /</span> Add User
              <a href="UserManagement.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
			</h4>
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">
                        Add / Register User
					  </h5>
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                      <form action="" method="post" onSubmit="return UmValidate(this);">
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
    }
    ?>
				<div class="errMsg" id="errMsg"></div>
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div class="row">
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Full Name <span class="mand">* </span><span id="Edname"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="name"
                              class="form-control"
                              id="name"
                              placeholder="Name"
                              aria-label="Name"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email <span class="mand">* </span><span id="Edemail"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input
                              type="text"
                              name="email"
                              id="email"
                              class="form-control"
                              placeholder="Mail"
                              aria-label="Mail"
                              aria-describedby="basic-icon-default-email2"
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-username">Username <span class="mand">* </span><span id="Edusername"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                            <input
                              type="text"
                              name="username"
                              id="username"
                              class="form-control"
                              placeholder="Username"
                              aria-label="Mail"
                              aria-describedby="basic-icon-default-username"
                            />
                          </div>
                          
                        </div>
                        <div class="col-4 mb-3 form-password-toggle">
                          <label class="form-label" for="basic-icon-default-password">Password <span class="mand">* </span><span id="EdencPwd"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-lock"></i></span>
                            <input
                              type="password"
                              name="encpassword"
                              id="encpassword"
                              class="form-control"
                              placeholder="Password"
                              aria-label="Password"
                              aria-describedby="basic-icon-default-password2"
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-show"></i></span>
                          </div>
                        </div>
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-password">Confirm Password <span class="mand">* </span><span id="EdconPwd"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-key"></i></span>
                            <input
                              type="password"
                              name="confirm_password"
                              id="confirm_password"
                              class="form-control"
                              placeholder="Confirm Password"
                              aria-label="Confirm Password"
                              aria-describedby="basic-icon-default-conpassword"
                            />
                          </div>
                          <span id='message'></span>
                        </div>
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mobile Number <span class="mand">* </span><span id="Edmobile"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="text"
                              name="mobile"
                              id="mobile" maxlength="10"
                              class="form-control phone-mask"
                              placeholder="658 799 8941"
                              aria-label="658 799 8941"
                              aria-describedby="basic-icon-default-mobile"
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">User Type <span class="mand">* </span><span id="Edusertype"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="usertype" id="usertype" class="form-select" value="<?php echo $usertype; ?>" onchange="changeFunc();">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							            </div>
						            </div>
                        <div class="col-4 mb-3" id="HospitalDiv">
                          <label class="form-label" for="basic-icon-default-phone">Hospital <span class="mand">* </span><span id="EdHosId"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="HosId" id="HosId" class="form-select">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT id,name FROM hospital ORDER BY name";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['id']; ?>"><?php echo $listvalue['name']; ?></option>
                          <?php } ?>
                             </select>
							            </div>
						            </div>
                        <div class="col-4 mb-3" id="blockDiv">
                          <label class="form-label" for="basic-icon-default-phone">Block <span class="mand">* </span><span id="Edblock"></span></label>
						              <div class="input-group input-group-merge">
                          <select name="BlockId" id="BlockId" onchange="BlockOn()" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT DISTINCT(BlockId),BlockName FROM hscmaster ORDER BY BlockId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['BlockId']; ?>"><?php echo $listvalue['BlockName']; ?></option>
                          <?php } ?>
                          </select>
						              </div>
					              </div>
                        <div class="col-4 mb-3" id="phcDiv">
                          <label class="form-label" for="basic-icon-default-phone">PHC <span class="mand">* </span><span id="Edphc"></span></label>
						              <div class="input-group input-group-merge">
                          <select name="PhcId" id="PhcId" onchange="PhcOn()" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT DISTINCT(PhcId),PhcName,BlockId FROM hscmaster ORDER BY BlockId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['PhcId']; ?>"><?php echo $listvalue['PhcName']; ?></option>
                          <?php } ?>
                          </select>
						              </div>
					              </div>
                        
                        <div class="col-4 mb-3" id="hscDiv">
                          <label class="form-label" for="basic-icon-default-phone">HSC <span class="mand">* </span><span id="Edhsc"></span></label>
						              <div class="input-group input-group-merge">
                          <select name="HscId" id="HscId" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT DISTINCT(HscId),HscName FROM hscmaster ORDER BY HscId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['HscId']; ?>"><?php echo $listvalue['HscName']; ?></option>
                          <?php } ?>
                          </select>
						              </div>
					    </div>
					    <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Status <span class="mand">* </span><span id="Edstatus"></span></label>
						              <div class="input-group input-group-merge">
                          <select name="status" id="status" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=2";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						              </div>
					    </div>
					</div>
                      <div class="input-group">
                        <input class="btn btn-primary" type="submit" name="adduser" value="Save">
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>