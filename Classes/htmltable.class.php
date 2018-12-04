<?php

require_once 'htmlabstractcomobjetos.class.php';

class HtmlTable extends HtmlAbstractComObjetos {

    function __construct($class = null, $id = null, $title = null) {
        parent::__construct($class, $id, $title);
    }

    public function geraHtml() {
        return "<table{$this->geraAtributosGlobais()} border='1'>{$this->montaObjetos()}</table>";
    }

}
