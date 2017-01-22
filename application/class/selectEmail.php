<?php

include_once('dbConn.php');

class selectEmail extends dbConn {

    public function emailPull($id) {

        include_once './application/config/config.php';

        try {
            $edb = new dbConn;
            $eerr = '';
        } catch (PDOException $e) {
            $eerr = "Error: " . $e->getMessage();
        }

        $estmt = $edb->conn->query("SELECT `email`, `username` FROM `Users` WHERE `token` = '$id' LIMIT 1;");
        $eresult = $estmt->fetch_assoc();
        return $eresult;
    }

}
