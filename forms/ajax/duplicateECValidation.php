<?php
include "../../config/db_connect.php";
$ecfrno = $_POST["ecfrno"];
$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE ecfrno = '$ecfrno'");
$ecfr_fet = mysqli_fetch_array($ecfr_chk);

echo "Hi test!";

if (!empty($ecfr_fet)) {
    echo 1;
} 
else
{
	echo 2;
	}

/*$motadrid = $_POST["motheraadhaarid"];
$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE motheraadhaarid = '$motadrid'");
$ecfr_fet = mysqli_fetch_array($ecfr_chk);

if (!empty($ecfr_fet)) {
    echo 1;
} 
else
{
	echo 2;
	}*/