<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
$motheraadhaarid = ""; $residentType =""; $ptest = ""; $gravida = ""; $para = ""; $child = ""; $ab = "";
$hrPreg = "" ; $obcode = ""; $height = ""; $weight = ""; $bp = ""; $dia = ""; $date = ""; $mrmbs = "";

$id = 0; $update = false; $view = false; $url='AnRegisterlist.php'; 

if (isset($_GET['view'])) {
  $id = $_GET['view'];
  $view = true;
  
  $record = mysqli_query($conn, "SELECT * FROM anregistration WHERE id=$id");
  $vi = mysqli_fetch_array($record);
  $motheraadhaarid = $vi["motheraadhaarid"];
  $picmeno =$vi["picmeno"];
  $picmeRegDate =$vi["picmeRegDate"];
  $residentType = $vi["residentType"]; 
  $ptest = $vi["pregnancyTestResult"]; 
  $methodofConception = $vi["methodofConception"];
  $gravida = $vi["gravida"]; 
  $para = $vi["para"];
  $child = $vi["livingChildren"]; 
  $ab = $vi["abortion"]; 
  $cd = $vi["childDeath"];
  $hrPreg = $vi["hrPregnancy"]; 
  $obcode = $vi["obstetricCode"]; 
  $height = $vi["motherHeight"];
  $weight = $vi["motherWeight"]; 
  $bp = $vi["bpSys"]; 
  $dia = $vi["bpDia"];
  $rgdate = $vi["anRegDate"]; 
  $mrmbs = $vi["mrmbsEligible"];
  $MotherAge = $vi["MotherAge"]; 
  $HusbandAge = $vi["HusbandAge"];
}

