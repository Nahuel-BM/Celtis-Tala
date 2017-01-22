<?php

class mailSender {

    public function sendMail($para, $user, $id, $type) {

        include_once './application/config/config.php';

        $verifyurl = "http://bot.novawar.tk/index.php?option=" . "verifyuser&token=" . $id;

        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: Bots-God <admin@bot.novawar.tk >' . "\r\n";

        if ($type == 'Verify') {
            $titulo = $user . ' Account Verification';
            $mensaje = verifymsg . '<br><a href="' . $verifyurl . '">' . $verifyurl . '</a>';
        } elseif ($type == 'Active') {
            $titulo = ' Account Created!';
            $mensaje = active_email . '<br><a href="http://bot.novawar.tk/index.php?option=login">Here</a>';
        };

        mail($para, $titulo, $mensaje, $cabeceras);
    }

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
