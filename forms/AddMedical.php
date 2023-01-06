<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
$pNo="";
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
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('http://localhost/thaimainew/forms/MedicalHistory.php');</script>";
            } 
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
            <div class="row">
                <div class="col-6 mb-3">
                <label class="form-label" for="basic-icon-default-fullname">PICME NUMBER <span class="mand">* </span></label>
                <div class="frmSearch">
                <input type="text" required id="picmeno" name="picmeno" oninput = "onlyNumbers(this.value)" placeholder="PICME Number" class="form-control" />
                <div id="suggesstion-box"></div>
                </div>
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
			<!-- / Content -->
<?php include ('require/footer.php'); ?>
