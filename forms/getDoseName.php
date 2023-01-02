<?php
require_once "../config/db_connect.php";
$doseNo = $_POST["doseNo"];
    $result = mysqli_query($conn,"SELECT * FROM enumdata WHERE doseNo='$doseNo'");
?>
<option value="">Choose...</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["enumid"];?>"><?php echo $row["enumvalue"];?></option>
<?php
}
?> 