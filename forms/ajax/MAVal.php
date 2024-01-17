
<?php
include "../../config/db_connect.php";
$MotherAge = $_POST["MotherAge"];

$antenatalSql = mysqli_query($conn, "SELECT * FROM anregistration WHERE motheraadhaarid = '$aadhar' order by id");
$antenatalData = mysqli_fetch_array($antenatalSql);

if (!empty($antenatalData) && isset($antenatalData)) {
    echo 1;
} 
else {
   $ECSql = mysqli_query($conn, "SELECT * FROM ecregister WHERE motheraadhaarid = '$aadhar' order by id");
$ECData = mysqli_fetch_array($ECSql);

if (!empty($ECData) && isset($ECData)) {
    echo 3;
} else {
   echo 4;
}
} 
