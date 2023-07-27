<?php
$host = "localhost";
$dbuser = "root";
$dbpwd = "Savemom@123";
$dbname = "demo_savemom";
$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Savemom Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Savemom Connection failed"; 
}

$siteurl = "http://demo.savemom.in";

?>