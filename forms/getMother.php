
<?php
require_once "../config/db_connect.php";
$motheraadhaarid = $_POST["motheraadhaarid"];
    $result = mysqli_query($conn,"SELECT motheraadhaarid,husbandaadhaarname FROM ecregister WHERE motheraadhaarid='$motheraadhaarid'");
?>
                            <select name="husbandaadhaarname" id="husbandaadhaarname" class="form-select" disabled>

<?php
while($row = mysqli_fetch_array($result)) {
?>

<option value="<?php echo $row["husbandaadhaarname"];?>"><?php echo $row["husbandaadhaarname"];?></option>
                            </select>
<?php
}

?> 