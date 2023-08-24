<?php include ('require/topHeader.php'); ?>
<?php
include "../config/db_connect.php";
$PhcId = $_POST["PhcId"];
$result = mysqli_query($conn,"SELECT DISTINCT HscId, HscName, PhcId FROM hscmaster WHERE PhcId = '$PhcId' ORDER BY PhcId;");
?>
<option value="">All HSCs</option>
<?php
while($row = mysqli_fetch_array($result)) {
    
?>
<option value="<?php echo $row["HscId"];?>"><?php echo $row["HscName"];?></option>
<?php
}
?>