<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (! empty($_POST["addMedical"])) {
    
  $CheckDuplicatePno = mysqli_query($conn,"SELECT picmeno FROM medicalhistory where picmeno='".$_POST["picmeno"]."' ");
  
  while($MpNovalue = mysqli_fetch_array($CheckDuplicatePno)) {
    $pNo = $MpNovalue["picmeno"];
  
  } 
  if($pNo > 0) {
   
  $type = "error";
  $emessage = "Duplicate PICME No.";
  
   } else {
  $picmeno = $_POST["picmeno"]; $lmpdate = $_POST["lmpdate"]; $edddate = $_POST["edddate"]; $reg12weeks = $_POST["reg12weeks"];
  $momBGtaken = $_POST["momBGtaken"]; $momBGtype = $_POST["momBGtype"]; $pastillness = $_POST["pastillness"]; 
  // $momVdrlRpr = $_POST["momVdrlRpr"];
  $momVdrlRprResult = $_POST["momVdrlRprResult"]; $bleedtime = $_POST["bleedtime"]; $clottime = $_POST["clotTime"]; 
  // $husVdrlRpr = $_POST["husVdrlRpr"]; 
  $husVdrlRprResult = $_POST["husVdrlRprResult"];

  //$momhbsag = $_POST["momhbsag"]; 
  $momhbresult = $_POST["momhbresult"]; 
  //$hushbsag = $_POST["hushbsag"]; 
  $hushbresult = $_POST["hushbresult"];
  //$momhivtest = $_POST["momhivtest"]; 
  $momhivtestresult = $_POST["momhivtestresult"]; 
  //$hushivtest = $_POST["hushivtest"]; 
  $anyOtherInvest = $_POST["anyOtherInvest"]; 
  $hushivtestresult = $_POST["hushivtestresult"];
  //$LastPregnancyComplication = $_POST["LastPregnancyComplication"]; 
 //$LastPregnancyOutcome = $_POST["LastPregnancyOutcome"]; 
 //$deliveryMode = $_POST["deliveryMode"];
 $totPregnancy = $_POST["totPregnancy"];
 $placeDeliveryDistrict = $_POST["placeDeliveryDistrict"];
  $hospitaltype = $_POST["hospitaltype"]; $hospitalname = $_POST["hospitalname"];
  
  $query = mysqli_query($conn,"INSERT INTO medicalhistory(picmeno, lmpdate, edddate, reg12weeks, momBGtaken,
  momBGtype, pastillness,bleedtime,clotTime, momVdrlRprResult, HusVdrlRprResult, momhbresult, 
  Hushbresult, momhivtestresult, anyOtherInvest, Hushivtestresult, 
  totPregnancy,placeDeliveryDistrict, Hospitaltype, Hospitalname, createdBy) 
  VALUES ('$picmeno','$lmpdate','$edddate','$reg12weeks','$momBGtaken','$momBGtype','$pastillness','$bleedtime','$clottime','$momVdrlRprResult',
  '$husVdrlRprResult','$momhbresult','$hushbresult','$momhivtestresult',
  '$anyOtherInvest','$hushivtestresult','$totPregnancy','$placeDeliveryDistrict','$hospitaltype','$hospitalname','$userid')");
if (!empty($query)){ 
  //$messagetype = "success";
  //$_SESSION["message"] = "Inserted Successfully";
  // print($_SESSION["message"]);
  // exit;
  //header("Location:medicalhistory.php");
  echo "<script>alert('Successfuly Saved'); window.location.href =  + $siteurl + '/medicalhistory.php';</script>";
  ob_end_flush();
  //exit(); 
} else {
  $messagetype = "error";
  $message = "Check the Fields";
}
//if (!empty($query)) { ?> 
<!-- <div class="alert alert-success alert-dismissible"><h6><i class="icon fa fa-check"></i>Inserted Successfully</h6></div> -->
<?php  //header('location: MedicalHistory.php');
//} else { ?>
<!-- <div class="alert alert-danger alert-dismissible"><h6><i class="icon fa fa-close"></i>Check the Fields User Unable to insert</h6></div> -->
<?php //} 
} } ?>
<!-- Content wrapper -->
      <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Medical /</span> 
              Add Medical
              <a href="MedicalHistory.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back</button></a>
			      </h4>
            <form action=""  autocomplete="off" method="post">
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Medical Details</span></h4>
                        <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                      
                    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } else { echo $type . " display-none"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>
                    <br>
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
            <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">PICME NUMBER <span class="mand">* </span></label>
                          <select name="picmeno" id="picmeno"  value="" class="form-control picmeno" required>
                            <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT picmeno FROM antenatalvisit WHERE status=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['picmeno']; ?>"><?php echo $listvalue['picmeno']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                          
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">LMP DATE <span class="mand">* </span></label>
                            <input
                              type="date"
                              name="lmpdate"
                              id="lmpdate" required
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                             />
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">EDD DATE <span class="mand">* </span></label>
                            <input
                              type="date"
                              name="edddate"
                              id="edddate" required
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-password2"
                            
                            />
                          
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">REGISTER 12 WEEKS <span class="mand">* </span></label>
                          <select name="reg12weeks" id="reg12weeks" class="form-select" required>
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>           
                        </div> 
                    </div>
            <div class="row">
                <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER BLOOD GROUP TAKEN <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momBGtaken" id="momBGtaken" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER BLOOD GROUP TYPE <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momBGtype" id="momBGtype" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=19";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>
                        </div>
                        
                        <div class="row">
                    
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">PAST ILLNESS <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="pastillness" id="pastillness" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=21";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>
                 
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Bleeding Time </label>
                            <input
                              type="time"
                              name="bleedtime"
                              id="bleedtime"
                              class="form-control"
                              placeholder="Bleeding Time"
                              aria-label="Bleeding Time"
                              aria-describedby="basic-icon-default-email2"
                            
                            />
                          </div>
                          </div>
                        
                        <div class="row">
                    
                          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">clotting Time </label>
                            <input
                              type="time"
                              name="clotTime"
                              id="clotTime"
                              class="form-control"
                              placeholder="Clotting Time"
                              aria-label="Clotting Time"
                              aria-describedby="basic-icon-default-email2"
                            
                            />
                          </div> 

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER VDRL RPR</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momVdrlRpr" id="momVdrlRpr" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div> -->
                        <!-- </div>
                <div class="row"> -->
                    <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER VDRl RPR RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momVdrlRprResult" id="momVdrlRprResult" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=26";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND VDRL RPR</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="husVdrlRpr" id="husVdrlRpr" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div> -->
                        </div>
                        
                        <div class="row">
                    
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND VDRl RPR RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="husVdrlRprResult" id="husVdrlRprResult" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=26";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>
                        
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HBSAG</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momhbsag" id="momhbsag" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div> -->
                        <!-- </div>
                        
                        <div class="row"> -->
                    
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HBSAG RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momhbresult" id="momhbresult" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HBSAG</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="hushbsag" id="hushbsag" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div> -->
                        </div>
                        
                        <div class="row">
                    
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HBSAG RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="hushbresult" id="hushbresult" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HIV TEST</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momhivtest" id="momhivtest" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div> -->
                        <!-- </div>
                        
                        <div class="row"> -->
                    
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HIV TEST RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="momhivtestresult" id="momhivtestresult" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>                        
                        

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HIV TEST</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="hushivtest" id="hushivtest" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div> -->
                        <!-- </div>
                        
                        <div class="row"> -->
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HIV TEST RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="hushivtestresult" id="hushivtestresult" class="form-select" required>
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Any Other Investigation With Result</label>
                            <input
                              type="text"
                              name="anyOtherInvest"
                              id="anyOtherInvest"
                              class="form-control"
                              placeholder="Any Other Investigation"
                              aria-label="Any Other Investigation"
                              aria-describedby="basic-icon-default-email2"
                              
                            />
                          </div>
                        </div>
                        
                        <!-- <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">PAST OBSTERTRIC HISTORY</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="LastPregnancyComplication" id="LastPregnancyComplication" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=23";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>
                        
                    
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">LAST PREGNANCY OUTCOME</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="LastPregnancyOutcome" id="LastPregnancyOutcome" class="form-select">
                          <option value="">Choose...</option>

                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=24";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>
                        </div> -->
                        
                        <div class="row">
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mode Of Delivery</label>
                          <div class="input-group input-group-merge">
                
                          <select name="deliveryMode" id="deliveryMode" class="form-select" >
                          <option value="">Choose...</option>
                        
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=49";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div> -->
                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Total Number Of Pregnancy <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select name="totPregnancy" id="totPregnancy" onchange="totPregnancyChange()" class="form-select" required>
                          <option value="">Choose...</option>
                        
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=52";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>
                    
                       <div class="col-6 mb-3" id="placeDelivery">
                          <label class="form-label" for="basic-icon-default-email">PREVIOUS DELIVERY DISTRICT </label>
                            <input
                              type="text"
                              name="placeDeliveryDistrict"
                              id="placeDeliveryDistrict"
                              class="form-control"
                              placeholder="PREVIOUS DELIVERY DISTRICT"
                              aria-label="PREVIOUS DELIVERY DISTRICT"
                              aria-describedby="basic-icon-default-email2"
                            
                            />
                          </div>
                          <!-- </div>
                        
                        <div class="row"> -->
                        
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">PLACE OF DELIVERY Recommended <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select name="hospitaltype" id="hospitaltype" class="form-select" required>
                          <option value="">Choose...</option>
                        
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=25";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>
                
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">Recommended HOSPITAL NAME <span class="mand">* </span></label>
                          
                            <input
                              type="text"
                              name="hospitalname"
                              id="hospitalname"
                              required
                              class="form-control"
                              placeholder="HOSPITAL NAME"
                              aria-label="HOSPITAL NAME"
                              aria-describedby="basic-icon-default-password2"
                        
                            />  
                        </div>
                </div>
                
              <div class="mt-2">
                        <input class="btn btn-primary" type="submit" name="addMedical" value="Save">
                        </div>
              </div>
            </div>
			</div>
			</div><!--Mother Details Close-->
            
			</form>
      <script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>

			<!-- / Content -->
<?php include ('require/footer.php'); ?>
