<?php

include 'Core.php';

class Dashboard extends Core {

    private $_template;

    function __construct() {
        parent::__construct(); //asegurarme que esten logueados.
        $this->_template = new Template("./application/styles/views/dashboard/dash.php");
        self::buildPage();
        parent::setTemplate($this->_template);
    }

    function buildPage() {
        
    }

    function show() {
        parent::show();
    }

}
