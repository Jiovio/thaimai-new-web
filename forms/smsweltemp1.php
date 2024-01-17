<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
 
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SMS /</span> Welcome SMS</h5>
             
			</h4>
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                      
  <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>

			
			
 <!----                          <form action="AddAnVisit3.php" method="post" onsubmit="return validateGctChange()"> !--->
			<form method="post" action='phpsendsmstemp.php'>
			
			<div class="row">
			<div class="col-6 mb-3">
                <label class="form-label" for="basic-icon-default-fullname">RCHID (PICME) NUMBER <span class="mand">* </span></label>
                <div class="frmSearch">
				<select name="picmeNo" id="picmeNo" class="form-select" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text" required>
                          <option value="">Choose...</option>
                           <?php  
                           
                            $query = "SELECT DISTINCT(picmeNo) FROM ecregister ORDER BY picmeNo";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['picmeNo']; ?>"><?php echo $listvalue['picmeNo']; ?></option>
                           <?php } ?>
                             </select>
                </div>
                </div>
		<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S MOBILE NUMBER <span class="mand">* </span><span id="errhmob"></span></label>
                          <div class="input-group input-group-merge">
                            
                            <input
                              type="tel"
                              name="phoneno"
                              id="phoneno"
                              class="form-control phone-mask"
                              placeholder="MOTHER'S MOBILE NUMBER"
                              aria-label="MOTHER'S MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
							  pattern="[0-9]{3}[0-9]{3}[0-9]{4}" maxlength="10"
							  readonly
                              required
                            />
                          </div>
                        </div>
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S NAME <span class="mand">* </span><span id="errMfullname"></span></label>
                          <div class="input-group input-group-merge">
                            
                            <input
                              type="text"
                              name="patient"
                              id="patient"
                              class="form-control phone-mask"
                              placeholder="MOTHER'S NAME"
                              aria-label="MOTHER'S NAME"
                              aria-describedby="basic-icon-default-patient" 
                              readonly							  
							  required
                            />
                          </div>
						  </div>
						  
						</div>
					
            <input class="btn btn-primary" type="submit" id="submit" name="submit" value="Send Message" >
			
			</form>
			
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>