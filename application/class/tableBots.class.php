<?php

include 'Core.php';

class tableBots extends Core {

    private $_template;

    function __construct() {
        parent::__construct(); //asegurarme que esten logueados.
        $this->_template = new Template("./application/styles/views/bots/tables.php");
        self::buildPage();
        parent::setTemplate($this->_template);
    }

    function buildPage() {
        $idBot = filter_input(INPUT_GET, "ServerId", FILTER_VALIDATE_INT);
        $db = parent::getDbConn();

        $result = mysqli_fetch_assoc($db->query("SELECT `name` FROM `Servidor` WHERE `id` = '" . $idBot . "';"));
        $this->_template->set("name", $result['name']);
        $this->_template->set("tbody", self::getTBody($idBot));
    }

    function show() {
        parent::show();
    }

    private function getTBody($idServer) {
        $db = parent::getDbConn();
        $retorno = "";

        $result = $db->query("SELECT Bot.* FROM Servidor_Bot INNER JOIN Bot ON Servidor_Bot.bots_id=Bot.id AND Servidor_Bot.Servidor_id = '" . $idServer . "';");


        while ($row = mysqli_fetch_assoc($result)) {
            $template = new Template("./application/styles/views/bots/row.php");

            $template->set("username", $row['username']);
            $template->set("type", self::getTypeBot($row['type_id']));
            $template->set("estado", self::getEstadoNombre($row['estado_id']));




            $dataPlanetaActual = self::getPlanetaActual($row['id']);
            $dataTareaActual = self::getTarea($dataPlanetaActual['tareaActual_id']);



            $template->set("tarea", self::getTareaBotString($dataTareaActual));


            $template->set("cantplanetas", self::getCantPlanetas($row['id'], $db));


            $retorno .= $template->output();
        }


        return $retorno;
    }

    private function getCantPlanetas($idBot) {
        $db = parent::getDbConn();
        $sql = "SELECT count(*) FROM `Bot_Planetas` WHERE `Bot_id` = '" . $idBot . "';";
        $result = mysqli_fetch_assoc($db->query($sql));
        return $result['count(*)'];
    }

    private function getTypeBot($idType) {
        $db = parent::getDbConn();
        $sql = "SELECT `nombre` FROM `TipoBot` WHERE `id` = '" . $idType . "';";
        $result = mysqli_fetch_assoc($db->query($sql));
        return $result['nombre'];
    }

    private function getIdsPlanetas($idBot) {
        //SELECT * FROM `Planetas` WHERE id='1' or id='7' ORDER BY `planet_last_update` DESC 
        $db = parent::getDbConn();
        $sql = "SELECT `Planetas_id` FROM `Bot_Planetas` WHERE `Bot_id` = '" . $idBot . "';";
        $result = $db->query($sql);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row['Planetas_id'];
        }

        return $data;
    }

    private function getPlanetaActual($idBot) {
        $db = parent::getDbConn();
        $ids = self::getIdsPlanetas($idBot);

        $sql = "SELECT * FROM `Planetas` WHERE ";

        for ($i = 0; $i < count($ids); $i++) {
            $sql .= "id = '" . $ids[$i] . "'";

            if ($i < (count($ids) - 1)) {
                $sql .= " or ";
            }
        }
        $sql .= " ORDER BY `planet_last_update` DESC Limit 1;";

        $result = $db->query($sql);

        return mysqli_fetch_assoc($result);
    }

    private function getTarea($idTarea) {
        $db = parent::getDbConn();
        $sql = "SELECT * FROM `Tareas` WHERE `id` = '" . $idTarea . "';";
        $result = $db->query($sql);

        return mysqli_fetch_assoc($result);
    }

    private function getTareaBotString($tarea) {
        $retorno = "";

        $db = parent::getDbConn();
        $sql = "SELECT `nombre` FROM `TipoTarea` WHERE `id` = '" . $tarea['type_id'] . "';";
        $result = mysqli_fetch_assoc($db->query($sql));

        $retorno .= $result['nombre'] . " " . self::getNombreObjeto($tarea['idItem']);

        if ($tarea['type_id'] == 4 or $tarea['type_id'] == 5) {
            $retorno .=" (" . $tarea['cantidad'] . ").";
        }

        if ($tarea['type_id'] < 4) {
            $retorno .=" Nivel " . $tarea['nivel'] . ".";
        }

        return $retorno;
    }

    private function getEstadoNombre($idEstado) {
        $db = parent::getDbConn();
        $sql = "SELECT `nombre` FROM `EstadoBot` WHERE `id` = '" . $idEstado . "';";
        $result = mysqli_fetch_assoc($db->query($sql));
        return $result['nombre'];
    }

    private function getNombreObjeto($id) {

        $lang = array(
            0 => "Construcción",
            1 => "Mina de metal",
            2 => "Mina de cristal",
            3 => "Sintetizador de deuterio",
            4 => "Planta de energía solar",
            12 => "Planta de fusión",
            14 => "Fábrica de Robots",
            15 => "Fábrica de Nanobots",
            21 => "Hangar",
            22 => "Almacén de Metal",
            23 => "Almacén de Cristal",
            24 => "Contenedor de deuterio",
            31 => "Laboratorio de investigación",
            33 => "Terraformer",
            34 => "Depósito de la Alianza",
            40 => "Construcciones especiales",
            41 => "Base lunar",
            42 => "Sensor Phalanx",
            43 => "Salto cuántico",
            44 => "Silo",
            100 => "Investigación",
            106 => "Tecnología de espionaje",
            108 => "Tecnología de computación",
            109 => "Tecnología militar",
            110 => "Tecnología de defensa",
            111 => "Tecnología de blindaje",
            113 => "Tecnología de energía",
            114 => "Tecnología de hiperespacio",
            115 => "Motor de combustión",
            117 => "Motor de impulso",
            118 => "Propulsor hiperespacial",
            120 => "Tecnología láser",
            121 => "Tecnología iónica",
            122 => "Tecnología de plasma",
            123 => "Red de investigación intergaláctica",
            124 => 'Astrofísica',
            199 => "Tecnología de gravitón",
            200 => "Naves",
            202 => "Nave pequeña de carga",
            203 => "Nave grande de carga",
            204 => "Cazador ligero",
            205 => "Cazador pesado",
            206 => "Crucero",
            207 => "Nave de batalla",
            208 => "Colonizador",
            209 => "Reciclador",
            210 => "Sonda de espionaje",
            211 => "Bombardero",
            212 => "Satélite solar",
            213 => "Destructor",
            214 => "Estrella de la muerte",
            215 => "Acorazado",
            400 => "Defensa",
            401 => "Lanzamisiles",
            402 => "Láser pequeño",
            403 => "Láser grande",
            404 => "Cañón Gauss",
            405 => "Cañón iónico",
            406 => "Cañón de plasma",
            407 => "Cúpula pequeña de protección",
            408 => "Cúpula grande de protección",
            502 => "Misiles antibalísticos",
            503 => "Misil interplanetario",
            600 => "Oficial",
            601 => "Comandante",
            602 => "Almirante",
            603 => "Ingeniero",
            604 => "Geólogo",
            605 => "Tecnócrata",
        );

        return $lang[(int) $id];
    }

}
