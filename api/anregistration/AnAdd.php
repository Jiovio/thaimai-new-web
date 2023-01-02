<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/anreg.php';

$database = new Database();
$db = $database->getConnection();
$form = new AnReg($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty

if (!empty($data->motheraadhaarid)) {
    $mAadhaaruser1 = $db->prepare("SELECT * FROM ecregister WHERE motheraadhaarid='".$data->motheraadhaarid."' ORDER BY id ASC");
    $mAadhaaruser1->execute(array());
    $mvalidAadhaaruser = $mAadhaaruser1->rowCount();
    if($mvalidAadhaaruser >0) {
        while ( $row = $mAadhaaruser1->fetch(PDO::FETCH_ASSOC)) 
     {  
      
       $data->motheraadhaarid = $row["motheraadhaarid"];
     
    $form->usertype = $data->usertype;
    $form->motheraadhaarid = $data->motheraadhaarid;
    $form->picmeno = $data->picmeno;
    $form->picmeregdate = $data->picmeregdate;
    $form->residentType = $data->residentType;
    $form->pregnancyTestResult = $data->pregnancyTestResult;
    $form->methodofConception = $data->methodofConception;
    $form->gravida = $data->gravida;
    $form->para = $data->para;
    $form->livingChildren = $data->livingChildren;
    $form->abortion = $data->abortion;
    $form->childDeath = $data->childDeath;
    $form->hrPregnancy = $data->hrPregnancy;
    $form->obstetricCode = $data->obstetricCode;
    $form->motherHeight = $data->motherHeight;
    $form->motherWeight = $data->motherWeight;
    $form->bpSys = $data->bpSys;
    $form->bpDia = $data->bpDia;
    $form->anRegDate = $data->anRegDate;
    $form->mrmbsEligible = $data->mrmbsEligible;
    $form->motherage = $data->motherage;
    $form->husbandage = $data->husbandage;
    $mvaliduser1 = $db->prepare("SELECT * FROM anregistration WHERE motheraadhaarid='".$data->motheraadhaarid."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum == 0) {
        $inserid = $form->createanregistration();
        
        $query = "UPDATE ecregister SET picmeNo='".$data->picmeno."',status='2' WHERE motheraadhaarid='".$data->motheraadhaarid."' ORDER BY motheraadhaarid ASC";
        $stmt = $db->prepare($query);
        $stmt->execute(array());
        
        $teenageqry = "UPDATE ecregister SET status=5 WHERE motheraadhaarid='$data->motheraadhaarid' AND TIMESTAMPDIFF(YEAR, motherdob,CURDATE())<18";
        $teenagestmt = $db->prepare($query);
        $teenagestmt->execute(array());
        // set response code - 201 created
        http_response_code(200);

        echo json_encode(array("success" => "true", "error" => "false", "message" => "Antenatal Registration Created Successfully."));
    } else {
       
        http_response_code(400);

        echo json_encode(array("success" => "false", "error" => "true","message" => "Mother Aadhaar ID Already Entered."));        
    }
}
} else {
    http_response_code(400);

    echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the Mother Aadhaar ID. Antenatal not Created."));  
}
}
// tell the user data is incomplete
else {
    // set response code - 400 bad request

    http_response_code(400);

    echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the fields. Antenatal not Created."));
        
}

?>