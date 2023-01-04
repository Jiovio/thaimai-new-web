<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu
	  if(($usertype == 0) || ($usertype == 1)) {
	  include ('require/filter.php'); // Top Filter 
}else if(($usertype == 2)) {
    include ('require/Bfilter.php');
}else if(($usertype == 3) || ($usertype == 4)) {
    include ('require/Pfilter.php');
} else {
    include ('require/Hfilter.php'); // Top Filter
}
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
               
                <!-- Hoverable Table rows -->
                 <div class="card">
                   <h5 class="card-header"><span class="text-muted fw-light">Postnatal Visit /</span> Postnatal Visit List
                   <a href="AddPostnatalvisit.php" id="add" type="button" class="btn btn-primary" style="float:right;">
                       <span class="bx bx-plus"></span>&nbsp; Add Postnatal Visit
                   </a>
                   </h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th> 
               <th>Mother Name</th>
               <th>PICME Number</th>
               <th>IFA Tablet</th>
               <th>Mother Danger Sign</th>
               <th>Blood Sugar</th>
               <th>View</th>
                         </tr>
                       </thead>
   
    <?php  
    if(($usertype == 0) || ($usertype == 1)) {
            if(isset($_POST['filter'])) {
	            $bloName = $_POST['BlockId']; 
	            $phcName = $_POST['PhcId'];
                      
                        if($bloName == "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,ec.motheraadhaarname FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE p.status=1 ORDER BY ec.motheraadhaarname ASC");
                        } else if($bloName != "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,ec.motheraadhaarname FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE ec.BlockId='".$bloName."' AND p.status=1 ORDER BY ec.motheraadhaarname ASC");
                        } else if($bloName != "" && $phcName != "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,ec.motheraadhaarname FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND p.status=1 ORDER BY ec.motheraadhaarname ASC");
                        }
                      } else if(isset($_POST['reset'])) {
                        $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,ec.motheraadhaarname FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE p.status=1 ORDER BY ec.motheraadhaarname ASC");
                      } else {
                        $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,ec.motheraadhaarname FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE p.status=1 ORDER BY ec.motheraadhaarname ASC");
                      }
    } else if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
    $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,ec.motheraadhaarname FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE ec.BlockId='".$BlockId."' AND p.status=1 ORDER BY ec.motheraadhaarname ASC");
            } 
                  if($ExeQuery) {
                         $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                   <tr>
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['motheraadhaarname']; ?></td>
                                       <td><?php echo $row['picmeNo']; ?></td>
                                       <td><?php $ts = $row['ifaTabletStatus'];
                                       if($ts==1){ echo "Yes"; } elseif($ts==2){ echo "No"; }
                                       ?></td>
                               <td><?php $ut = $row['motherDangerSign'];
                                if($ut==1){ echo "PPH"; } elseif($ut==2){ echo "Fever"; } elseif($ut==3){ echo "Sepsis"; }
                                elseif($ut==4){ echo "Severe abdominal pain"; } elseif($ut==5){ echo "Severe headache/blurred vision"; }
                                elseif($ut==6){ echo "Difficulty breathing"; } elseif($ut==7){ echo "Fever/chills"; } 
                                elseif($ut==8){ echo "None"; } elseif($ut==9){ echo "Any other specify"; } ?></td>
    
                               <td><?php echo $row['bloodSugar']; ?></td>
                              <td ><a id="view" name="view" href="../forms/ViewEditPostnatal.php?view=<?php echo $row['id']; ?>" ><i  class="bx bx-show me-1"></i>View</a></td>

								</tr>
                       <?php 
                           $cnt++;
                         } 
                       } ?>
                     </table></div>
                   </div>
                 </div>
        <!--/ Hoverable Table rows -->
<?php include ('require/dtFooter.php'); ?>
