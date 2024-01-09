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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>SMS</h5>
             
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
                          <label class="form-label" for="basic-icon-default-phone">SMS Type <span class="mand">* </span><span id="smstype"></span></span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="smstype" id="smstype" class="form-select" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $sms_query = "SELECT enumid,enumvalue FROM enumdata WHERE type=53";
                            $sms_exequery = mysqli_query($conn, $sms_query);
                            while($sms_listvalue = mysqli_fetch_assoc($sms_exequery)) { ?>
                          <option value="<?php echo $sms_listvalue['enumid']; ?>"><?php echo $sms_listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
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