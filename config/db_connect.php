<?php
$host = "localhost";   
$dbuser = "root";
$dbpwd = "Savemom@123";
$dbname = "demo_upload";
$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}

$siteurl = "http://demo.savemom.in";   

?>