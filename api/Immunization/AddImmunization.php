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
include_once '../objects/immunization.php';

$database = new Database();
$db = $database->getConnection();
$form = new immunization($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if (!empty($data->picmeNo)) {

    $ddate = $db->prepare("SELECT DISTINCT(dd.deliverydate) FROM immunization im JOIN deliverydetails dd ON dd.picmeno=im.picmeNo WHERE im.picmeNo='$data->picmeNo'");
    $ddate->execute();
    $ddate1 = $ddate->rowCount();
   
        
    while ( $row = $ddate->fetch(PDO::FETCH_ASSOC))
     
    //$data->deliverydate = $row["deliverydate"]; 
      
    // set form property values
    $form->usertype = $data->usertype;
    $form->picmeNo = $data->picmeNo;
    $form->doseNo = $data->doseNo;
    // if($data->doseNo == '1') {
    //       $form->FutureDoseDate = date('Y-m-d', strtotime($data->deliverydate. '+ 74 days' ));
    //     }if($data->doseNo == '2') {
         
    //       $form->FutureDoseDate = date('Y-m-d', strtotime($data->deliverydate. '+ 104 days' ));
    //     }if($data->doseNo == '3') {
    //       $form->FutureDoseDate = date('Y-m-d', strtotime($data->deliverydata. '+ 269 days' ));
    //     }if($data->doseNo == '4') {
    //       $form->FutureDoseDate = date('Y-m-d', strtotime($data->deliverydate. '+ 479 days' ));
    //     }
      if($data->doseNo == 1) {
        $form->FutureDoseNo = $data->doseNo + 1;
        } else if($data->doseNo == 2) {
        $form->FutureDoseNo = $data->doseNo + 1;
        } else if($data->doseNo == 3) {
        $form->FutureDoseNo = $data->doseNo + 1;
        } else if($data->doseNo == 4) {
        $form->FutureDoseNo = $data->doseNo + 1;
        }
    $form->doseName = $data->doseName;
    $form->doseDueDate = $data->doseDueDate;
    $form->doseProvidedDate = $data->doseProvidedDate;
    $form->breastFeeding = $data->breastFeeding;
    $form->compliFoodStart = $data->compliFoodStart;
//     $form->motherCovidVac1Done = $data->motherCovidVac1Done;
//     $form->motherCovidVac1Type = $data->motherCovidVac1Type;
//     $form->motherCovidVac1Date = $data->motherCovidVac1Date;
//     if($data->motherCovidVac1Type == '1') {
//     $form->motherFuDoseDate = date('Y-m-d', strtotime($data->motherCovidVac1Date. '+ 30 days' ));
//   } else if($data->motherCovidVac1Type == '2'){
//     $form->motherFuDoseDate = date('Y-m-d', strtotime($data->motherCovidVac1Date. '+ 90 days' ));  
//   }

//   $form->motherCovidVac2Done = $data->motherCovidVac2Done;
//   $form->motherCovidVac2Type = $data->motherCovidVac2Type; 
//   $form->motherCovidVac2Date = $data->motherCovidVac2Date;
  
  
//   if($data->motherCovidVac1Type == '1') {
//     $form->motherFuDoseDate = date('Y-m-d', strtotime($data->motherCovidVac2Date. '+ 180 days' ));
//   } else if($data->motherCovidVac1Type == '2'){
//     $form->motherFuDoseDate = date('Y-m-d', strtotime($data->motherCovidVac2Date. '+ 180 days' ));  
//   }

//   $form->motherCovidVacBoosterDone = $data->motherCovidVacBoosterDone; 
//   $form->motherCovidVacBoosterType = $data->motherCovidVacBoosterType;
//   $form->motherCovidVacBoosterDate = $data->motherCovidVacBoosterDate;
  
//   if($data->motherCovidVac1Type == '1' || $data->motherCovidVac1Type == '2' ) {
//     $form->motherFuDoseName = $data->motherCovidVac1Type;
//   }else if($data->motherCovidVac2Type == '1' || $data->motherCovidVac2Type == '2'){
//     $form->motherFuDoseName = $data->motherCovidVac2Type;
    
//   } else if($data->motherCovidVacBoosterType == '1' || $data->motherCovidVacBoosterType == '2'){
//     $form->motherFuDoseName = $data->motherCovidVacBoosterType;
    
//   }
    
    $mvaliduser1 = $db->prepare("SELECT * FROM immunization WHERE picmeNo='".$data->picmeNo."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum == 0) {
        $inserid = $form->createimmunization();
        // set response code - 201 created
        http_response_code(200);
        // tell the user
        echo json_encode(array("success" => "true", "Immunization_id" => $inserid,"message" => "Immunization created."));
    } else {
       
        http_response_code(400);
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "PICME No already Entered."));
        
    }

    //  }

  //  }
}
// tell the user data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create Immunization. "));
}
?>