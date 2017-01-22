<?php

include_once './application/class/mailSender.php';

class envioConsulta {

    private $nombre;
    private $telefono;
    private $email;
    private $mensaje;

    public function __construct() {
        /*
         * name=Nahuel&phone=0354115683523&email=nahuel.bustamante%40gmail.com&message=Hola!!! 
         */
        $this->nombre = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $this->telefono = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
        $this->email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $this->mensaje = filter_input(INPUT_POST, "menssage", FILTER_SANITIZE_STRING);

        self::init();
    }

    public function init() {

        $msj = 'Remitente: '.$this->nombre . '\n Telefono: ' . $this->telefono . '\n Email: ' . $this->email . '\n Mensaje: ' . $this->mensaje;



        $m = new mailSender;
        $m->sendMailConsulta('casa.celtis.tala@gmail.com', $msj);
    }

}
