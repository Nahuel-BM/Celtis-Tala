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

class mercadopagoController {

    public function __construct() {
        self::procesarSeñaEstadia();
    }

    public function procesarSeñaEstadia() {

        require_once ('./application/class/mercadopago.php');

        $data = self::getTokenYIdMercado();

        $mp = new MP($data['idMercado'], $data['tokenMercado']);

        $datosEstadia = self::generarDatosPago($data, 5);

        $preference_data = array(
            "items" => array(
                $datosEstadia
            )
        );

        //      $preference = $mp->create_preference($preference_data);

        print_r($preference_data);
    }

    private function generarDatosPago($datosEnTablaMysql, $cantidadDias) {

        $precioTotalSeña = ($datosEnTablaMysql['precioDia'] * $cantidadDias) * ($datosEnTablaMysql['seniaNecesaria'] / 100);

        return array(
            "title" => "Seña en Celtis Tala por " . $cantidadDias . " Dias. (" . $datosEnTablaMysql['seniaNecesaria'] . "% del Total de la estadia).",
            "currency_id" => "ARS",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => $precioTotalSeña
        );
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
