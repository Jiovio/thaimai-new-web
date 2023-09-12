<?php include ('require/topHeader.php'); ?>
<?php session_start(); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
$id = 0; $view = false;

if (isset($_GET['view'])) {
$id = $_GET['view'];
$view = true;
$record = mysqli_query($conn, "SELECT * FROM deliverydetails WHERE id=$id");

  $n = mysqli_fetch_array($record);
        $picmeno = $n["picmeno"]; $deliverydate = $n["deliverydate"]; $deliverytime = $n["deliverytime"]; $deliverydistrict = $n["deliverydistrict"];
$hospitaltype = $n["hospitaltype"]; $hospitalname = $n["hospitalname"]; $childGender = $n["childGender"]; $deliveryConductBy = $n["deliveryConductBy"];
$deliverytype = $n["deliverytype"];$deliveryCompilcation = $n["deliveryCompilcation"]; $deliveryOutcome = $n["deliveryOutcome"];

$noOfLiveBirth = $n["noOfLiveBirth"]; $noOfStillBirth = $n["noOfStillBirth"]; $infantId = $n["infantId"]; $birthDetails = $n["birthDetails"];
$birthWeight = $n["birthWeight"]; $birthHeight = $n["birthHeight"]; $delayedCClamping = $n["delayedCClamping"]; $skintoskinContact = $n["skintoskinContact"];
$breastfeedInitiated = $n["breastfeedInitiated"]; $admittedSncu = $n["admittedSncu"]; $sncudate = $n["sncudate"]; $sncuAreaName = $n["sncuAreaName"]; $sncuOutcome = $n["sncuOutcome"]; 
$dischargedate = $n["dischargedate"]; $dischargetime = $n["dischargetime"]; $bcgdate = $n["bcgdate"]; $opvDdate = $n["opvDdate"];
$hebBdate = $n["hebBdate"]; $injuction = $n["injuction"];
}

