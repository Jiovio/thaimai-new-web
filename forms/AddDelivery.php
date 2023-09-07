<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (! empty($_POST["addDelivery"])) {
  $picmeno = $_POST["picmeno"]; $deliverydate = $_POST["deliverydate"]; $deliverytime = $_POST["deliverytime"]; $deliverydistrict = $_POST["deliverydistrict"];
  $hospitaltype = $_POST["hospitaltype"]; $hospitalname = $_POST["hospitalname"]; $childGender = $_POST["childGender"]; $deliveryConductBy = $_POST["deliveryConductBy"];
  $deliverytype = $_POST["deliverytype"];$deliveryCompilcation = $_POST["deliveryCompilcation"]; $deliveryOutcome = $_POST["deliveryOutcome"];

  $noOfLiveBirth = $_POST["noOfLiveBirth"]; $noOfStillBirth = $_POST["noOfStillBirth"]; $infantId = $_POST["infantId"]; $birthDetails = $_POST["birthDetails"];
  $birthWeight = $_POST["birthWeight"]; $birthHeight = $_POST["birthHeight"]; $delayedCClamping = $_POST["delayedCClamping"]; $skintoskinContact = $_POST["skintoskinContact"];
 $breastfeedInitiated = $_POST["breastfeedInitiated"]; $admittedSncu = $_POST["admittedSncu"]; $sncudate = $_POST["sncudate"]; $sncuAreaName = $_POST["sncuAreaName"]; $sncuOutcome = $_POST["sncuOutcome"]; 
 $dischargedate = $_POST["dischargedate"]; $dischargetime = $_POST["dischargetime"]; $bcgdate = $_POST["bcgdate"]; $opvDdate = $_POST["opvDdate"];
 $hebBdate = $_POST["hebBdate"]; $injuction = $_POST["injuction"]; 
  
  $query = mysqli_query($conn,"INSERT INTO deliverydetails(picmeno, deliverydate, Deliverytime, Deliverydistrict, 
  Hospitaltype, Hospitalname, childGender, DeliveryConductBy, Deliverytype, DeliveryCompilcation, DeliveryOutcome, 
  noOfLiveBirth, noOfStillBirth, infantId, birthDetails, birthWeight, birthHeight, DelayedCClamping, skintoskinContact, 
  breastfeedInitiated, admittedSncu, sncudate, sncuAreaName, sncuOutcome, Dischargedate, Dischargetime, bcgdate, 
  opvDdate, HebBdate,injuction,createdBy) 
  VALUES ('$picmeno','$deliverydate','$deliverytime','$deliverydistrict','$hospitaltype','$hospitalname','$childGender','$deliveryConductBy','$deliverytype',
  '$deliveryCompilcation','$deliveryOutcome','$noOfLiveBirth','$noOfStillBirth','$infantId','$birthDetails','$birthWeight','$birthHeight','$delayedCClamping',
  '$skintoskinContact','$breastfeedInitiated','$admittedSncu','$sncudate','$sncuAreaName','$sncuOutcome','$dischargedate','$dischargetime','$bcgdate','$opvDdate','$hebBdate','$injuction','$userid')");

if (!empty($query)) {
            echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/DeliveryDetails.php');</script>";
          } }
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Delivery /</span> 
              Add Delivery
             <a href="DeliveryDetails.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a> 
			</h4>
            <form action="" autocomplete="off" method="post">
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Delivery Details</span></h4>
                        <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
				<div class="errMsg" id="errMsg"></div>
            <div class="row">
              <div class="col-6 mb-3">
                  <label class="form-label" for="basic-icon-default-fullname">PICME NUMBER <span class="mand">* </span></label>
                  <div class="frmSearch">
                  <input type="text" required id="picmenoNew" name="picmeno" oninput = "onlyNumbers(this.value)" placeholder="PICME Number" class="form-control" />
                  <div id="suggesstion-box"></div>
                 </div>
                </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">DELIVERY DATE <span class="mand">* </span></label>
                            <input
                              type="date"
                              name="deliverydate"
                              id="deliverydate"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                               required
                            />
                          
                        </div>
            </div>
                <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">DELIVERY TIME <span class="mand">* </span></label>
                            <input
                              type="time"
                              name="deliverytime"
                              id="deliverytime"
                              class="form-control"
                              placeholder="DELIVERY TIME"
                              aria-label="DELIVERY TIME"
                              aria-describedby="basic-icon-default-password2"
                              required
                            />
                          
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY DISTRICT</label>
                            <input
                              type="text"
                              name="deliverydistrict"
                              id="deliverydistrict"
                              class="form-control phone-mask"
                              placeholder="DELIVERY DISTRICT"
                              aria-label="DELIVERY DISTRICT"
                              aria-describedby="basic-icon-default-mobile"
                            
                            />
                          
                        </div>
                 </div>
                        
                        <div class="row">
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HOSPITAL TYPE</label>
                          <div class="input-group input-group-merge">
                            
                          <select name="hospitaltype" id="hospitaltype" class="form-select">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=25";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">HOSPITAL NAME</label>
                            <input
                              type="text"
                              name="hospitalname"
                              id="hospitalname"
                              class="form-control"
                              placeholder="HOSPITAL NAME"
                              aria-label="HOSPITAL NAME"
                              aria-describedby="basic-icon-default-email2"
                            
                            />
                          </div>
                        </div>
                        <div class="row">

                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">CHILD GENDER <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select required name="childGender" id="childGender" class="form-select" >
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=34";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY CONDUCTED BY <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select required name="deliveryConductBy" id="deliveryConductBy" class="form-select">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=35";
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
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY TYPE</label>
                          <div class="input-group input-group-merge">
                
                          <select name="deliverytype" id="deliverytype" class="form-select" >
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=36";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>
                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY COMPLICATION <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select name="deliveryCompilcation" required id="deliveryCompilcation" class="form-select" >
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=37";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php } ?>
                             </select>
                      </div>
                  </div>
                 </div>
                 <div class="row">

                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY OUTCOME <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select name="deliveryOutcome" required id="deliveryOutcome" class="form-select" >
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=38";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>

                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">NO. OF LIVE BIRTH <span class="mand">* </span></label>
                            <input
                              type="number"
                              name="noOfLiveBirth"
                              id="noOfLiveBirth"
                              class="form-control"
                              placeholder="NO OF LIVE BIRTH"
                              aria-label="NO OF LIVE BIRTH"
                              aria-describedby="basic-icon-default-password2"
                              required
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">NO. OF STILL BIRTH</label>
                            <input
                              type="number"
                              name="noOfStillBirth"
                              id="noOfStillBirth"
                              class="form-control"
                              placeholder="NO OF STILL BIRTH"
                              aria-label="NO OF STILL BIRTH"
                              aria-describedby="basic-icon-default-password2"
                        
                            />
                          </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">INFANT ID</label>
                            <input
                              type="text"
                              name="infantId"
                              id="infantId"
                              class="form-control"
                              placeholder="INFANT ID"
                              aria-label="INFANT ID"
                              aria-describedby="basic-icon-default-password2"
                        
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">BIRTH DETAILS <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select required name="birthDetails" id="birthDetails" class="form-select" >
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=39";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>
                 
                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BIRTH WEIGHT <span class="mand">* </span></label>
                            <input
                              type="number"
							  step = "0.01"
                              name="birthWeight"
                              id="birthWeight"
                              class="form-control"
                              placeholder="BIRTH WEIGHT"
                              aria-label="BIRTH WEIGHT"
                              aria-describedby="basic-icon-default-password2"
                              required
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BIRTH HEIGHT</label>
                            <input
                              type="text"
                              name="birthHeight"
                              id="birthHeight"
                              class="form-control"
                              placeholder="BIRTH HEIGHT"
                              aria-label="BIRTH HEIGHT"
                              aria-describedby="basic-icon-default-password2"
                            />
                          </div>
                        
                        <div class="mb-3 col-md-6">
                            <label class="form-label">DELAYED CORD CLAMPING</label>
                            <select name="delayedCClamping" id="delayedCClamping" class="form-select">
                          <option value="">Choose...</option>
                           <?php  
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                              ?>
                             </select>
                          </div>
                 </div>
                 <div class="row">

                          <div class="mb-3 col-md-6">
                            <label class="form-label">SKIN TO SKIN CONTACT</label>
                            <select name="skintoskinContact" id="skintoskinContact" class="form-select">
                          <option value="">Choose...</option>
                           
                           <?php  
                          

                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                              ?>
                             </select>
                          </div>
                        
                          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BREAST FEEDING Within Half Hour</label>
                          <select required name="breastfeedInitiated" id="breastfeedInitiated" class="form-select">
                          <option value="">Choose...</option>
                           
                           <?php  
                          

                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                              ?>
                             </select>  
                          </div>
                 </div>
                 <div class="row">

                          <div class="mb-3 col-md-6">
                            <label class="form-label">ADMITTED SNCU <span class="mand">* </span></label>
                            <select required name="admittedSncu" id="admittedSncu" class="form-select" onchange="SncuChange()">
                          <option value="">Choose...</option>
                           
                           <?php  
                          

                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                              ?>
                             </select>
                          </div>

                          <div class="col-6 mb-3" id="sncuDate" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">SNCU DATE</label>
                            <input
                              type="date"
                              name="sncudate"
                              id="sncudate"
                              class="form-control"
                              placeholder="SNCU DATE"
                              aria-label="SNCU DATE"
                              aria-describedby="basic-icon-default-password2"
                        
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3"  id="sncuName" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">SNCU AREA NAME</label>
                            <input
                              type="text"
                              name="sncuAreaName"
                              id="sncuAreaName"
                              class="form-control"
                              placeholder="SNCU AREA NAME"
                              aria-label="SNCU AREA NAME"
                              aria-describedby="basic-icon-default-password2"
                        
                            />
                          
                        </div>
                       
                        <div class="col-6 mb-3"  id="sncuCome" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">SNCU OUTCOME</label>
                            <input
                              type="text"
                              name="sncuOutcome"
                              id="sncuOutcome"
                              class="form-control"
                              placeholder="SNCU OUTCOME"
                              aria-label="SNCU OUTCOME"
                              aria-describedby="basic-icon-default-password2"
                        
                            />
                          
                        </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">DISCHARGE DATE <span class="mand">* </span></label>
                            <input
                              type="date"
                              name="dischargedate"
                              id="dischargedate"
                              class="form-control"
                              placeholder="DISCHARGE DATE"
                              aria-label="DISCHARGE DATE"
                              aria-describedby="basic-icon-default-password2"
                              required
                            />
                          
                        </div>
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">DISCHARGE TIME <span class="mand">* </span></label>
                            <input
                              type="time"
                              name="dischargetime"
                              id="dischargetime"
                              class="form-control"
                              placeholder="DISCHARGE TIME"
                              aria-label="DISCHARGE TIME"
                              aria-describedby="basic-icon-default-password2"
                              required
                            />
                        </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BCG DATE</label>
                            <input
                              type="date"
                              name="bcgdate"
                              id="bcgdate"
                              class="form-control"
                              placeholder="BCG DATE"
                              aria-label="BCG DATE"
                              aria-describedby="basic-icon-default-password2"
                        
                            />
                          
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">OPV-0 DATE <span class="mand">* </span></label>
                           <input
                              type="date"
                              name="opvDdate"
                              id="opvDdate"
                              class="form-control"
                              placeholder="OPV-D DATE"
                              aria-label="OPV-D DATE"
                              aria-describedby="basic-icon-default-password2"
                              required
                            />
                         
                        </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">HEP-B DATE</label>
                          
                            <input
                              type="date"
                              name="hebBdate"
                              id="hebBdate"
                              class="form-control"
                              placeholder="HEB-B DATE"
                              aria-label="HEB-B DATE"
                              aria-describedby="basic-icon-default-password2"
                        
                            />  
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Vitamin K Injection</label>
                            <select name="injuction" id="injuction" class="form-select">
                          <option value="">Choose...</option>
                           
                           <?php  
                          

                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                              ?>
                             </select>
                          </div>
                        </div>
                        <div class="mt-2">
                        <input class="btn btn-primary" type="submit" name="addDelivery" value="Save" onclick="return validateAddDelivery()">
                        </div>
                </div>
                
              
              </div>
            </div>
			</div>
			</div><!--Mother Details Close-->
            
			</form>
			<!-- / Content -->
<?php include ('require/footer.php'); ?>
