<?php
$host = "localhost";
$dbuser = "root";
$dbpwd = "";
$dbname = "thaim";

$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}
//$siteurl = "http://admin.thaimaiyudan.org";
$siteurl = "https://thaimai.cloudonweb.in";
?>