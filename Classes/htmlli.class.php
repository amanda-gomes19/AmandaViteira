<?php

require_once 'htmlabstract.class.php';

class HtmlLi extends HtmlAbstract {

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
        $li = "<li{$this->geraAtributosGlobais()}>";

        foreach ($this->objetos as $objeto) {
            if (is_object($objeto)) {
                $li .= $objeto->geraHtml();
            } else {
                $li .= $objeto;
            }
        }

        $li .= "</li>";

        return $li;
    }

}
