<?php
$host = "localhost";
$dbuser = "adminthaimai_user";
$dbpwd = "ELxKb+Tp2GHn";
$dbname = "adminthaimai_admin";

$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Thaimayudan Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Thaimayudan Connection failed"; 
}
$siteurl = "http://admin.thaimaiyudan.org";

?>