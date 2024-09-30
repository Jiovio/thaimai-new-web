<?php
$host = "localhost";
$dbuser = "savemom_dhule";
$dbpwd = "RB9YRPb.]3iS";
$dbname = "savemom_dhule";

$conn = mysqli_connect($host, $dbuser, $dbpwd, $dbname) or die("Savemom Connection failed: " . mysqli_connect_error());
if ($conn->connect_error) { 
    echo "Savemom Connection failed"; 
}
$siteurl = "http://dhule.savemom.in";

?>