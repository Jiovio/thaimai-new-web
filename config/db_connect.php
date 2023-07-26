<?php
$host = "localhost";
$dbuser = "root";
$dbpwd = "";
$dbname = "thaimai_cloud";
$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}

$siteurl = "http://localhost/thaimai-new-web-main";

?>