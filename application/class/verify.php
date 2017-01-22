<?php

include_once('dbConn.php');

class verify extends dbConn {

    function verifyUser($uid, $email) {

        include_once './application/config/config.php';

        try {

            $vdb = new dbConn;

            $verr = '';

            // prepare sql and bind parameters
            $vdb->conn->query("UPDATE `Users` SET `valid` = '1' WHERE `token` = '" . $uid . "';");
            $vdb->conn->query("UPDATE `Users` SET `token` = '' WHERE `email` = '" . $email . "';");
        } catch (Exception $v) {
            $verr = "Error: " . $v->getMessage();
        }

        // Connect to server and select database.
        //Determines returned value ('true' or error code)
        if ($verr == '') {
            $vresponse = 'true';
        } else {
            $vresponse = $verr;
        };

        return $vresponse;
    }

}
