<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
     <div class="layout-container">
<?php 
  include ('require/header.php'); // Menu
  include ('require/Hfilter.php'); // Top Filter
  $AvCntmq = mysqli_query($conn,"SELECT count(id) AS AvCnt FROM antenatalvisit WHERE status=1  AND createdBy='".$userid."'");
  $Avcnt = mysqli_fetch_array($AvCntmq);
  $AvTot = $Avcnt["AvCnt"];

  $HrCntmq = mysqli_query($conn,"SELECT COUNT(av.symptomsHighRisk) AS HrCnt FROM antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno WHERE av.symptomsHighRisk!=48 AND av.status=1 AND av.createdBy='".$userid."'");
  $HrCnt = mysqli_fetch_array($HrCntmq);
  $HrTot = $HrCnt["HrCnt"];

  $DdCntmq = mysqli_query($conn,"SELECT COUNT(id) AS DdCnt FROM deliverydetails WHERE status=1 AND createdBy='".$userid."'");
  $DdCnt = mysqli_fetch_array($DdCntmq);
  $DdTot = $DdCnt["DdCnt"];

  $ImCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ImCnt FROM immunization WHERE status=1 AND createdUserId='".$userid."'");
  $ImCnt = mysqli_fetch_array($ImCntmq);
  $ImTot = $ImCnt["ImCnt"];

  $PvCntmq = mysqli_query($conn,"SELECT count(id) AS PvCnt FROM postnatalvisit WHERE status=1 AND createdBy='".$userid."'");
  $PvCnt = mysqli_fetch_array($PvCntmq);
  $PvTot = $PvCnt["PvCnt"];

  $PsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PsCnt FROM ecregister WHERE status NOT IN(0,1) AND createdBy='".$userid."'");
  $PsCnt = mysqli_fetch_array($PsCntmq);
  $PsTot = $PsCnt["PsCnt"];
?>
		<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
                  <div class="row">
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
                          <h3 class="card-title mb-2"><?php if($AvTot) { echo $AvTot; } else { echo "0"; } ?></h3>
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
                                src="../assets/img/icons/unicons/cc-warning.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">High Risk Mothers</span>
                          <h3 class="card-title mb-2"><?php if($HrTot) { echo $HrTot; } else { echo "0"; }  ?></h3>
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
                         <h3 class="card-title mb-2"><?php  if($DdTot) { echo $DdTot; } else { echo "0"; } ?></h3>
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
                              <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Immunization Details</span>
                         <h3 class="card-title mb-2"><?php if($ImTot) { echo $ImTot; } else { echo "0"; } ?></h3>
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
                    <h3 class="card-title mb-2"><?php if($PvTot) { echo $PvTot; } else { echo "0"; } ?></h3>
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
                          <span class="fw-semibold d-Block mb-1">Pregnancy Status</span>
                          <h3 class="card-title mb-2"><?php if($PsTot) { echo $PsTot; } else { echo "0"; } ?></h3>
                        </div>
                      </div>
                     </a>
            </div>
        </div>
      </div>
    </div>
<?php include ('require/dtFooter.php'); ?>