if (! empty($_POST["editDelivery"])) {
$id = $_POST["id"]; $deliverydate = $_POST["deliverydate"]; $deliverytime = $_POST["deliverytime"]; $deliverydistrict = $_POST["deliverydistrict"];
$hospitaltype = $_POST["hospitaltype"]; $hospitalname = $_POST["hospitalname"]; $childGender = $_POST["childGender"]; $deliveryConductBy = $_POST["deliveryConductBy"];
$deliverytype = $_POST["deliverytype"];$deliveryCompilcation = $_POST["deliveryCompilcation"]; $deliveryOutcome = $_POST["deliveryOutcome"];

$noOfLiveBirth = $_POST["noOfLiveBirth"]; $noOfStillBirth = $_POST["noOfStillBirth"]; $infantId = $_POST["infantId"]; $birthDetails = $_POST["birthDetails"];
$birthWeight = $_POST["birthWeight"]; $birthHeight = $_POST["birthHeight"]; $delayedCClamping = $_POST["delayedCClamping"]; $skintoskinContact = $_POST["skintoskinContact"];
$breastfeedInitiated = $_POST["breastfeedInitiated"]; $admittedSncu = $_POST["admittedSncu"]; $sncudate = $_POST["sncudate"]; $sncuAreaName = $_POST["sncuAreaName"]; $sncuOutcome = $_POST["sncuOutcome"]; 
$dischargedate = $_POST["dischargedate"]; $dischargetime = $_POST["dischargetime"]; $bcgdate = $_POST["bcgdate"]; $opvDdate = $_POST["opvDdate"];
$hebBdate = $_POST["hebBdate"]; $injuction = $_POST["injuction"];
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-Y h:i:s');
$query = mysqli_query($conn,"UPDATE deliverydetails SET deliverydate='$deliverydate',
Deliverytime='$deliverytime',Deliverydistrict='$deliverydistrict',Hospitaltype='$hospitaltype',Hospitalname='$hospitalname',
childGender='$childGender',DeliveryConductBy='$deliveryConductBy',Deliverytype='$deliverytype',
DeliveryCompilcation='$deliveryCompilcation',DeliveryOutcome='$deliveryOutcome',noOfLiveBirth='$noOfLiveBirth',
noOfStillBirth='$noOfStillBirth',infantId='$infantId',birthDetails='$birthDetails',birthWeight='$birthWeight',
birthHeight='$birthHeight',DelayedCClamping='$delayedCClamping',skintoskinContact='$skintoskinContact',
breastfeedInitiated='$breastfeedInitiated',admittedSncu='$admittedSncu',sncudate='$sncudate',sncuAreaName='$sncuAreaName',
sncuOutcome='$sncuOutcome',Dischargedate='$dischargedate',Dischargetime='$dischargetime',bcgdate='$bcgdate',
opvDdate='$opvDdate',HebBdate='$hebBdate', injuction='$injuction',updatedat='$date',updatedBy='$userid' WHERE id=".$id);
if (!empty($query)) {
            echo "<script>alert('Updated Successfully');window.location.replace('{$siteurl}/forms/DeliveryDetails.php');</script>";
          } }

if (isset($_GET['del'])) {
$id = $_GET['del'];
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-Y h:i:s');
//mysqli_query($conn, "UPDATE deliverydetails SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND id=$id");
//$_SESSION['message'] = "User deleted!"; 

$rec_del_pic = mysqli_query($conn, "SELECT * FROM deliverydetails WHERE id = $id");
				          $n_del = mysqli_fetch_array($rec_del_pic);
	          $Del_picmeNo = "";
	          $Del_picmeNo = $n_del['picmeno'];
			  
			  mysqli_query($conn, "DELETE FROM deliverydetails WHERE id=$id");
			  
mysqli_query($conn, "DELETE FROM immunization WHERE picmeNo = $Del_picmeNo");
mysqli_query($conn, "DELETE FROM postnatalvisit WHERE picmeNo = $Del_picmeNo");
  echo "<script>alert('Deleted Successfully');window.location.replace('{$siteurl}/forms/DeliveryDetails.php');</script>";
}
?>
 <!-- Content wrapper -->
     <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Delivery /</span> 
            <?php if($view == true) { 
                echo "View";
              } else {
                echo "Edit";
              } ?> Delivery
              
              <a href="DeliveryDetails.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
            <?php if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1' || $_SESSION["usertype"] == '2') { ?>              
              <a href="../forms/ViewEditDelivery.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>
            <?php } ?>
              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnDEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>

			</h4>
            <form action="" method="post">
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
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="row">
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">PICME No. <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                            <!-- <input
                              type="text"
                              name="picmeNo"
                              class="form-control"
                              id="picmeNo"
                              placeholder="PICME No."
                              aria-label="PICME No."
                              aria-describedby="basic-icon-default-fullname2"
                              value="<?php //echo $picmeno;  ?>"
                            disabled
                            required
                            /> -->
                            <label class="lblViolet"><?php echo $picmeno; ?>
                              </label>
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
							  <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min="1970-01-01" max=<?php echo $cur_dt; ?>
                              value="<?php echo $deliverydate; ?>"  
                              disabled
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
                              value="<?php echo $deliverytime ?>"
                              disabled
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
                              value="<?php echo $deliverydistrict ?>"
                              disabled
                            />
                          
                        </div>
                 </div>
                        
                        <div class="row">
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HOSPITAL TYPE</label>
                          <div class="input-group input-group-merge">
                
                          <select name="hospitaltype" id="hospitaltype" class="form-select" disabled>
                           <?php   
                            $query = "SELECT dd.hospitaltype,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.hospitaltype WHERE type=25 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$hospitaltype){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                          <option value="1">Hsc</option>
                          <option value="2">PHC</option>
                          <option value="3">UG PHC</option>
                          <option value="4">GH</option>
                          <option value="5">MCH</option>
                          <option value="6">Private Hospital</option>
                          <option value="7">PNH</option></option>
                          <option value="8">Home</option></option>
                            <?php  } 
                                ?>
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
                              value="<?php echo $hospitalname ?>"
                              disabled 
                            />
                          </div>
                        </div>
                        <div class="row">

                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">CHILD GENDER <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select required name="childGender" id="childGender" class="form-select" disabled>
                           <?php   
                            $query = "SELECT dd.childGender,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.childGender WHERE type=34 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$childGender){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">Male</option>
                          <option value="2">Female</option>
                                </option>
                            <?php  } 
                                ?>
                               </select>
                      </div>
                  </div>
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY CONDUCTED BY <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            
                          <select required name="deliveryConductBy" id="deliveryConductBy" class="form-select" disabled>                           
                              <?php   
                            $query = "SELECT dd.deliveryConductBy,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.deliveryConductBy WHERE type=35 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$deliveryConductBy){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">ANM</option>
                          <option value="2">Staff Nurse</option>
                          <option value="3">Doctor</option>
                          <option value="4">Relative</option>
                          <option value="5">Other</option>
                          <option value="6">SBA</option>
                          <option value="7">Non SBA</option>  
                                </option>
                            <?php  } 
                                ?>
                               </select>
                      </div>
                        </div>
                        </div>
                  <div class="row">

                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY TYPE</label>
                          <div class="input-group input-group-merge">
                
                          <select name="deliverytype" id="deliverytype" class="form-select" disabled>
                           <?php   
                            $query = "SELECT dd.deliverytype,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.deliverytype WHERE type=36 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$deliverytype){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">Normal</option>
                          <option value="2">Caesarian</option>
                          <option value="3">Assisted</option>
                                </option>
                            <?php  } 
                                ?>
                               </select>
                      </div>
                  </div>
                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY COMPLICATION <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select name="deliveryCompilcation" id="deliveryCompilcation" class="form-select" required disabled>
                          <?php   
                            $query = "SELECT dd.deliveryCompilcation,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.deliveryCompilcation WHERE type=37 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$deliveryCompilcation){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">PPH</option>
                          <option value="2">Retained Placenta</option>
                          <option value="3">Obstructed Labour</option>
                          <option value="4">Cord Prolapse</option>
                          <option value="5">Twins</option>
                          <option value="6">Convulsion</option>
                          <option value="7">Death</option>
                          <option value="8">Any Other</option>
                          <option value="9">Don’t Know</option>
                          <option value="10">None</option>
                          <option value="11">PROM Premature</option>                        
                                </option>
                            <?php  } 
                                ?>
                               </select>
                      </div>
                  </div>
                 </div>
                 <div class="row">

                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">DELIVERY OUTCOME <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select required name="deliveryOutcome" id="deliveryOutcome" class="form-select" disabled>
                          <?php   
                            $query = "SELECT dd.deliveryOutcome,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.deliveryOutcome WHERE type=38 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$deliveryOutcome){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">Live Birth</option>
                          <option value="2">Still Birth</option>
                          <option value="3">IUD</option>
                          <option value="4">Live Birth and Still Birth</option>
                                </option>
                            <?php  } 
                                ?>
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
							  min=0  max=10
                              value="<?php echo $noOfLiveBirth ?>"
							  required
                              disabled 
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
							  min=0  max=10
                              value="<?php echo $noOfStillBirth ?>"
                              disabled 
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
                              value="<?php echo $infantId ?>"
                              disabled
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">BIRTH DETAILS <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                
                          <select required name="birthDetails" id="birthDetails" class="form-select" disabled>
                           <?php   
                            $query = "SELECT dd.birthDetails,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.birthDetails WHERE type=39 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$birthDetails){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">Term</option>
                          <option value="2">Preterm</option>
                                </option>
                            <?php  } 
                                ?>
                               </select>
                      </div>
                  </div>
                 
                  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BIRTH WEIGHT <span class="mand">* </span></label>
                            <input
                              type="number"
                              name="birthWeight"
                              id="birthWeight"
                              class="form-control"
                              placeholder="BIRTH WEIGHT"
                              aria-label="BIRTH WEIGHT"
                              aria-describedby="basic-icon-default-password2"
                              value="<?php echo $birthWeight ?>"
							  step = "0.01"
							  min="1" max="6"
                              disabled
                              required
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BIRTH HEIGHT</label>
                            <input
                              type="number"
                              name="birthHeight"
                              id="birthHeight"
                              class="form-control"
                              placeholder="BIRTH HEIGHT"
                              aria-label="BIRTH HEIGHT"
                              aria-describedby="basic-icon-default-password2"
                              value="<?php echo $birthHeight ?>"
							  min="30" max="100"
                              disabled
                            />
                          </div>
                        
                        <div class="mb-3 col-md-6">
                            <label class="form-label">DELAYED CORD CLAMPING</label>
                            <select name="delayedCClamping" id="delayedCClamping" class="form-select" disabled>
                           <?php  
                            $query = "SELECT dd.delayedCClamping,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.delayedCClamping WHERE type=13 AND dd.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$delayedCClamping){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <option value="1">Yes</option>
                          <option value="0">No</option>
                                </option>
                            <?php  } 
                                ?>
                               </select>
                          </div>
                 </div>
                 <div class="row">

                          <div class="mb-3 col-md-6">
                            <label class="form-label">SKIN TO SKIN CONTACT</label>
                            <select name="skintoskinContact" id="skintoskinContact" class="form-select" disabled> 
                           <?php  
                          $query = "SELECT dd.skintoskinContact,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.skintoskinContact WHERE type=13 AND dd.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$skintoskinContact){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                       <option value="1">Yes</option>
                        <option value="0">No</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                          </div>
                        
                          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">BREAST FEEDING Within Half Hour</label>
                          <select name="breastfeedInitiated" id="breastfeedInitiated" class="form-select" disabled> 
                           <?php  
                          $query = "SELECT dd.breastfeedInitiated,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.breastfeedInitiated WHERE type=13 AND dd.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$breastfeedInitiated){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                       <option value="1">Yes</option>
                        <option value="0">No</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                 </div>
                 <div class="row">

                          <div class="mb-3 col-md-6">
                            <label class="form-label">ADMITTED SNCU <span class="mand">* </span></label>
                            <select required name="admittedSncu" id="admittedSncu" class="form-select" onchange="SncuChange()" disabled>  
                           <?php  
                          $query = "SELECT dd.admittedSncu,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.admittedSncu WHERE type=13 AND dd.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$admittedSncu){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                       <option value="1">Yes</option>
                        <option value="0">No</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                          </div>

                          <div class="col-6 mb-3">
						     <label class="form-label" for="basic-icon-default-email">SNCU DATE</label>
                            
                            <input
                              type="date"
                              name="sncudate"
                              id="sncudate"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
							  <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							  min=<?php echo $deliverydate; ?>  max=<?php echo $cur_dt; ?>
                              value="<?php echo $sncudate ?>"
                              disabled
                            />
                          </div>
                 </div>
                 <div class="row">

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">SNCU AREA NAME</label>
                            <input
                              type="text"
                              name="sncuAreaName"
                              id="sncuAreaName"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                              value="<?php echo $sncuAreaName ?>"
                              disabled
                            />
                          
                        </div>
                       
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">SNCU OUTCOME</label>
                            <input
                              type="text"
                              name="sncuOutcome"
                              id="sncuOutcome"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                              value="<?php echo $sncuOutcome ?>"
                              disabled
                            />
                          
                        </div>
                 </div>
                 <div class="row">
				 
				 <?php
				    //  $date="2013-03-15";
					  
					// $dt_ft = strval(date_format($date,"m/d/Y")); 
				//	echo "string".$dt_ft; 
                //    echo date($dt_ft,"Y/m/d"); exit;
				 //$disp_date = date_format("2017/12/28","Y/m/d H:i:s"); print_r($disp_date); exit; ?>  
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
							  <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min=<?php echo $deliverydate; ?>  max=<?php echo $cur_dt; ?>
                              value="<?php echo $dischargedate; ?>"     
                              disabled
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
							   <?php 
						if($deliverydate==$dischargedate)
						{?>
					           min= <?php echo $deliverytime; ?>
						<?php	
						}	
							?>  
                              value="<?php echo $dischargetime ?>"
                              disabled
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
                              <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min=<?php echo $deliverydate; ?>  max=<?php echo $cur_dt; ?>
							  value="<?php 
							  if(isset($bcgdate))
							  {
								  echo $bcgdate; 
							  }
							  else
							  {
								echo $bcgdate;
							  }; ?>"  
                              disabled
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
							  <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min=<?php echo $deliverydate; ?>  max=<?php echo $cur_dt; ?>
                              value="<?php echo $opvDdate; ?>"  
                              required							  
                              disabled
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
                               <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min=<?php echo $deliverydate; ?>  max=<?php echo $cur_dt; ?>
							   value="<?php 
							  if(isset($hebBdate))
							  {
								  echo $hebBdate; 
							  }
							  else
							  {
								echo $hebBdate;
							  }; ?>"   
                              disabled
                            />  
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Vitamin K Injection</label>
                            <select name="injuction" id="injuction" class="form-select" disabled> 
                           <?php  
                          $query = "SELECT dd.injuction,enumid,enumvalue FROM deliverydetails dd join enumdata e on e.enumid=dd.injuction WHERE type=13 AND dd.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$injuction){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                       <option value="1">Yes</option>
                        <option value="0">No</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                          </div>
                        </div>
                        <div class="input-group" id="btnSaUp" style="display:none">
                          <input class="btn btn-primary" type="submit" id="update" name="editDelivery" value="Update">
                        </div>
                </div>
                
                
              </div>
            </div>
			</div>
			</div><!--Mother Details Close-->
            
			</form>
			<!-- / Content -->
<?php include ('require/footer.php'); ?>
