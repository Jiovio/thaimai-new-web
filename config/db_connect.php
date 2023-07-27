<?php
$host = "localhost";
$dbuser = "thaimaicloudonwe_dev-user";
$dbpwd = "=t1VE89[*7w_";
$dbname = "thaimaicloudonwe_dev";
$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}

$siteurl = "http://demo.savemom.in";

?>