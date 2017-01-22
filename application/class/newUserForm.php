<?php

include_once('dbConn.php');

class newUserForm extends dbConn {

    public function createUser($usr, $uid, $email, $pw) {

        include_once './application/config/config.php';

        try {

            $sql = "SELECT COUNT(*) FROM `Users` WHERE `email` = '" . $email . "';";

            $db = new dbConn;

            $stmt = $db->conn->query($sql);
            $valor = ($stmt->fetch_array());
            $err = '';
            if ($valor[0] == '0') {
                $stmt = $db->conn->query("INSERT INTO `Users` (`email`, `password`, `token`, `username`) VALUES ('" . $email . "', '" . $pw . "', '" . $uid . "','" . $usr . "')");
            } else {
                $err = 'Email is already in use.';
            }
        } catch (Exception $e) {
            $err = "Error: " . $e->getMessage();
        }

        //Determines returned value ('true' or error code)
        if ($err == '') {
            $success = 'true';
        } else {
            $success = $err;
        };

        return $success;
    }

}
