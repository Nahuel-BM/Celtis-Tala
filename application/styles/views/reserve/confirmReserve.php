<?php

require_once ('./application/class/mercadopago.php');

$mp = new MP("8506399170539624", "1wNLMkYKhM128iFvI1ilg2PgwuvXPWj1");

$preference_data = array(
    "items" => array(
        array(
            "title" => "Reserva en Celtis Tala",
            "currency_id" => "ARS",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => 10.2
        )
    )
);

$preference = $mp->create_preference($preference_data);


echo '<pre>';

print_r($preference);
die;