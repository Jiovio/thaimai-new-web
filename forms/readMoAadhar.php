<?php include ('require/topHeader.php'); ?>
<?php
include "../config/db_connect.php";
if (! empty($_POST["keyword"])) {
    $sql = $conn->prepare("SELECT * FROM ecregister WHERE motheraadhaarid LIKE  ? ORDER BY motheraadhaarid LIMIT 0,3");
    $search = "{$_POST['keyword']}%";
    $sql->bind_param("s", $search);
    $sql->execute();
    $result = $sql->get_result();
    if (! empty($result)) {
        ?>
<ul id="picme-list">
<?php
        foreach ($result as $country) {
            ?>
   <li onClick="selectMoAadhar('<?php echo $country["motheraadhaarid"]; ?>');">
      <?php echo $country["motheraadhaarid"]; ?>
    </li>
<?php
        }// end for
    ?>
</ul>
    <?php
    }// end if not empty
}
?>