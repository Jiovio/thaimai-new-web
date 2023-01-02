<?php
namespace Phppot;

class Member
{
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../config/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * to check if the username already exists
     *
     * @param string $username
     * @return boolean
     */
    public function isUsernameExists($username)
    {
        $query = 'SELECT * FROM users where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to check if the email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM users where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerMember()
    {
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email / Username already exists."
            );
        } else {
            if (! empty($_POST["signup-password"])) {

                // PHP's password_hash is the best choice to use to store passwords
                // do not attempt to do your own encryption, it is not safe
                $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
            }
            $query = 'INSERT INTO users (username, email, password) VALUES (?, ?)';
            $paramType = 'sss';
            $paramValue = array(
                $_POST["username"],
                $_POST["email"],
                $hashedPassword 
            );
            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if (! empty($memberId)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            }
            if (!empty($query)) {
                echo "<script>alert('Updated Successfully');</script>";
            }
        }
        return $response;
    }

    public function AddRegMember($userid)
    {   $isUsernameExists =  $this->isUsernameExists($_POST["username"]);
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isEmailExists || $isUsernameExists ) {
            $response = array(
                "status" => "error",
                "message" => "Email / Username already exists."
            );
        } else {
            if (! empty($_POST["encpassword"])) {
                $hashedPassword = password_hash($_POST["encpassword"], PASSWORD_DEFAULT);
                $password = $_POST["encpassword"];
            }
            $query = 'INSERT INTO users (name,username,email,encpassword,password,mobile,usertype,HosId,BlockId,PhcId,HscId,status,createdBy) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $paramType = 'sssssssssssss';
            $paramValue = array(
                $_POST["name"],
                $_POST["username"],
                $_POST["email"],
                $hashedPassword,
                $password,
                $_POST["mobile"],
                $_POST["usertype"],
                $_POST["HosId"],
                $_POST["BlockId"],
                $_POST["PhcId"],
                $_POST["HscId"],
                $_POST["status"],
                $userid
            );
            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if (empty($memberId) >0) {
                $response = array(
                    "status" => "success",
                    "message" => "User Added successfully."
                );
            }else{
                $response = array(
                    "status" => "error",
                    "message" => "Enter the Fields."
                );
            }
        }
        return $response;
    }

    public function getMember($email, $username)
    {
        $query = 'SELECT * FROM users where email = ? OR username = ?';
        $paramType = 'ss';
        $paramValue = array(
            $username,
            $email
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * to login a user
     *
     * @return string
     */
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["email"], $_POST["email"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $hashedPassword = $memberRecord[0]["encpassword"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            // login sucess so store the member's username in
            // the session
            session_start();
            $_SESSION["userid"] = $memberRecord[0]["id"];
            $_SESSION["email"] = $memberRecord[0]["email"];
            $_SESSION["username"] = $memberRecord[0]["username"];
            $_SESSION["usertype"] = $memberRecord[0]["usertype"];
            $_SESSION["BlockId"] = $memberRecord[0]["BlockId"];
            $_SESSION["PhcId"] = $memberRecord[0]["PhcId"];
            $_SESSION["HscId"] = $memberRecord[0]["HscId"];

            session_write_close();
            if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1') {
                $url = "forms/dashboard.php";
                header("Location: $url");
            } else if($_SESSION["usertype"] == '2') {
                $url = "forms/Bdashboard.php";
                header("Location: $url");
            } else if(($_SESSION["usertype"] == '3') ||($_SESSION["usertype"] == '4')) {
                $url = "forms/Pdashboard.php";
                header("Location: $url");
            } else {
                $url = "forms/Hdashboard.php";
                header("Location: $url");
            }
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid Username or Password";
            return $loginStatus;
        }
    }

}
