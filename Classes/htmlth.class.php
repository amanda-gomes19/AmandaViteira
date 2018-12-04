<?php

require_once 'htmlabstractcomobjetos.class.php';

class HtmlTh extends HtmlAbstractComObjetos {   
    private $texto;

    function __construct($texto = NULL, $class = null, $id = null, $title = null) {
        parent::__construct($class, $id, $title);
        $this->texto = $texto;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    public function geraHtml() {
        return "<th{$this->geraAtributosGlobais()}>{$this->texto}{$this->montaObjetos()}</th>";
    }

}
