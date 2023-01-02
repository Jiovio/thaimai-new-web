<div class="table-responsive text-nowrap">
		<div class="container">
				<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
            <th>S.No</th>            
            <th>PICME Number</th>
			<th>Mother Aadhaar Name</th>
            <th>Mother Aadhaar No.</th>
			<th>Mother Mobile No.</th>
            <th>Husband Mobile No.</th>
			<th>View</th>
                      </tr>
                    </thead>
<?php 
$txtchgname = $_POST["txtchgname"];
$ExeQuery = mysqli_query($conn,"SELECT id,picmeNo,motheraadhaarname,motheraadhaarid,mothermobno,husmobno FROM ecregister WHERE picmeNo='".$txtchgname."' OR motheraadhaarname LIKE '%".$txtchgname."%' OR motheraadhaarid='".$txtchgname."' OR mothermobno='".$txtchgname."' OR husmobno='".$txtchgname."';");
                   if($ExeQuery) {
                      $cnt=1;
                      while($row = mysqli_fetch_array($ExeQuery)) {
                    ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['picmeNo']; ?></td>
									                  <td><?php echo $row['motheraadhaarname']; ?></td>
                                    <td><?php echo $row['motheraadhaarid']; ?></td>
                                    <td><?php echo $row['mothermobno']; ?></td>
									                  <td><?php echo $row['husmobno']; ?></td>
									<td><a href="../forms/ViewdbListView.php?view=<?php echo $row['id']; ?>"><i class="bx bx-show me-1"></i>View</a></td>
                                </tr>
                    <?php 
                        $cnt++;
                      } 
                    } ?>
                    </table>
      </div>
</div>
<!--/ Hoverable Table rows -->
