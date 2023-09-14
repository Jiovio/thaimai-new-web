<?php
include "../../config/db_connect.php";
$ecfr = "";
$ecfr = $_POST["ecfr"];
$ecfrno = "";
$ecfrno = $_POST["ecfrno"];
$ecfr_key = "";
$ecfr_key = $ecfr.$ecfrno;
$ecfr_chk = "";
$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE ecfrno = '$ecfr_key'");
$ecfr_fet = mysqli_fetch_array($ecfr_chk);

if (!empty($ecfr_fet)) {
    echo 1;
} 
else
{
$motadrid = $_POST["motheraadhaarid"];
$ecfr_chk = "";
$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE motheraadhaarid = '$motadrid'");
$ecfr_fet = mysqli_fetch_array($ecfr_chk);

if (!empty($ecfr_fet)) {
    echo 3;
} 
else
{
$husadrid = $_POST["husbandaadhaarid"];
$ecfr_chk = "";
$ecfr_chk = mysqli_query($conn, "SELECT * FROM ecregister WHERE husbandaadhaarid = '$husadrid'");
$ecfr_fet = mysqli_fetch_array($ecfr_chk);
if (!empty($ecfr_fet)) {
    echo 4;
} 
else
{
	echo 2;
}
	}
	}

