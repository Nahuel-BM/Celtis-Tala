<?php

class dbConn {

    public $conn;

    public function __construct() {

        include_once('./application/config/config.php');

        $this->conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

}
