<?php include ('require/topHeader.php'); ?>
<?php session_start(); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
$picmeNo = ""; $doseNo = ""; $doseName = ""; $doseDueDate = ""; $doseProvidedDate = ""; $breastFeeding = ""; $compliFoodStart = "";
	$id = 0;
  $view = false;
	$update = false;
  if (isset($_GET['view']) OR isset($_GET['delview'])) {
	    if(isset($_GET['view']))
		{
	     $id = $_GET['view'];		 
		}
		
		$del_view_ind = "N";
		if(isset($_GET['delview']))
		{
	     $del_view_ind = "Y";	
         $id = $_GET['delview'];		 
		}
		$view = true;
		$record = mysqli_query($conn, "SELECT * FROM immunization WHERE id=$id");
			$n = mysqli_fetch_array($record);
			$Del_rec_id = "";
            $Del_rec_id = $id;		
			

            $picmeNo = $n["picmeNo"]; 
            $doseNo = $n["doseNo"]; 
            $doseName = $n["doseName"];
            $dnArr = explode(",",$doseName);
            $doseDueDate = $n["doseDueDate"];
            $doseProvidedDate = $n["doseProvidedDate"]; 
            $breastFeeding = $n["breastFeeding"]; 
            $compliFoodStart = $n["compliFoodStart"];
            // $motherCovidVac1Done = $n["motherCovidVac1Done"];
            // $motherCovidVac1Type = $n["motherCovidVac1Type"];
            // $motherCovidVac1Date = $n["motherCovidVac1Date"]; 
            // $motherCovidVac2Done = $n["motherCovidVac2Done"];
            // $motherCovidVac2Type = $n["motherCovidVac2Type"]; 
            // $motherCovidVac2Date = $n["motherCovidVac2Date"]; 
            // $motherCovidVacBoosterDone = $n["motherCovidVacBoosterDone"]; 
            // $motherCovidVacBoosterType = $n["motherCovidVacBoosterType"];
            // $motherCovidVacBoosterDate = $n["motherCovidVacBoosterDate"]; 
	}
