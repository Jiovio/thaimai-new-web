<?php include ('require/topHeader.php'); ?>
<?php
include "../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$result = mysqli_query($conn,"SELECT gravida FROM anregistration WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1;");

$result1 ="";
while($res = mysqli_fetch_array($result)){  
    $result1 = $res['gravida'];
}
echo $result1;
?>
