<?php

$option = filter_input(INPUT_GET, "option", FILTER_SANITIZE_STRING);

switch ($option) {

    case "send_mail": {
            include_once('./application/controllers/envioConsulta.php');
            new envioConsulta();


            /*
              name=Nahuel&phone=0354115683523&email=nahuel.bustamante%40gmail.com&message=Hola!!!
             */




            break;
        }

    case "mp": {
            include_once('./application/controllers/mercadopagoController.php');
            new mercadopagoController();

            break;
        }

     default: {
            include_once('./application/controllers/confirmacionPago.php');
            new confirmacionPago();
            
           
        }

}