if (! empty($_POST["update"])) {

    $id = $_POST['id'];
  //$doseNo = $_POST["doseNo"]; 
  //$doseName = implode(",",$_POST["doseName"]); 
 // $picmeNo = $_POST["picmeNo"]; 
  
  $doseName = implode(",",$_POST["doseName"]);
   
//$doseDueDate = $_POST["doseDueDate"];
  $doseProvidedDate = $_POST["doseProvidedDate"]; 
 // $query = mysqli_query($conn,"SELECT dd.deliverydate FROM immunization im JOIN deliverydetails dd ON dd.picmeno=im.picmeNo WHERE im.picmeNo='$picmeNo'");
 /* while ($fdate = mysqli_fetch_array($query)){
   $futdate = $fdate['deliverydate'];
  }
  if($doseNo == 1) {
  $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 74 days' ));
  } if($doseNo == 2) {
    $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 104 days' ));
  } if($doseNo == 3) {
    $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 269 days' ));
  } if($doseNo == 4) {
    $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 479 days' ));
  } 

if($doseNo == 1) {
  $FutureDoseNo = $doseNo + 1;
  } else if($doseNo == 2) {
  $FutureDoseNo = $doseNo + 1;
  } else if($doseNo == 3) {
  $FutureDoseNo = $doseNo + 1;
  } else if($doseNo == 4) {
  $FutureDoseNo = $doseNo + 1;
  } */
  
  $breastFeeding = $_POST["breastFeeding"]; 
  $compliFoodStart = $_POST["compliFoodStart"];
  //  $motherCovidVac1Done = $_POST["motherCovidVac1Done"];
  // $motherCovidVac1Type = $_POST["motherCovidVac1Type"];
  // $motherCovidVac1Date = $_POST["motherCovidVac1Date"]; 
  
  // if($motherCovidVac1Type == '1') {
  //   $Fcov2DueDate = date('Y-m-d', strtotime($motherCovidVac1Date. '+ 30 days' ));
  // } else if($motherCovidVac1Type == '2'){
  //   $Fcov2DueDate = date('Y-m-d', strtotime($motherCovidVac1Date. '+ 90 days' ));  
  // }

  // $motherCovidVac2Done = $_POST["motherCovidVac2Done"];
  // $motherCovidVac2Type = $_POST["motherCovidVac2Type"]; 
  // $motherCovidVac2Date = $_POST["motherCovidVac2Date"];
  
  // if($motherCovidVac2Type == '1') {
  //   $FBcovDueDate = date('Y-m-d', strtotime($motherCovidVac2Date. '+ 180 days' ));
  // } else if($motherCovidVac2Type == '2'){
  //   $FBcovDueDate = date('Y-m-d', strtotime($motherCovidVac2Date. '+ 180 days' )); 
  // }
  // $motherCovidVacBoosterDone = $_POST["motherCovidVacBoosterDone"]; 
  // $motherCovidVacBoosterType = $_POST["motherCovidVacBoosterType"];
  // $motherCovidVacBoosterDate = $_POST["motherCovidVacBoosterDate"];

  // if($motherCovidVac1Type == '1' || $motherCovidVac1Type == '2' ) {
  //   $NextDoseName1 = $motherCovidVac1Type;
  // }else if($motherCovidVac2Type == '1' || $motherCovidVac2Type == '2'){
  //   $NextDoseName1 = $motherCovidVac2Type;
    
  // } else if($motherCovidVacBoosterType == '1' || $motherCovidVacBoosterType == '2'){
  //   $NextDoseName1 = $motherCovidVacBoosterType;
    
  // }
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-Y h:i:s');
	
	$wild_com = $doseName;
	$wild_srch_com = str_replace(',', '', $wild_com);
    $dose_chg_val = is_numeric($wild_srch_com);
	
	 $rec_del_pic = mysqli_query($conn, "SELECT * FROM immunization im WHERE im.id = $id");
				          $n_del = mysqli_fetch_array($rec_del_pic);
	          $Upd_picmeNo = "";
	          $Upd_picmeNo = $n_del['picmeNo'];
	
	if($dose_chg_val == 1)
	{
	 $query = mysqli_query($conn, "UPDATE immunization SET doseName = '$doseName',
doseProvidedDate='$doseProvidedDate', breastFeeding='$breastFeeding', 
compliFoodStart='$compliFoodStart',updatedat='$date',updUserId='$userid' WHERE id=$id");
	}
	else
	{
	 $query = mysqli_query($conn, "UPDATE immunization SET 
doseProvidedDate='$doseProvidedDate', breastFeeding='$breastFeeding', 
compliFoodStart='$compliFoodStart',updatedat='$date',updUserId='$userid' WHERE id=$id");
	}	
if (!empty($query)) {
	echo "<script>alert('Updated Successfully');window.location.replace('{$siteurl}/forms/ImmunizationDtl.php?History=$Upd_picmeNo');</script>";
    
  } }


	// if (isset($_GET['edit'])) {
	// 	$id = $_GET['edit'];
	// 	$update = true;
	// 	$record = mysqli_query($conn, "SELECT * FROM immunization WHERE id=$id");
	// 		$n = mysqli_fetch_array($record);

  //           $picmeNo = $n["picmeNo"]; 
  //           $doseNo = $n["doseNo"]; 
  //           $doseName = $n["doseName"]; 
  //           $doseDueDate = $n["doseDueDate"];
  //           $doseProvidedDate = $n["doseProvidedDate"]; 
  //           $breastFeeding = $n["breastFeeding"]; 
  //           $compliFoodStart = $n["compliFoodStart"];
  //           $motherCovidVac1Done = $n["motherCovidVac1Done"];
  //           $motherCovidVac1Type = $n["motherCovidVac1Type"];
  //           $motherCovidVac1Date = $n["motherCovidVac1Date"]; 
  //           $motherCovidVac2Done = $n["motherCovidVac2Done"];
  //           $motherCovidVac2Type = $n["motherCovidVac2Type"]; 
  //           $motherCovidVac2Date = $n["motherCovidVac2Date"]; 
  //           $motherCovidVacBoosterDone = $n["motherCovidVacBoosterDone"]; 
  //           $motherCovidVacBoosterType = $n["motherCovidVacBoosterType"];
  //           $motherCovidVacBoosterDate = $n["motherCovidVacBoosterDate"]; 
	// }

  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-Y h:i:s');
	
  //  mysqli_query($conn, "UPDATE immunization SET status=0, deletedat='$date', deletedUserId='$userid' WHERE status=1 AND id=$id");
  
    $rec_del_pic = mysqli_query($conn, "SELECT * FROM immunization im WHERE im.id = $id AND
		                       im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo)");
				          $n_del = mysqli_fetch_array($rec_del_pic);
	          $Del_picmeNo = "";
	          $Del_picmeNo = $n_del['picmeNo'];
  
    
	
	mysqli_query($conn, "DELETE FROM immunization WHERE id=$id");
	 
  //  $_SESSION['message'] = "User deleted!"; 
	
			
      echo "<script>alert('Deleted Successfully');window.location.replace('{$siteurl}/forms/ImmunizationDtl.php?History=$Del_picmeNo');</script>";
  }
?>
<!-- Content wrapper -->
   <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y"> 
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Immunization /</span> 
              <?php if($view == true) { 
                echo "View";
              } else {
                echo "Edit";
              } ?> Immunization
              <a href="ImmunizationDtl.php?History=<?php echo $picmeNo; ?>"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
			  <?php $Edit_ind = "N"; ?>
			  <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; $Edit_ind = "Y"; ?>" onclick="fnImEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>
            <?php if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1' || $_SESSION["usertype"] == '2') { ?>
              <?php
			 // PRINT_R($picmeNo); EXIT;
			  $rec_del_pic = mysqli_query($conn, "SELECT * FROM immunization im WHERE im.picmeNo = $picmeNo AND
		                       im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo)");
				          $n_del = mysqli_fetch_array($rec_del_pic);
	          $Del_picmeNo = "";
	          $Del_picmeNo = $n_del['picmeNo'];
			  
			  if(($n_del['id']==$id))
			  {
			  ?>
			  	  <a href="../forms/ViewEditImmunization.php?del=<?php echo $n_del['id']; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>
			  <?php }
			  else
			  { 
		       if ($del_view_ind == "Y")
			   { 
		        echo "<script>alert('Can delete only the most recent dose !!!')</script>"; ?>
				 <a href="../forms/ViewEditImmunization.php?delview=<?php echo $id; ?>"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a> 
			   <?php }
		   else
		   { ?>
		     <a href="../forms/ViewEditImmunization.php?delview=<?php echo $id; ?>"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>   
			  
			  
			<?php }}} ?>
              
			</h4>
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">
                      <?php if($view == true) { 
                        echo "View";
                        } else {
                        echo "Edit";
                        } ?> Immunization
					  </h5>
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                      <form action="" method="post" enctype="multipart/form-data">
      
				<div class="errMsg" id="errMsg"></div>
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">PICME No. <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                          <label class="lblViolet"><?php echo $picmeNo; ?>
                              </label>
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Dose No. <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required type="checkbox" name="doseNo" id="doseNo" class="form-select doseNo" disabled>
                          <?php 
                            $query = mysqli_query($conn, "SELECT i.doseNo,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.doseNo=e.enumid WHERE type=42 AND i.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option selected=true value="<?php echo $status_list['enumid'];  ?>">
									<?php echo $status_list['enumvalue']; ?>

									<?php 
								
									if($status_list['enumid'] == 1)
									{
										
										?>
								        <option value>Choose </option>
										<option value="1">Dose 1 (Day 45)</option>
									<?php } ?>
									
									<?php 
								
									if($status_list['enumid'] == 2)
									{
										
										?>
										<option value>Choose </option>
										<option value="2">Dose 2 (Day 75)</option>
									<?php } ?>
									
									<?php 
								
									if($status_list['enumid'] == 3)
									{
										
										?>
										<option value>Choose </option>
										<option value="3">Dose 3 (Day 105)</option>
										
									<?php } ?>
									
									<?php 
								
									if($status_list['enumid'] == 4)
									{
										
										?>
										<option value>Choose </option>
										<option value="4">Dose 4 (Day 270)</option>
										
									<?php } ?>
									
									<?php 
								
									if($status_list['enumid'] == 5)
									{
										
										?>
										<option value>Choose </option>
										<option value="5">Dose 5 (Day 480)</option>
										
									<?php } ?>
									                                   
                                    </option>
                                    <?php } 
                                      ?>
                             </select>
							 
                            </div>
							<?php if(isset($_POST['formSubmit'])) 
                              { }
					          else 
					          {
							   echo("\n<p>Dose Name Change? - Select Dose No</p>\n"); 
							  } ?>
                        </div>
						
                    </div>
					<div class="row">
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">Dose Name <span class="mand">* </span></label>
                         <div class="input-group input-group-merge">
						  
						  <select required name="doseName[]" id="doseName" multiple class="form-select doseName" disabled>
						  						  
                          <?php 
						 
                            $query = mysqli_query($conn, "SELECT i.doseName,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.doseName=e.enumid WHERE type=43 AND i.id=".$id);
                            
							while($status_list=mysqli_fetch_array($query)){
							
								$dose_ind = "Y";
							
                              for($i=0; $i < count($dnArr); $i++) {
								  
                                ?>
								
                                    <option selected=true value="<?php if(in_array($status_list['enumid'], $dnArr)){ echo "selected"; } ?>">
                                   
                                    <?php 
									if ($dnArr[$i] == "11") { echo "OPV-1";}elseif($dnArr[$i] == "12") { echo "Rota-1"; }
                                    elseif($dnArr[$i] == "13") { echo "IPV-1"; }elseif($dnArr[$i] == "14") { echo "PCV-1"; }
                                    elseif($dnArr[$i] == "15") { echo "Pentavalent-1"; } 
                                    
                                    if ($dnArr[$i] == "21") { echo "OPV-2";}elseif($dnArr[$i] == "22") { echo "Rota-2"; }
                                    elseif($dnArr[$i] == "23") { echo "Pentavalent-2"; } 
                                    
                                    if ($dnArr[$i] == "31") { echo "OPV-3";}elseif($dnArr[$i] == "32") { echo "Rota-3"; }
                                    elseif($dnArr[$i] == "33") { echo "IPV-2"; }elseif($dnArr[$i] == "34") { echo "PCV-2"; }
                                    elseif($dnArr[$i] == "35") { echo "Pentavalent-3"; } 
                                    
                                    if ($dnArr[$i] == "41") { echo "MR-1";}elseif($dnArr[$i] == "42") { echo "JE-1"; }
                                    elseif($dnArr[$i] == "43") { echo "PCV-B"; }

                                    
                                    if ($dnArr[$i] == "51") { echo "OPV-Booster";}elseif($dnArr[$i] == "52") { echo "MR-2"; }
                                    elseif($dnArr[$i] == "53") { echo "JE-2"; }elseif($dnArr[$i] == "54") { echo "DPT Booster-1"; }
                                    ?>
                                    </option>
                                    <?php }
                            } 
                                      ?>
                             </select>
                          </div>
                        </div>
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">Dose Due Date <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="doseDueDate"
                              id="doseDueDate"
                              class="form-control"
                              placeholder="Dose Due Date"
                              aria-label="Dose Due Date"
                              aria-describedby="basic-icon-default-conpassword" 
                              value="<?php echo $doseDueDate; ?>" 
                              disabled
							  readonly = "readonly"
                              required 
                              />
                          </div>
                        </div>
					</div>
					<div class="row">
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Dose Provided Date <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="doseProvidedDate"
                              id="doseProvidedDate"
                              class="form-control phone-mask"
                              placeholder="Dose Provided Date"
                              aria-label="Dose Provided Date"
                              aria-describedby="basic-icon-default-mobile"
                              value="<?php echo $doseProvidedDate; ?>" 
                              disabled
                              required
                              />
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Breast Feeding</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="breastFeeding" id="breastFeeding" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT i.breastFeeding,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.breastFeeding=e.enumid WHERE type=13 AND i.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$breastFeeding){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    </option>
                                    <?php } 
                                     } ?>
                             </select>
						</div>
					  </div>
					</div>
                    <div class="row">
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Complimentary Food Started ( 7th Month )</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="compliFoodStart" id="compliFoodStart" class="form-select" disabled>
                          <?php   
                            $query = mysqli_query($conn, "SELECT i.compliFoodStart,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.compliFoodStart=e.enumid WHERE type=13 AND i.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$compliFoodStart){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    </option>
                                    <?php } 
                                     } ?>
                             </select>
						</div>
						</div>
						<!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 1 Done</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="motherCovidVac1Done" id="motherCovidVac1Done" class="form-select" onchange="VacDone1()" disabled>
                          <?php   
                            $query = mysqli_query($conn, "SELECT i.motherCovidVac1Done,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.motherCovidVac1Done=e.enumid WHERE type=13 AND i.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$motherCovidVac1Done){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    </option>
                                    <?php } 
                                     } ?>
                             </select>
						</div>
						</div> -->
					</div>
            <!-- <div class="row">
						<div class="col-6 mb-3" id="motherCovidVac1T" style="display: none;">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 1 Type</label>
                          
            <div class="input-group input-group-merge">
                          <?php if($update == true || $view == true) { ?>
                          <select name="motherCovidVac1Type" id="motherCovidVac1Type" class="form-select" disabled>
                            <?php
                            $list=mysqli_query($conn, "SELECT i.motherCovidVac1Type,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.motherCovidVac1Type=e.enumid WHERE type=18 AND i.id=".$id);
                            while($row_list=mysqli_fetch_assoc($list)){
                            ?>
                        <option value="<?php echo $row_list['enumid']; ?>">
                        <?php if($row_list['enumvalue']== $motherCovidVac1Type){ echo $row_list['enumvalue']; } ?></option>
                                <?php 
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=18";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } } ?>
                                </select>
                            <?php } ?>
						              </div>
						</div>
						<div class="col-6 mb-3" id="motherCovidVac1D" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">Mother Vaccine 1 Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherCovidVac1Date"
                              id="motherCovidVac1Date"
                              class="form-control"
                              placeholder="Mother Vaccine 1 Date"
                              aria-label="CMother Vaccine 1 Date"
                              aria-describedby="basic-icon-default-conpassword" 
                              value="<?php echo $motherCovidVac1Date;  ?>" 
                              disabled
                              />
                          </div>
                        </div>
					</div> -->
					<!-- <div class="row"> -->
					<!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 2 Done</label>
                          <div class="input-group input-group-merge">
                              <?php if($view == true) { ?>
                          
                           <select name="motherCovidVac2Done" id="motherCovidVac2Done" class="form-select" disabled>
                            <?php
                            $list=mysqli_query($conn, "SELECT i.motherCovidVac2Done,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.motherCovidVac2Done=e.enumid WHERE type=13 AND i.id=".$id);
                            while($row_list=mysqli_fetch_assoc($list)){
                            ?>
                        <option value="<?php echo $row_list['enumid']; ?>">
                        <?php if($status_list['enumvalue']==$motherCovidVac2Done){ echo "selected"; } ?>
                        <?php echo $status_list['enumvalue']; ?>
                                <?php 
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          </option>
                          <?php } } ?>
                                </select>
                            <?php } ?>
						              </div>
						</div>
						<div id="motherCovidVac2T" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 2 Type</label>
                          <div class="input-group input-group-merge">
                              <?php if($view == true) { ?>
                          <select name="motherCovidVac2Type" id="motherCovidVac2Type" class="form-select" disabled>
                          <?php   
                            $query = mysqli_query($conn, "SELECT i.motherCovidVac2Type,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.motherCovidVac2Type=e.enumid WHERE type=18 AND i.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$motherCovidVac2Type){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    <option value="1">Covaxin</option>
                                     <option value="2">Covishield</option>
                                    </option>
                                    <?php } 
                                     } ?>
                             </select>
						</div>
						</div>
					</div> -->
					<!-- <div class="row"> -->
					<!-- <div id="motherCovidVac2D" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">Mother Vaccine 2 Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherCovidVac2Date"
                              id="motherCovidVac2Date"
                              class="form-control"
                              placeholder="Mother Vaccine 2 Date"
                              aria-label="Mother Vaccine 2 Date"
                              aria-describedby="basic-icon-default-conpassword" 
                              value="<?php echo $motherCovidVac2Date;  ?>" 
                              disabled
                              />
                          </div>
                        </div> -->
						<!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine Booster Done</label>
                          <div class="input-group input-group-merge">
                              <?php if($view == true) { ?>
                          <select name="motherCovidVacBoosterDone" id="motherCovidVacBoosterDone" class="form-select" onchange="Bdose()" disabled>
                          <?php   
                             $query = mysqli_query($conn, "SELECT i.motherCovidVac1Done,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.motherCovidVac1Done=e.enumid WHERE type=13 AND i.id=".$id);
                             while($status_list=mysqli_fetch_assoc($query)){
                                 ?>
                                     <option value="<?php echo $status_list['enumid']; ?>">
                                     <?php if($status_list['enumvalue']==$motherCovidVacBoosterDone){ echo "selected"; } ?>
                                     <?php echo $status_list['enumvalue']; ?>
                                     <option value="1">Yes</option>
                                     <option value="0">No</option>
                                     </option>
                                     <?php } 
                                      } ?>
                              </select>
						</div>
						</div> -->
					<!-- </div>
					<div class="row">
					<div id="motherCovidVacBooster" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine Booster Type</label>
                          <div class="input-group input-group-merge">
                              <?php if($view == true) { ?>
                          <select name="motherCovidVacBoosterType" id="motherCovidVacBoosterType" class="form-select" disabled>
                          <?php   
                             $query = mysqli_query($conn, "SELECT i.motherCovidVacBoosterType,e.enumid,e.enumvalue FROM immunization i join enumdata e on i.motherCovidVacBoosterType=e.enumid WHERE type=18 AND i.id=".$id);
                             while($status_list=mysqli_fetch_assoc($query)){
                                 ?>
                                     <option value="<?php echo $status_list['enumid']; ?>">
                                     <?php if($status_list['enumvalue']==$motherCovidVacBoosterType){ echo "selected"; } ?>
                                     <?php echo $status_list['enumvalue']; ?>
                                     <option value="1">Covaxin</option>
                                     <option value="2">Covishield</option>
                                     </option>
                                     <?php } 
                                      } ?>
                              </select>
						</div>
					</div>
					<div id="motherCovidVacBoosterD" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">Mother Vaccine Booster Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherCovidVacBoosterDate"
                              id="motherCovidVacBoosterDate"
                              class="form-control"
                              placeholder="Mother Vaccine Booster Date"
                              aria-label="Mother Vaccine Booster Date"
                              aria-describedby="basic-icon-default-conpassword" 
                              value="<?php echo $motherCovidVacBoosterDate;  ?>"
                              disabled
                              />
                          </div>
                        </div>
					</div> -->
					<div class="input-group" id="btnSaUp" style="display:none">
                    <input class="btn btn-primary" type="submit" id="update" name="update" value="Update">
					              </button></a>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>