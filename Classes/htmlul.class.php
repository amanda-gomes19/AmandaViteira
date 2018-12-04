<?php

require_once 'htmlabstract.class.php';

class HtmlUl extends HtmlAbstract {

    private $objetos;

    function __construct() {
        $this->objetos = array();
    }

    function adicionaObjeto(HtmlAbstract $objeto) {
        $this->objetos[] = $objeto;
    }

    public function adicionaArrayDeObjetos(Array $objetos) {
        foreach ($objetos as $objeto) {
            $this->objetos [] = $objeto;
        }
    }

    function getObjetos() {
        return $this->objetos;
    }

    public function geraHtml() {
        $ul = "<ul{$this->geraAtributosGlobais()}>";

        foreach ($this->objetos as $objeto) {
            $ul .= $objeto->geraHtml();
        }

        $ul .= "</ul>";

        return $ul;
    }

}
