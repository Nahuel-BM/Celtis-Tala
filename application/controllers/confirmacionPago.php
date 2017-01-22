<?php

require_once ('./application/class/mercadopago.php');
require_once '../aplication/class/dbConn.php';

class confirmacionPago {

    public function __construct() {

        $mp = new MP("8506399170539624", "1wNLMkYKhM128iFvI1ilg2PgwuvXPWj1");

        $mp->sandbox_mode(TRUE);

        $payment_info = $mp->get_payment_info($_GET["id"]);

        if ($payment_info["status"] == 200) {
            print_r($payment_info["response"]);

            $sql = "INSERT INTO `pagos`(`data`) VALUES ('" . $payment_info["status"] . "');";
            
            $db = new dbConn;
            $db->query($sql);
            
        }
    }

}
