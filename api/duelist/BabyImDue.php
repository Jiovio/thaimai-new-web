<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");


include_once '../config/database.php';





$database = new Database();
$db = $database->getConnection();

// initialize object
$data = json_decode(file_get_contents("php://input"));

$checkvaliduser = $db->prepare("SELECT DISTINCT(im.picmeNo),ec.motheraadhaarname,im.FutureDoseDate,im.FutureDoseNo,ec.mothermobno,ec.PhcId,u.name FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo JOIN users u on u.id=im.createdUserId WHERE FutureDoseDate>=DATE_FORMAT(NOW() ,'%Y-%m-01') AND ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."'  AND im.status=1 ORDER BY ec.motheraadhaarname ASC");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
     
        $PvArray[] = array("picmeNo" =>$row['picmeno'],
        "motheraadhaarname" =>$row['motheraadhaarname'],
        "FutureDoseDate" =>$row['FutureDoseDate'],
        "FutureDoseNo" =>$row['FutureDoseNo'],
        "mothermobno" =>$row['mothermobno'],
        // "PhcId" =>$row['PhcId'],
        "name" =>$row['name']
        
        );
         
            }   
            
            http_response_code(200);
        
            echo json_encode(
                    array("success" => "true", "error"=> "false",  "BabyImDue" => $PvArray , "message" => "Postnatal Visit Registered List")
            );
          
        } else {
            // set response code - 404 Not found
            http_response_code(404);
        
            echo json_encode(
                    array("success" => "false", "error"=>"true", "message" => "Baby Immunization Due Data Not Found")
            );
        }
        ?>
        