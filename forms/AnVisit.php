<?php include ('require/topHeader.php'); ?>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
    <?php include ('require/header.php'); // Menu & Top Search ?>
    <!-- Content wrapper -->
      <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Antenatal visit
              <a href="AntenatalVisit.php?" ><span button type="button" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button>
            </h4>
            
            <div class="row">
                    <div class="col-md-12">
                <div class="card mb-4">
                <hr class="my-0" />
                <div class="card-body">
        
                <form method="POST" action="AnVisitAddBtn.php" id="AVaddForm">
                  <div class="row">
                  <div class="col-4 mb-3">
        <label class="form-label" for="basic-icon-default-fullname">RCHID (PICME) NUMBER <span class="mand">* </span></label>
        
        <div class="frmSearch">
        <div class="input-group input-group-merge">
        <span id="basic-icon-default-mobile" class="input-group-text">
        <i class="bx bx-id-card"></i></span>
        
		<input type="text" required id="AVBpicmeno" name="picmeno" oninput = "onlyNumbers(this.value)" onclick="return checkAVBPicme(this.value)" placeholder="RCHID (PICME) Number" class="form-control" />
                
		</div>
        <div id="suggesstion-box"></div>
		<div class="mt-2">
                        <input class="btn btn-primary" id="AVPicme" type="submit" name="AVPicme" value="Add Details">
                        </div>
        </div>
        </div>
                    </div>
                    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } else { echo $type . " display-none"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>
                    </div>
                  </div>
                          </div>
                      </div>
                      </form>
                    </div>
                    <!-- /Account -->
            <!-- / Content -->
<?php include ('require/footer.php'); ?>