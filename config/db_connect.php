<?php
$host = "localhost";   
$dbuser = "root";
$dbpwd = "Savemom@123";
$dbname = "demo_savemom";
$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}
  
$siteurl = "https://demo.savemom.in";   

?>