<?php

require_once 'htmlabstractcomobjetos.class.php';

class HtmlTr extends HtmlAbstractComObjetos {

    function __construct($class = null, $id = null, $title = null) {
        parent::__construct($class, $id, $title);
    }

    public function geraHtml() {
        return "<tr{$this->geraAtributosGlobais()}>{$this->montaObjetos()}</tr> ";
    }

}
