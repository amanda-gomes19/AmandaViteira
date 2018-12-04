<?php

require_once 'htmlabstract.class.php';

class DivHtml extends HtmlAbstract {

    private $objetos;
    private $texto;

    function __construct($texto = null) {
        $this->objetos = array();
        $this->texto   = $texto;
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
        $div = "<div{$this->geraAtributosGlobais()}>";

        $div .= $this->texto;

        foreach ($this->objetos as $objeto) {
            if (is_object($objeto)) {
                $div .= $objeto->geraHtml();
            } else {
                $div .= $objeto;
            }
        }

        $div .= "</div>";

        return $div;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

}
