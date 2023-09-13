<?php
include "../../config/db_connect.php";
$ecfr = $_POST["ecfr"];



$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE ecfrno = '$ecfr'";
$ecfr_fet = mysqli_fetch_array($ecfr_chk);

if (!empty($ecfr_fet)) {
    echo 1;
} 