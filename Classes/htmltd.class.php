<?php

require_once 'htmlabstractcomobjetos.class.php';

class HtmlTd extends HtmlAbstractComObjetos {


    function __construct($objeto = NULL, $class = null, $id = null, $title = null) {
        parent::__construct($class, $id, $title);
        $this->adicionaObjeto($objeto);
    }

    public function geraHtml() {
        return "<td{$this->geraAtributosGlobais()}>{$this->montaObjetos()}</td>";
    }

}
