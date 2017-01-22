<?php
require_once ('./application/class/mercadopago.php');

$mp = new MP("8506399170539624", "1wNLMkYKhM128iFvI1ilg2PgwuvXPWj1");

$mp->sandbox_mode(TRUE);

$preference_data = array(
//    "status" => "approved",
    "items" => array(
        array(
            "title" => "Reserva en Celtis Tala",
            "currency_id" => "ARS",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => 10.2
        )
    ),
    "notification_url" => "http://celtis-tala.esy.es/new/ajax.php"
);

$preference = $mp->create_preference($preference_data);

print_r($preference);

?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>

        <h1><?php echo $preference["response"]["id"]; ?></h1>

       	<a href="<?php echo $preference["response"]["sandbox_init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Reservar</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
    </body>
</html>
