<?php

include './application/class/template.class.php';
$option = filter_input(INPUT_GET, "option", FILTER_SANITIZE_STRING);

switch ($option) {

    case "contact": {

            $head = new Template("./application/styles/views/general/head.php");
            $header = new Template("./application/styles/views/general/header.php");
            $menu = new Template("./application/styles/views/general/menu.php");
            $content = new Template("./application/styles/views/contact/contact.php");

            $salida = $head->output() . $header->output() . $menu->output() . $content->output();
            die($salida);

            break;
        }

    case "reserve": {

            $head = new Template("./application/styles/views/general/head.php");
            $header = new Template("./application/styles/views/general/header.php");
            $menu = new Template("./application/styles/views/general/menu.php");
            $content = new Template("./application/styles/views/reserve/reserve.php");
            $footer = new Template("./application/styles/views/general/footer.php");

            $salida = $head->output() . $header->output() . $menu->output() . $content->output();
            die($salida);

            break;
        }

    case "about": {

            $head = new Template("./application/styles/views/general/head.php");
            $header = new Template("./application/styles/views/general/header.php");
            $menu = new Template("./application/styles/views/general/menu.php");
            $content = new Template("./application/styles/views/about/about.php");
            $footer = new Template("./application/styles/views/general/footer.php");
            
            $salida = $head->output() . $header->output() . $menu->output() . $content->output() . $footer->output();
            die($salida);
            break;
        }

    default: {
            $head = new Template("./application/styles/views/general/head.php");
            $header = new Template("./application/styles/views/general/header.php");
            $menu = new Template("./application/styles/views/general/menu.php");
            $content = new Template("./application/styles/views/index/inicio.php");
            $footer = new Template("./application/styles/views/general/footer.php");

            $salida = $head->output() . $header->output() . $menu->output() . $content->output() . $footer->output();
            die($salida);
        }
} 
