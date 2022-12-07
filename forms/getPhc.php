<?php
include "../config/db_connect.php";
$BlockId = $_POST["BlockId"];
$result = mysqli_query($conn,"SELECT DISTINCT PhcId, PhcName, BlockId FROM hscmaster WHERE BlockId = '$BlockId' ORDER BY PhcName;");
?>
<option value="">All PHCs</option>
<?php
while($row = mysqli_fetch_array($result)) {
    
?>
<option value="<?php echo $row["PhcId"];?>"><?php echo $row["PhcName"];?></option>
<?php
}
?>