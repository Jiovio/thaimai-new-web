<?php
$host = "localhost:3307";
$dbuser = "root";
$dbpwd = "";
$dbname = "thaimaiyudan";

$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}
$siteurl = "https://thaimai.cloudonweb.in/";

?>