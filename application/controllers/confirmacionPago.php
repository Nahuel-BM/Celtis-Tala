<?php

require_once ('./application/class/mercadopago.php');
require_once '../aplication/class/dbConn.php';

class confirmacionPago {

    public function __construct() {

        $data = self::getTokenYIdMercado();

        $mp = new MP($data['idMercado'], $data['tokenMercado']);

        $mp->sandbox_mode(TRUE);

        $payment_info = $mp->get_payment_info($_GET["id"]);

        if ($payment_info["status"] == 200) {
            print_r($payment_info["response"]);

            $sql = "INSERT INTO `pagos`(`data`) VALUES ('" . $payment_info["status"] . "');";

            $db = new dbConn;
            $db->query($sql);
        }
    }

    public function getTokenYIdMercado() {

        try {

            $db = new dbConn;

            $err = '';
        } catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }

        $stmt = $db->conn->query("SELECT * FROM `Configuracion` LIMIT 1;");
        $result = $stmt->fetch_assoc();

        return $result;
    }

}
