<?php

require_once 'htmlabstract.class.php';

class HtmlA extends HtmlAbstract {

    private $objetos;
    private $href;

    function __construct($href = null) {
        $this->href = $href;

        $this->objetos = array();
    }

    function adicionaObjeto($objeto) {
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
        $a = "<a href='{$this->href}'{$this->geraAtributosGlobais()}>";

        foreach ($this->objetos as $objeto) {
            if (is_object($objeto)) {
                $a .= $objeto->geraHtml();
            } else {
                $a .= $objeto;
            }
        }

        $a .= "</a>";

        return $a;
    }

    function getHref() {
        return $this->href;
    }

    function setHref($href) {
        $this->href = $href;
    }

}
