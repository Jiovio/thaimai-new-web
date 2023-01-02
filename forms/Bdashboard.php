<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
<?php include ('require/header.php'); // Menu
	    include ('require/Bfilter.php'); // Top Filter
      if(isset($_POST['filter'])) {
        $bloName = $_POST['BlockId'];
        $phcName = $_POST['PhcId'];
        $hscName = $_POST['HscId'];
      
        if($bloName != "" && $phcName == "" && $hscName == ""){
          include 'LoadBlock.php';
        } else if($bloName != "" && $phcName != "" && $hscName == ""){
          include 'LoadPhc.php';
        } else if($bloName != "" && $phcName != "" && $hscName != ""){
            include 'LoadHsc.php';
          }
        } else if(isset($_POST['reset'])) {
          include 'DefaultBlock.php';
        } else {
          include 'DefaultBlock.php';
        }
      $EcTot = $ErCnt['ErCnt']; $ArTot = $ArCnt['ArCnt']; $AvTot = $AvCnt['AvCnt']; $MhTot = $MhCnt['MhCnt'];
      $HrTot = $HrCnt['HrCnt']; $DdTot = $DdCnt['DdCnt']; $ImTot = $ImCnt['ImCnt']; $PvTot = $PvCnt['PvCnt'];
      $UsTot = $UsCnt['UsCnt']; $LmTot = $LmCnt['LmCnt']; $HsTot = $HsCnt['HsCnt']; $PhTot = $PhCnt['PhCnt'];
?>
		<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
                  <div class="row">
                  <div class="col-3 mb-4">
                    <a href="<?php echo $siteurl; ?>/forms/EligibleCouple.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Eligible Couples</span>
                          <h3 class="card-title mb-2"><?php echo $EcTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
                    <div class="col-3 mb-4">
                     <a href="<?php echo $siteurl; ?>/forms/Aregisterlist.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-warning.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Antenatal Registration</span>
                          <h3 class="card-title mb-2"><?php echo $ArTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
                    <div class="col-3 mb-4">
                     <a href="<?php echo $siteurl; ?>/forms/AntenatalVisit.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Antenatal Visit</span>
                          <h3 class="card-title mb-2"><?php echo $AvTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
                    <div class="col-3 mb-4">
                     <a href="<?php echo $siteurl; ?>/forms/MedicalHistory.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Medical History</span>
                          <h3 class="card-title mb-2"><?php echo $MhTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
				  <div class="col-3 mb-4">
				     <a href="<?php echo $siteurl; ?>/forms/highRiskMothers.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/cc-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">High Risk Mothers</span>
                          <h3 class="card-title mb-2"><?php echo $HrTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
                    <div class="col-3 mb-4">
                     <a href="<?php echo $siteurl; ?>/forms/DeliveryDetails.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/wallet.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Delivery Details</span>
                         <h3 class="card-title mb-2"><?php echo $DdTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>

					<div class="col-3 mb-4">
					 <a href="<?php echo $siteurl; ?>/forms/Immunization.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-warning.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Immunization Details</span>
                         <h3 class="card-title mb-2"><?php echo $ImTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
					<div class="col-3 mb-4">
					 <a href="<?php echo $siteurl; ?>/forms/PostnatalVisit.php">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Postnatal Visit</span>
                          <h3 class="card-title mb-2"><?php echo $PvTot; ?></h3>
                        </div>
                      </div>
                     </a>
                    </div>
                </div>
                </div>
              </div>
            </div>
 <?php include ('require/footer.php'); ?>