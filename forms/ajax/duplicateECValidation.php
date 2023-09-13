<?php
include "../../config/db_connect.php";
$motadrid = $_POST["motadrid"];



$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE motheraadhaarid = '$motadrid'";
$ecfr_fet = mysqli_fetch_array($ecfr_chk);

if (!empty($ecfr_fet)) {
    echo 1;
} 