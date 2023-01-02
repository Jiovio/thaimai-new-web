<?php

function generateRandomString($length = 5) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class Delivery {

    // database connection and table name
    private $conn;
    private $table_name = "deliverydetails";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createdeliverydetails() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `deliverydetails` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            // query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
            SET
            picmeno='" . $this->picmeno . "',deliverydate='" . $this->deliverydate . "',deliverytime='" . $this->deliverytime . "',
            deliverydistrict='" . $this->deliverydistrict . "',hospitaltype='" . $this->hospitaltype . "',hospitalname='" . $this->hospitalname . "',
            childGender='" . $this->childGender . "',deliveryConductBy='" . $this->deliveryConductBy . "',deliverytype='" . $this->deliverytype . "',
            deliveryCompilcation='" . $this->deliveryCompilcation . "',deliveryOutcome='" . $this->deliveryOutcome . "',noOfLiveBirth='" . $this->noOfLiveBirth . "',
            noOfStillBirth='" . $this->noOfStillBirth . "',infantId='" . $this->infantId . "', birthDetails='" . $this->birthDetails . "',birthWeight='" . $this->birthWeight . "', birthHeight='" . $this->birthHeight . "',
            delayedCClamping='" . $this->delayedCClamping . "',skintoskinContact='" . $this->skintoskinContact . "', breastfeedInitiated='" . $this->breastfeedInitiated . "',admittedSncu='" . $this->admittedSncu . "', sncudate='" . $this->sncudate . "',sncuAreaName='" . $this->sncuAreaName . "',
            sncuOutcome='" . $this->sncuOutcome . "',dischargedate='" . $this->dischargedate . "', dischargetime='" . $this->dischargetime . "',bcgdate='" . $this->bcgdate . "', opvDdate='" . $this->opvDdate . "', hebBdate='" . $this->hebBdate . "'
            , injuction='" . $this->injuction . "',createdBy='" . $this->usertype . "', createdat='" . $date . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                $inserid = $this->conn->lastInsertId();
                return $inserid;
            }
    
            return false;
        }
    }

    
    function editdeliverydetails() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `deliverydetails` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            // query to insert record
            $query = "UPDATE " . $this->table_name . "
            SET
            picmeno='" . $this->picmeno . "',deliverydate='" . $this->deliverydate . "',deliverytime='" . $this->deliverytime . "',
            deliverydistrict='" . $this->deliverydistrict . "',hospitaltype='" . $this->hospitaltype . "',hospitalname='" . $this->hospitalname . "',
            childGender='" . $this->childGender . "',deliveryConductBy='" . $this->deliveryConductBy . "',deliverytype='" . $this->deliverytype . "',
            deliveryCompilcation='" . $this->deliveryCompilcation . "',deliveryOutcome='" . $this->deliveryOutcome . "',noOfLiveBirth='" . $this->noOfLiveBirth . "',
            noOfStillBirth='" . $this->noOfStillBirth . "',infantId='" . $this->infantId . "', birthDetails='" . $this->birthDetails . "',birthWeight='" . $this->birthWeight . "', birthHeight='" . $this->birthHeight . "',
            delayedCClamping='" . $this->delayedCClamping . "',skintoskinContact='" . $this->skintoskinContact . "', breastfeedInitiated='" . $this->breastfeedInitiated . "',admittedSncu='" . $this->admittedSncu . "', sncudate='" . $this->sncudate . "',sncuAreaName='" . $this->sncuAreaName . "',
            sncuOutcome='" . $this->sncuOutcome . "',dischargedate='" . $this->dischargedate . "', dischargetime='" . $this->dischargetime . "',bcgdate='" . $this->bcgdate . "', opvDdate='" . $this->opvDdate . "', hebBdate='" . $this->hebBdate . "' , injuction='" . $this->injuction . "',  updatedBy='" . $this->usertype . "', updatedat='" . $date . "' WHERE picmeno='" . $this->picmeno . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //$inserid = $this->conn->lastInsertId();
                return true;
            }
    
            return false;
        }
    }

    function deletedeliverydetails() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `deliverydetails` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
    
            //$row = $mvaliduser1->fetch(PDO::FETCH_ASSOC);
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . " SET status='0', deletedat='".$date."'
            WHERE
            picmeno='" . $this->picmeno . "' AND status='1'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //return $row['id'];
                return true;
            }
    
            return false;
        }
    }

}




?>