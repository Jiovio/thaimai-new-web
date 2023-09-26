<?php
include "../../config/db_connect.php";
if (isset($_POST['type']) && !empty($_POST['type'])) {
    if ($_POST['type'] == 'hsc') {
        $hscId = $_POST["hscId"];
        $result = mysqli_query($conn, "SELECT DISTINCT PanchayatId, PanchayatName, PhcId FROM hscmaster WHERE HscId = '$hscId' ORDER BY PanchayatId;");
        $resultKey = "PanchayatId";
        $resultVal = "PanchayatName";
        ?>
            <option value="">All Panchayat</option>
    <?php } else {
         $panchayatId = $_POST["panchayatId"];
        $result = mysqli_query($conn, "SELECT DISTINCT VillageId, VillageName, PhcId FROM hscmaster WHERE panchayatId = '$panchayatId' ORDER BY VillageId;");
         $resultKey = "VillageId";
        $resultVal = "VillageName";
        ?>
            <option value="">All Village</option>
    <?php } ?>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
                <option value="<?php echo $row[$resultKey]; ?>"><?php echo $row[$resultVal]; ?></option>
        <?php
    }
}
?>