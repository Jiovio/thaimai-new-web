<?php
include "../../config/db_connect.php";
if (isset($_POST['type']) && !empty($_POST['type'])) {
    if ($_POST['type'] == 'hsc') {
        $hscId = $_POST["hscId"];
		$BlockId = $_POST["BlockId"];
		$PhcId = $_POST["PhcId"];
        $result = mysqli_query($conn, "SELECT DISTINCT PanchayatId, PanchayatName, PhcId FROM hscmaster WHERE 
		BlockId = '$BlockId' AND
		PhcId = '$PhcId' AND
		HscId = '$hscId' ORDER BY PanchayatId;");
        $resultKey = "PanchayatId";
        $resultVal = "PanchayatName";
        ?>
            <option value="">All Panchayat</option>
    <?php } else {
         $panchayatId = $_POST["panchayatId"];
		$BlockId = $_POST["BlockId"];
		$PhcId = $_POST["PhcId"];
		$HscId = $_POST["HscId"];
        $result = mysqli_query($conn, "SELECT DISTINCT VillageId, VillageName, PhcId FROM hscmaster 
		WHERE 
		BlockId = '$BlockId' AND
		PhcId = '$PhcId' AND
		HscId = '$HscId' AND
		panchayatId = '$panchayatId' ORDER BY VillageId;");
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