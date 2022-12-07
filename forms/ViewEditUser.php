<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
$name = ""; $email = ""; $phone = ""; $password = ""; $pwd = ""; $usertype = ""; $status = ""; $id = 0;
$view = false; $update = false;

if (isset($_GET['view'])) {
  $id = $_GET['view'];
  $view = true;
  $record = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
  $n = mysqli_fetch_array($record);

    $name = $n['name'];
    $email = $n['email'];
    $uname = $n['username'];
    $phone = $n['mobile'];
    $password = $n['encpassword'];
    $pwd = $n['password'];
    $usertype = $n['usertype'];
    $HosId = $n['HosId'];
    $BlockId = $n['BlockId'];
    $PhcId = $n['PhcId'];
    $HscId = $n['HscId'];
    $status = $n['status'];
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;
  $record = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
  $n = mysqli_fetch_array($record);
  
    $name = $n['name'];
    $email = $n['email'];
    $uname = $n['username'];
    $phone = $n['mobile'];
    $password = $n['encpassword'];
    $pwd = $n['password'];
    $usertype = $n['usertype'];
    $HosId = $n['HosId'];
    $BlockId = $n['BlockId'];
    $PhcId = $n['PhcId'];
    $HscId = $n['HscId'];
    $status = $n['status'];
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $phone = $_POST['mobile'];
  $password = password_hash($_POST['encpassword'], PASSWORD_DEFAULT);
  $pwd = $_POST['encpassword'];
  $usertype = $_POST['usertype'];
  $HosId = $_POST['HosId'];
  $BlockId = $_POST['BlockId'];
  $PhcId = $_POST['PhcId'];
  $HscId = $_POST['HscId'];
  $status = $_POST['status'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
 
mysqli_query($conn, "UPDATE users SET name='$name',email='$email',username='$username',mobile='$phone',password='$pwd',encpassword='$password',usertype='$usertype',HosId='$HosId',BlockId='$BlockId',PhcId='$PhcId',HscId='$HscId',status='$status',updatedat='$date',updatedBy='$userid' WHERE id=$id");
  $_SESSION['message'] = "User Updated!"; 
  header('location: UserManagement.php');
}
if (isset($_GET['del'])) {
  $id = $_GET['del'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
  mysqli_query($conn, "UPDATE users SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND id=$id");
  $_SESSION['message'] = "User deleted!"; 
  header('location: UserManagement.php');
}
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Management /</span> 
              <?php if($view == true) { 
                echo "View";
              } elseif($update == true) {
                echo "Edit";
              }else {
                echo "Add";
              } ?> User
              <a href="UserManagement.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
              
              <a href="../forms/ViewEditUser.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>

              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnUserEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>
			</h4>
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">
                        <?php if($view == true) { 
                                echo "View";
                              } elseif($update == true) {
                                echo "Edit";
                              }else {
                                echo "Add";
                              } 
                          ?> / Register User</h5>
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
                    <?php } } ?>
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
                              value="<?php echo $name; ?>" disabled
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
                              value="<?php echo $email; ?>" disabled 
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
                              aria-label="username"
                              aria-describedby="basic-icon-default-username"
                              value="<?php echo $uname; ?>" disabled 
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
                              value="<?php echo $pwd; ?>" disabled 
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
                              value="<?php echo $pwd; ?>" disabled 
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
                              value="<?php echo $phone; ?>" disabled 
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">User Type <span class="mand">* </span><span id="Edusertype"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true ) { ?>
                          <select name="usertype" id="usertype" onchange="changeFunc();" class="form-select" value="<?php echo $usertype; ?>" disabled ">
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT u.usertype,e.enumid,e.enumvalue from users u join enumdata e on e.enumid=u.usertype WHERE type=1 AND u.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$usertype){ echo "selected"; } ?>
                                
                            <?php echo $row_list['enumvalue']; ?></option>
                            <option value="0">Super Admin</option>
                            <option value="1">Admin</option>
                            <option value="2">Block Officer</option>
                            <option value="3">Medical Officer</option>
                            <option value="4">VHN</option>
                            <option value="5">Private Hospital</option>
                            <option value="6">Customer</option>
                      </option>
							<?php } ?>
						</select>
                            <?php } else { ?>
                          <select name="usertype" id="usertype" class="form-select" value="<?php echo $usertype; ?>" disabled >
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                             } ?>
                             </select>
						</div>
					  </div>
            <div class="col-4 mb-3" id="HospitalDiv">
                          <label class="form-label" for="basic-icon-default-phone">Hospital <span class="mand">* </span><span id="EdHosId"></span></label>
						              <div class="input-group input-group-merge">
                          <?php if($update == true || $view == true) { ?>
                          <select name="HosId" id="HosId" class="form-select" value="<?php echo $block; ?>" disabled>
                          
                                <?php

                                $list=mysqli_query($conn, "SELECT DISTINCT(h.name),u.HosId,h.id FROM `users` u LEFT JOIN `hospital` h ON u.HosId=h.id WHERE u.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['id']; ?>">

                                <?php if($row_list['id']== $HosId){  }?>
                                
                                <?php echo $row_list['name']; ?></option>
                                <?php 
                                $query = "SELECT  DISTINCT name,id FROM hospital ORDER BY name";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['id']; ?>"><?php echo $listvalue['name']; ?></option>
                          <?php } } ?>

                                </select>
                            <?php } ?>
						              </div>
					              </div>
					<div class="col-4 mb-3" id="blockDiv">
                          <label class="form-label" for="basic-icon-default-phone">Block <span class="mand">* </span><span id="Edblock"></span></label>
						              <div class="input-group input-group-merge">
                          <?php if($update == true || $view == true) { ?>
                          <select name="BlockId" id="BlockId" onchange="BlockOn()" class="form-select" value="<?php echo $BlockId; ?>" disabled>
                           
<?php
$list=mysqli_query($conn, "SELECT DISTINCT(lm.BlockId),u.BlockId,lm.BlockName FROM users u LEFT JOIN hscmaster lm ON u.BlockId=lm.BlockId WHERE u.id=".$id);
 while($row_list=mysqli_fetch_assoc($list)){
?>
                                <option value="<?php echo $row_list['BlockId']; ?>">
                                <?php if($row_list['BlockId']== $BlockId){ echo $row_list['BlockName']; } ?></option>
                                <?php 
                            $query = "SELECT  DISTINCT BlockName,BlockId FROM hscmaster ORDER BY BlockName";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          <option value="<?php echo $listvalue['BlockId']; ?>"><?php echo $listvalue['BlockName']; ?></option>
                        <?php } } ?>
                          </select>
                            <?php } ?>
						              </div>
					              </div>
                        <div class="col-4 mb-3" id="phcDiv">
                          <label class="form-label" for="basic-icon-default-phone">PHC <span class="mand">* </span><span id="Edphc"></span></label>
						              <div class="input-group input-group-merge">
                          <?php if($update == true || $view == true) { ?>
                          <select name="PhcId" id="PhcId" onchange="PhcOn()" class="form-select" value="<?php echo $PhcId; ?>" disabled>
                           
                            <?php
$list=mysqli_query($conn, "SELECT DISTINCT(lm.PhcId),u.PhcId,lm.PhcName FROM users u LEFT JOIN hscmaster lm ON u.PhcId=lm.PhcId WHERE u.id=".$id);
while($row_list=mysqli_fetch_assoc($list)){
?>
                        <option value="<?php echo $row_list['PhcId']; ?>">
                        <?php if($row_list['PhcId']== $PhcId){ echo $row_list['PhcName']; } ?></option>
                                <?php 
                            $query = "SELECT  DISTINCT PhcName,PhcId, BlockName FROM hscmaster ORDER BY BlockName, PhcName";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          <option value="<?php echo $listvalue['PhcId']; ?>"><?php echo $listvalue['PhcName']; ?></option>
                          <?php } } ?>
                                </select>
                            <?php } ?>
						              </div>
					              </div>
                        <div class="col-4 mb-3" id="hscDiv">
                          <label class="form-label" for="basic-icon-default-phone">HSC <span class="mand">* </span><span id="Edhsc"></span></label>
						              <div class="input-group input-group-merge">
                          <?php if($update == true || $view == true) { ?>
                          <select name="HscId" id="HscId" class="form-select" value="<?php echo $HscId; ?>" disabled>
                           <!--<option value="">Choose...</option>-->
                          <?php
$list=mysqli_query($conn, "SELECT DISTINCT(hm.HscId),u.HscId,hm.HscName FROM users u LEFT JOIN hscmaster hm ON u.HscId=hm.HscId WHERE u.id=".$id);
while($row_list=mysqli_fetch_assoc($list)){
?>
                      <option value="<?php echo $row_list['HscId']; ?>">
                      <?php if($row_list['HscId']== $HscId){ echo $row_list['HscName']; } ?></option>
                                <?php 
                            $query = "SELECT  DISTINCT HscId,HscName FROM hscmaster ORDER BY HscId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          <option value="<?php echo $listvalue['HscId']; ?>"><?php echo $listvalue['HscName']; ?></option>
                      <?php } } ?>
                    </select>
                            <?php } ?>
						              </div>
					    </div>
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Status <span class="mand">* </span><span id="Edstatus"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true) { ?>
                          <select name="status" id="status" class="form-select" value="<?php echo $status; ?>" disabled>
                           
<?php
$slist = mysqli_query($conn,"SELECT u.status,e.enumid,e.enumvalue FROM users u join enumdata e on u.status=e.enumid WHERE type=2 AND u.id=".$id);
							while($status_list=mysqli_fetch_assoc($slist)){
						?>
							<option value="<?php echo $status_list['enumid']; ?>">
							<?php if($status_list['enumvalue']==$status){ echo "selected"; } ?>
							<?php echo $status_list['enumvalue']; ?>
                            <option value="0">Inactive</option>
							</option>
						<?php } ?>
						 </select>
                          <?php } else {?>
                          <select name="status" id="status" class="form-select" disabled>
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=2";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>                    
                          <?php  }  } ?>
                             </select>
						</div>
						</div>
					</div>
                      <div class="input-group" id="btnSaUp" style="display:none">
                        <input class="btn btn-primary" type="submit" id="update" name="update" value="Update">                  
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    <!-- / Content -->
<?php include ('require/footer.php'); ?>