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
}
?>
<!-- Content wrapper -->
      <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Hoverable Table rows -->
                 <div class="card">
                   <h5 class="card-header">High Risk Mothers List</h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>            
               <th>PICME No.</th>
               <th>Mother Name</th>
               <th>High Risk Factor</th>
                         </tr>
                       </thead>
<?php  
    if(($usertype == 0) || ($usertype == 1)) {
            if(isset($_POST['filter'])) {
                        $bloName = $_POST['BlockId']; 
                        $phcName = $_POST['PhcId'];
                      
                        if($bloName == "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,ed.enumvalue from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno join enumdata ed on ed.enumid=av.symptomsHighRisk WHERE av.symptomsHighRisk!=48 AND ed.type=51");
                        } else if($bloName != "" && $phcName == "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,ed.enumvalue from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno join enumdata ed on ed.enumid=av.symptomsHighRisk WHERE av.symptomsHighRisk!=48 AND ed.type=51 AND ec.BlockId='".$bloName."' AND av.status=1");
                        } else if($bloName != "" && $phcName != "" ){
                          $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,ed.enumvalue from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno join enumdata ed on ed.enumid=av.symptomsHighRisk WHERE av.symptomsHighRisk!=48 AND ed.type=51 AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND av.status=1");
                        }
                      } else if(isset($_POST['reset'])) {
                        $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,ed.enumvalue from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno join enumdata ed on ed.enumid=av.symptomsHighRisk WHERE av.symptomsHighRisk!=48 AND ed.type=51");
                      } else {
                        $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,ed.enumvalue from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno join enumdata ed on ed.enumid=av.symptomsHighRisk WHERE av.symptomsHighRisk!=48 AND ed.type=51");
                      }
        } else if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
    $ExeQuery = mysqli_query($conn,"SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,ed.enumvalue from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno join enumdata ed on ed.enumid=av.symptomsHighRisk WHERE av.symptomsHighRisk!=48 AND ed.type=51 AND ec.BlockId='".$BlockId."' AND av.status=1");
            } 
                       if($ExeQuery) {
                         $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
                       ?>
                                   <tr>
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['picmeno']; ?></td>
                                       <td><?php echo $row['motheraadhaarname']; ?></td>
                                       <td><?php echo $row['enumvalue']; ?></td>
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