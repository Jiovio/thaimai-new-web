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

class immunization {

    // database connection and table name
    private $conn;
    private $table_name = "immunization";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createimmunization() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `immunization` WHERE `picmeNo`='" . $this->picmeNo . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            // query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
            SET
            picmeNo='" . $this->picmeNo . "',doseNo='" . $this->doseNo . "',doseName='" . $this->doseName . "',
            doseDueDate='" . $this->doseDueDate . "',FutureDoseNo='" . $this->FutureDoseNo . "',doseProvidedDate='" . $this->doseProvidedDate . "',
            breastFeeding='" . $this->breastFeeding . "',compliFoodStart='" . $this->compliFoodStart . "',createdUserId='" . $this->usertype . "', createdat='" . $date . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                $inserid = $this->conn->lastInsertId();
                return $inserid;
            }
    
            return false;
        } 
    }

    function editimmunization() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `immunization` WHERE `picmeNo`='" . $this->picmeNo . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            // query to insert record
            $query = "UPDATE " . $this->table_name . "
            SET
            picmeNo='" . $this->picmeNo . "',doseNo='" . $this->doseNo . "',doseName='" . $this->doseName . "',
            doseDueDate='" . $this->doseDueDate . "',FutureDoseNo='" . $this->FutureDoseNo . "',doseProvidedDate='" . $this->doseProvidedDate . "',
            breastFeeding='" . $this->breastFeeding . "',compliFoodStart='" . $this->compliFoodStart . "', updUserId='" . $this->usertype . "', updatedat='" . $date . "' WHERE picmeNo='" . $this->picmeNo . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //$inserid = $this->conn->lastInsertId();
                return true;
            }
    
            return false;
        }
    }

    function deleteimmunization() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `immunization` WHERE `picmeNo`='" . $this->picmeNo . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
    
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . " SET status='0', deletedUserId='" . $this->usertype . "', deletedat='".$date."'
            WHERE
            picmeNo='" . $this->picmeNo . "' AND status='1'";
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