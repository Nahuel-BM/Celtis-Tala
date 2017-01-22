<?php

include_once('dbConn.php');

class loginForm extends dbConn {

    public function checkLogin($myusername, $mypassword) {

        try {

            $db = new dbConn;

            $err = '';
        } catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }

        $stmt = $db->conn->query("SELECT * FROM `Users` WHERE username = '" . $myusername . "' LIMIT 1;");
        $result = $stmt->fetch_assoc();

        if (password_verify($mypassword, $result['password']) && $result['valid'] == '1') {

            $success = 'true';
            $_SESSION['id'] = $result['id'];
        } elseif (password_verify($mypassword, $result['password']) && $result['valid'] == '0') {

            // Register $myusername, $mypassword and return "true"
            $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Your account has been created, but you cannot log in until it has been verified</div>";
        } else {
            //return the error message
            $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Wrong Username or Password</div>";
        }

        return $success;
    }

}
