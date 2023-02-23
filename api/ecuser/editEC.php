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
include_once '../objects/patient.php';

$database = new Database();
$db = $database->getConnection();
$form = new Patient($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty

if (!empty($data->ecfrno)) {
    $form->usertype = $data->usertype;
    $form->ecfrno = $data->ecfrno;
    $form->dateecreg = $data->dateecreg;
    $form->motheraadhaarid = $data->motheraadhaarid;
    $form->motheraadhaarname = $data->motheraadhaarname;
    $form->husbandaadhaarid = $data->husbandaadhaarid;
    $form->husbandaadhaarname = $data->husbandaadhaarname;
    $form->motherfullname = $data->motherfullname;
    $form->motherdob = $data->motherdob;
    $form->motherageecreg = $data->motherageecreg;
    $form->motheragemarriage = $data->motheragemarriage;
    $form->mothermobno = $data->mothermobno;
    $form->mobileofperson = $data->mobileofperson;
    $form->motheredustatus = $data->motheredustatus;
    $form->husfullname = $data->husfullname;
    $form->husdob = $data->husdob;
    $form->husageecreg = $data->husageecreg;
    $form->husagemarriage = $data->husagemarriage;
    $form->husmobno = $data->husmobno;
    $form->husedustatus = $data->husedustatus;
    $form->religion = $data->religion;
    $form->caste = $data->caste;
    $form->block = $data->block;
    $form->phc = $data->phc;
    $form->hsc = $data->hsc;
    $form->panchayat = $data->panchayat;
    $form->village = $data->village;
    $form->address = $data->address;
    $form->pincode = $data->pincode;
    $form->povertystatus = $data->povertystatus;
    $form->migrantstatus = $data->migrantstatus;
    $form->rationcardtype = $data->rationcardtype;
    $form->rationcardnum = $data->rationcardnum;
          
    $mvaliduser1 = $db->prepare("SELECT * FROM ecregister WHERE ecfrno='".$data->ecfrno."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum >0) {
        $inserid = $form->editecregister();
        
        // set response code - 201 created
        http_response_code(200);
        echo json_encode(array("success" => "true", "error" => "false", "message" => "User Updated Successfully."));
    } else {
       
        http_response_code(400);
        echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the fields.User not Updated."));
    }
}
// tell the user data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
        echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the fields.User not Updated."));
       
}

?>