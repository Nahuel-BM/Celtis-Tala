<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mercadopagoController
 *
 * @author Hogar
 */

include_once('./application/class/dbConn.php');

class mercadopagoController{

    
    
    public function __construct() {
        
        
        
        /*
         * Credenciales MercadoPago

          Client_id:	8506399170539624
          Client_secret:	1wNLMkYKhM128iFvI1ilg2PgwuvXPWj1

         *  Modo Sandbox

          Public key: TEST-dbd580ff-d202-438f-ad4f-09d49987cdb9
          Access token: TEST-8506399170539624-012014-cbbfadafeeff30b89e9c5d0a419253c6__LD_LB__-241467184

         */

        self::test1();
    }

    public function test() {

        require_once ('./application/class/mercadopago.php');

        $mp = new MP("TEST-8506399170539624-012014-cbbfadafeeff30b89e9c5d0a419253c6__LD_LB__-241467184");

        $mp->post(
                array(
                    "uri" => "/v1/customers",
                    "data" => array(
                        "email" => "email@test.com"
                    )
                )
        );
    }

    public function test1() {

        require_once ('./application/class/mercadopago.php');

        $mp = new MP("8506399170539624", "1wNLMkYKhM128iFvI1ilg2PgwuvXPWj1");


        $preference_data = array(
            "items" => array(
                array(
                    "title" => "Title of what you are paying for",
                    "currency_id" => "USD",
                    "category_id" => "Category",
                    "quantity" => 1,
                    "unit_price" => 10.2
                )
            )
        );

        $preference = $mp->create_preference($preference_data);

        print_r($preference);
    }
    
    private function generarTituloPago(){
        
    }
    
    private function getTokenYIdMercado(){
        
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
