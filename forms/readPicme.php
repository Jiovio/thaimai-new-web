<?php include ('require/topHeader.php'); ?>
<?php
include "../config/db_connect.php";
if (! empty($_POST["keyword"])) {
    $sql = $conn->prepare("SELECT * FROM ecregister WHERE picmeNo LIKE  ? ORDER BY picmeNo LIMIT 0,3");
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
   <li onClick="selectPicme('<?php echo $country["picmeNo"]; ?>');">
      <?php echo $country["picmeNo"]; ?>
    </li>
<?php
        }// end for
    ?>
</ul>
    <?php
    }// end if not empty
}
?>