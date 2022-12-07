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

class Users {

    // database connection and table name
    private $conn;
    private $table_name = "users";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createecregister() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `users` WHERE `email`='" . $this->email . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        // if ($mvalidchecknum !="") {
    
        //     // query to insert record
        //     $query = "INSERT INTO
        //         " . $this->table_name . "
        //     SET
        //     ecfrno='" . $this->ecfrno . "',dateecreg='" . $this->dateecreg . "',motheraadhaarid='" . $this->motheraadhaarid . "',
        //     motheraadhaarname='" . $this->motheraadhaarname . "',husbandaadhaarid='" . $this->husbandaadhaarid . "',husbandaadhaarname='" . $this->husbandaadhaarname . "',
        //     motherfullname='" . $this->motherfullname . "',motherdob='" . $this->motherdob . "',motherageecreg='" . $this->motherageecreg . "',
        //     motheragemarriage='" . $this->motheragemarriage . "',mothermobno='" . $this->mothermobno . "',mobileofperson='" . $this->mobileofperson . "',
        //     motheredustatus='" . $this->motheredustatus . "',husfullname='" . $this->husfullname . "', husdob='" . $this->husdob . "',husageecreg='" . $this->husageecreg . "', husagemarriage='" . $this->husagemarriage . "',
        //     husmobno='" . $this->husmobno . "',husedustatus='" . $this->husedustatus . "', religion='" . $this->religion . "',caste='" . $this->caste . "',address='" . $this->address . "',
        //     pincode='" . $this->pincode . "',povertystatus='" . $this->povertystatus . "', migrantstatus='" . $this->migrantstatus . "',rationcardtype='" . $this->rationcardtype . "', rationcardnum='" . $this->rationcardnum . "'";
        //     // prepare query
        //     $stmt = $this->conn->prepare($query);
    
    
    
        //     if ($stmt->execute()) {
        //         $inserid = $this->conn->lastInsertId();
        //         return $inserid;
        //     }
    
        //     return false;
        // } else {
        //     $row = $mvaliduser1->fetch(PDO::FETCH_ASSOC);
        //     // query to insert record
        //     $query = "UPDATE " . $this->table_name . "
        //     SET
        //     ecfrno='" . $this->ecfrno . "',dateecreg='" . $this->dateecreg . "',motheraadhaarid='" . $this->motheraadhaarid . "',
        //     motheraadhaarname='" . $this->motheraadhaarname . "',husbandaadhaarid='" . $this->husbandaadhaarid . "',husbandaadhaarname='" . $this->husbandaadhaarname . "',
        //     motherfullname='" . $this->motherfullname . "',motherdob='" . $this->motherdob . "',motherageecreg='" . $this->motherageecreg . "',
        //     motheragemarriage='" . $this->motheragemarriage . "',mothermobno='" . $this->mothermobno . "',mobileofperson='" . $this->mobileofperson . "',
        //     motheredustatus='" . $this->motheredustatus . "',husfullname='" . $this->husfullname . "', husdob='" . $this->husdob . "',husageecreg='" . $this->husageecreg . "', husagemarriage='" . $this->husagemarriage . "',
        //     husmobno='" . $this->husmobno . "',husedustatus='" . $this->husedustatus . "', religion='" . $this->religion . "',caste='" . $this->caste . "',
        //     pincode='" . $this->pincode . "',povertystatus='" . $this->povertystatus . "', migrantstatus='" . $this->migrantstatus . "',rationcardtype='" . $this->rationcardtype . "', rationcardnum='" . $this->rationcardnum . "'";
        //     // prepare query
        //     $stmt = $this->conn->prepare($query);
    
    
    
        //     if ($stmt->execute()) {
        //         return $row['id'];
        //     }
    
        //     return false;
        // }
    }

    
    function editusers() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `users` WHERE `email`='" . $this->email . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
        
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . "
            SET
            name='" . $this->name . "',username='" . $this->username . "',email='" . $this->email . "',
            mobile='" . $this->mobile . "',usertype='" . $this->usertype . "',HosId='" . $this->hospital . "',BlockId='" . $this->block . "',
            PhcId='" . $this->phc . "',HscId='" . $this->hsc . "',PanchayatId='" . $this->panchayat . "', VillageId='" . $this->village . "',
            encpassword='" . password_hash($this->encpassword, PASSWORD_DEFAULT) . "',password='" . $this->password . "' WHERE `email`= '" . $this->email."'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //return $row['Ecfrno'];
                return true;
            }
    
            return false;
        }
    }

    function editpassword() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `users` WHERE `mobile`='" . $this->mobile . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
        
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . "
            SET
            mobile='" . $this->mobile . "',
            encpassword='" . password_hash($this->encpassword, PASSWORD_DEFAULT) . "',password='" . $this->password . "' WHERE `mobile`='" . $this->mobile . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //return $row['Ecfrno'];
                return true;
            }
    
            return false;
        }
    }
    function editconformpassword() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `users` WHERE `email`='" . $this->email . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
        
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . "
            SET
            email='" . $this->email . "',
            encpassword='" . password_hash($this->encpassword, PASSWORD_DEFAULT) . "',password='" . $this->password . "' WHERE `email`='" . $this->email . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //return $row['Ecfrno'];
                return true;
            }
    
            return false;
        }
    }

    function deleteecregister() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `ecregister` WHERE `ecfrno`='" . $this->ecfrno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
    
            //$row = $mvaliduser1->fetch(PDO::FETCH_ASSOC);
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . " SET status='0', deletedat='".$date."'
            WHERE
            ecfrno='" . $this->ecfrno . "' AND status='1'";
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