<?php

class mailSender {

        public function sendMailConsulta($para, $msj) {


        $localtime_assoc = localtime(time(), true);
        
        $titulo = ' Consulta Alojamiento Celtis Tala - ' . $localtime_assoc['tm_mday'] . '/' . ($localtime_assoc['tm_mon'] + 1) . '/' . ($localtime_assoc['tm_year'] + 1900) . '.';

        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF8' . "\r\n";
        $cabeceras .= 'From: Web Celtis Tala <admin@celtis-tala.esy.es>' . "\r\n";

        $mensaje = "" . $msj;


        mail($para, $titulo, $mensaje, $cabeceras);
    }

}
