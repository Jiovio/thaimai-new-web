
<?php
require_once "../config/db_connect.php";
$motheraadhaarid = $_POST["motheraadhaarid"];
    $result = mysqli_query($conn,"SELECT motheraadhaarid,motheraadhaarname,husbandaadhaarname FROM ecregister WHERE motheraadhaarid='$motheraadhaarid'");
?>
                            <select name="motheraadhaarname" id="motheraadhaarname" class="form-select" disabled>

<?php
while($row = mysqli_fetch_array($result)) {
?>

<option value="<?php echo $row["motheraadhaarname"];?>"><?php echo $row["motheraadhaarname"];?></option>
                            </select>
<?php
}

?> 