if (! empty($_POST['update'])) {
    $id = $_POST["id"];
    $picmeRegDate =$_POST["picmeRegDate"];
    $residentType =$_POST["residentType"]; 
    $ptest = $_POST["pregnancyTestResult"]; 
    $methodofConception = $vi["methodofConception"];
    $gravida = $_POST["gravida"]; 
    $para = $_POST["para"];
    $child = $_POST["livingChildren"]; 
    $ab = $_POST["abortion"]; 
    $cd = $_POST["childDeath"];
    $hrPreg = $_POST["hrPregnancy"]; 
    $obcode = $_POST["obstetricCode"]; 
    $height = $_POST["motherHeight"];
    $weight = $_POST["motherWeight"]; 
    $bp = $_POST["bpSys"]; 
    $dia = $_POST["bpDia"];
    $rgdate = $_POST["anRegDate"]; 
    $mrmbs = $_POST["mrmbsEligible"];
    $MotherAge = $_POST["MotherAge"]; 
    $HusbandAge = $_POST["HusbandAge"];

 date_default_timezone_set('Asia/Kolkata');
 $date = date('d-m-Y h:i:s');
$uquery = mysqli_query($conn, "UPDATE anregistration SET picmeRegDate='$picmeRegDate',residentType='$residentType', pregnancyTestResult='$ptest', methodofConception='$methodofConception', gravida='$gravida', para='$para',
livingChildren='$child', abortion='$ab', childDeath='$cd', hrPregnancy='$hrPreg', obstetricCode='$obcode', motherHeight='$height', motherWeight='$weight', bpSys='$bp', bpDia='$dia',
anRegDate='$rgdate', mrmbsEligible='$mrmbs',MotherAge='$MotherAge',HusbandAge='$HusbandAge', updatedat='$date',updatedBy='$userid' WHERE id=$id");
 if (!empty($query)) {
  echo "<script>alert('Update Successfully');</script>";
  } 
  // else { 
  // echo "<script>alert('Check The Fields');</script>";
  // }
 }
if (isset($_GET['del'])) {
  $id = $_GET['del'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
  mysqli_query($conn, "UPDATE anregistration SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND  id=$id");
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Location: AnRegisterlist.php');
    exit;
  }
}
?>        
<!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Registation /</span> View Antenatal Registation
            <a href="AnRegisterlist.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
              
              <a href="../forms/ViewEditAntenatal.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>

              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnAnEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>
            </h4>
            <div class="row">
                    <div class="col-md-12">
                <div class="card mb-4">
                <hr class="my-0" />
                <div class="card-body">
                <form id="formAccountSettings" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="row">                 
                    <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-password">MOTHER AADHAAR ID</label>
                          <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $motheraadhaarid; ?>
                              </label>
                             
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER NAME AS PER AADHAAR</label>
                          <div class="input-group input-group-merge">
                            <?php $query = mysqli_query($conn,"SELECT an.motheraadhaarid, ec.motheraadhaarname FROM anregistration an join ecregister ec on ec.motheraadhaarid=an.motheraadhaarid WHERE an.motheraadhaarid=".$motheraadhaarid); 
                            while ($mid = mysqli_fetch_assoc($query)) {
                              $motheraadhaarname = $mid["motheraadhaarname"];
                            }
                            ?>
                            <label class="lblViolet" ><?php echo $motheraadhaarname; ?>
                              </label>
                            
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND NAME AS PER AADHAAR</label>
                          <div class="input-group input-group-merge">
                            <?php $query = mysqli_query($conn,"SELECT an.motheraadhaarid, ec.husbandaadhaarname FROM anregistration an join ecregister ec on ec.motheraadhaarid=an.motheraadhaarid WHERE an.motheraadhaarid=".$motheraadhaarid); 
                            while ($mid = mysqli_fetch_assoc($query)) {
                              $husbandaadhaarname = $mid["husbandaadhaarname"];
                            }
                            ?>
                            <label class="lblViolet"><?php echo $husbandaadhaarname; ?>
                              </label> 
                          </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                
                    <hr class="my-0" />
                    <div class="card-body">
                      
                        <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-password">PICME No. </label>
                          <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $picmeno; ?>
                              </label>
                             
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">PICME REGISTER DATE <span class="mand">* </span></label>
                            <input
                              type="date"
                              class="form-control"
                              id="picmeRegDate"
                              name="picmeRegDate"
                              placeholder="PICME REGISTER DATE"
                              value="<?php echo $picmeRegDate; ?>"
                              disabled
                              required
                            />
                          </div>
                          </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">RESIDENT TYPE</label>
                            <?php if($update == true || $view == true) { ?>
                          <select name="residentType" id="residentType" class="form-select" value="<?php echo $residentType; ?>" disabled>
                          <?php $list=mysqli_query($conn, "SELECT an.residentType,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.residentType WHERE type=10 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){ ?>
                                    <option value="<?php echo $row_list['enumid']; ?>">
                                    <?php if($row_list['enumvalue']==$residentType) ?>
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=10";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?> 
                    </select>
                       <?php } ?>
                          </div>
                        
                          <div class="mb-3 col-md-6">
                            <label class="form-label">PREGNANCY TEST RESULT <span class="mand">* </span></label>
                            <?php if($update == true || $view == true) { ?>
                          <select required name="pregnancyTestResult" id="pregnancyTestResult" class="form-select" value="<?php echo $ptest; ?>" disabled>
                          <?php $list=mysqli_query($conn, "SELECT an.pregnancyTestResult,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.pregnancyTestResult WHERE type=11 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){ ?>
                                  <option value="<?php echo $row_list['enumid']; ?>">
                                  <?php if($row_list['enumvalue']==$ptest) ?>
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?>
                    </select>
                       <?php } ?>
                          </div>
                          </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Method Of Conception <span class="mand">* </span></label>
                            <?php if($update == true || $view == true) { ?>
                          <select required name="methodofConception" id="methodofConception" class="form-select" value="<?php echo $ptest; ?>" disabled>
                          <?php $list=mysqli_query($conn, "SELECT an.methodofConception,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.methodofConception WHERE type=45 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){ ?>
                                <option value="<?php echo $row_list['enumid']; ?>">
                                <?php if($row_list['enumvalue']==$methodofConception) ?>
                                <?php { echo $row_list['enumvalue']; } ?>
                                <?php 
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=45";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?> 
                    </select>
                       <?php } ?>
                          </div>
                        
                          <div class="mb-3 col-md-6">
                            <label class="form-label">GRAVIDA <span class="mand">* </span></label>
                            <?php if($update == true || $view == true) { ?>
                            <select onfocus="this.value=''" name="gravida" id="gravida" class="form-select" value="<?php echo $gravida; ?>" disabled>
                            <?php $list=mysqli_query($conn, "SELECT an.gravida,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.gravida WHERE type=40 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){ ?>
                                <option value="<?php echo $row_list['enumid']; ?>">
                                <?php if($row_list['enumvalue']==$gravida) ?>
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=40";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?>
                    </select>
                       <?php } ?>
                          </div>
                          </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                          <label class="form-label">PARA <span class="mand">* </span></label>
                          <?php if($update == true || $view == true) { ?>
                            <select required name="para" id="para" onfocus="this.value=''" class="form-select" value="<?php echo $para; ?>" disabled>
                            <?php $list=mysqli_query($conn, "SELECT an.para,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.para WHERE type=12 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){ ?>
                              <option value="<?php echo $row_list['enumid']; ?>">
                              <?php if($row_list['enumvalue']==$para){ echo $row_list['enumvalue'];  } ?></option>
                              <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?> 
                    </select>
                       <?php } ?>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                          <label class="form-label">LIVING CHILDREN <span class="mand">* </span></label>
                          <?php if($update == true || $view == true) { ?>
                            <select required name="livingChildren" id="livingChildren" onfocus="this.value=''" class="form-select" value="<?php echo $child; ?>" disabled>
                            <?php $list=mysqli_query($conn, "SELECT an.livingChildren,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.livingChildren WHERE type=12 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){ ?>
                                <option value="<?php echo $row_list['enumid']; ?>">
                                <?php if($row_list['enumvalue']==$child) ?>
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?>
                    </select>
                       <?php } ?>
                         </div>
                         
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                          <label class="form-label">ABORTION <span class="mand">* </span></label>
                          <?php if($update == true || $view == true) { ?>
                            <select required name="abortion" id="abortion" class="form-select" onfocus="this.value=''" disabled>
                            <?php

                                $list=mysqli_query($conn, "SELECT an.abortion,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.abortion WHERE type=12 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$ab) ?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?>
                    </select>
                       <?php } ?>
                            </div>

                            <div class="mb-3 col-md-6">
                          <label class="form-label">Child Death <span class="mand">* </span></label>
                          <?php if($update == true || $view == true) { ?>
                            <select required name="childDeath" onclick="Obcode()" id="childDeath" onfocus="this.value=''" class="form-select" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT an.childDeath,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.childDeath WHERE type=12 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$ab) ?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?> 
                    </select>
                       <?php } ?>
                            </div>
                           
                            </div>
                    <div class="row"> 
                          <div class="mb-3 col-md-6">
                            <label class="form-label">OBSTETRIC CODE</label>
                            <input type="text" class="form-control" id="obstetricCode" value="<?php echo $obcode; ?>" name="obstetricCode" placeholder="Code" disabled/>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                          <label class="form-label">HR Pregnancy</label>
                          <?php if($update == true || $view == true) { ?>
                            <select name="hrPregnancy" id="hrPregnancy" class="form-select" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT an.hrPregnancy,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.hrPregnancy WHERE type=13 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$ab) ?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?>
                    </select>
                       <?php } ?>
                            </div> 

                            </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">MOTHER HEIGHT <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-female"></i></span>
                            <input class="form-control" type="text" id="motherHeight" value="<?php echo $height; ?>" name="motherHeight" placeholder="Height" disabled required/>
                          </div>
                          </div>
                            
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">MOTHER WEIGHT <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-female"></i></span>
                            <input
                              type="text"
                              class="form-control"
                              id="motherWeight"
                              name="motherWeight" required
                              placeholder="Mother Weight"
                              value="<?php echo $weight; ?>"
                              disabled
                            />
                          </div>
                          </div>
                          </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">BP SYSTOLIC <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-heart-circle"></i></span>
                             <input
                              type="text"
                              class="form-control"
                              id="bpSys"
                              name="bpSys" required
                              placeholder="BP SYS"
                              value="<?php echo $bp; ?>"
                              disabled
                            />
                            </div>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label">BP DIASTOLIC <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-first-aid"></i></span>
                            <input
                              type="text"
                              class="form-control"
                              id="bpDia"
                              name="bpDia" required
                              placeholder="BP DIA"
                              value="<?php echo $dia; ?>"
                              disabled
                            />
                          </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">ANTENATAL REGISTER DATE</label>
                            <input
                              type="date"
                              class="form-control"
                              id="anRegDate"
                              name="anRegDate" required
                              placeholder="ANTENATAL REGISTER DATE"
                              value="<?php echo $rgdate; ?>"
                              disabled
                            />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">MRMBS ELIGIBLE <span class="mand">* </span></label>
                            <?php if($update == true || $view == true) { ?>
                            <select required name="mrmbsEligible" id="mrmbsEligible" class="form-select" value="<?php echo $mrmbs; ?>" disabled>                           
                                <?php

                                $list=mysqli_query($conn, "SELECT an.mrmbsEligible,e.enumid,e.enumvalue from anregistration an join enumdata e ON e.enumid=an.mrmbsEligible WHERE type=13 AND an.id=".$id);
                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$mrmbs) ?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } } ?>
                    </select>
                       <?php } ?>
                          </div>
                          
                          </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Mother Age at Conception <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <input
                              type="number"
                              min="11" max="99"
                              class="form-control"
                              id="MotherAge"
                              name="MotherAge"
                              placeholder="Mother Age"
                              value="<?php echo $MotherAge; ?>"
                              disabled
                              required
                            />
                          </div>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Husband Age at Conception <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <input
                              type="number"
                              min="11" max="99"
                              class="form-control"
                              id="HusbandAge"
                              name="HusbandAge"
                              placeholder="Husband Age"
                              value="<?php echo $HusbandAge; ?>"
                              disabled
                              required
                            />
                          </div>
                          </div>
                        </div>
                        <div class="input-group" id="btnSaUp" style="display:none">
                    <input class="btn btn-primary" type="submit" id="update" name="update" value="Update">
                      </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>