<?php

class Core {

    private $_template;
    private $_dbConn;

    function __construct() {

        session_start();
        if (!isset($_SESSION['username']) or ! isset($_SESSION['id'])) {
            header("location:login/main_login.php");
        }

        include_once( './application/class/dbConn.class.php' );

        $this->_dbConn = new dbConn();
    }

    public function setTemplate($template) {
        $this->_template = $template;
    }

    public function show() {

        include_once( './application/class/template.class.php' );

        $estructura = new Template('./application/styles/views/general/estructura.php');
        $header = new Template('./application/styles/views/general/header.php');
        $navSuperior = new Template('./application/styles/views/general/menuSuperior.php');
        $navLateral = new Template('./application/styles/views/general/menuLateral.php');

        $navLateral->set("lista_activos", self::getListaServidores());

        $estructura->set("header", $header->output());
        $estructura->set("navSuperior", $navSuperior->output());
        $estructura->set("navLateral", $navLateral->output());
        $estructura->set("body", $this->_template->output());
        $estructura->set("footer", "");



        die($estructura->output());
    }

    public function getDataServidores() {
        $result = $this->_dbConn->query("SELECT Servidor.* FROM Users_Servidor INNER JOIN Servidor ON Users_Servidor.servidores_id=Servidor.id AND Users_Servidor.Users_id=" . $_SESSION['id'] . ";");

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getDbConn() {
        return $this->_dbConn;
    }

    private function getListaServidores() {
        include_once( './application/class/template.class.php' );

        $texto = "";
        $ListaItem = new Template('./application/styles/views/general/listaActivos.php');
        $precio = self::getDataServidores();

        if ($precio != null) {

            for ($i = 0; $i < count($precio); $i++) {
                $Item = new Template('./application/styles/views/general/itemActivos.php');
                $Item->set("name", $precio[$i]['name']);
                $Item->set("id", $precio[$i]['id']);

                $texto .= $Item->output();
            }

            $ListaItem->set("item_activos", $texto);

            return $ListaItem->output();
        } else {
            return $texto;
        }
    }

}
