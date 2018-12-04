<?php

require_once 'htmlabstract.class.php';

class PHtml extends HtmlAbstract {

    private $objetos;
    private $texto;

    function __construct($texto = null) {
        $this->objetos = array();
        $this->texto = $texto;
    }

    function adicionaObjeto(HtmlAbstract $objeto) {
        $this->objetos[] = $objeto;
    }

    function getObjetos() {
        return $this->objetos;
    }

    public function geraHtml() {
        $p = "<p>";
        
        $p .= $this->texto;

        foreach ($this->objetos as $objeto) {
            $p .= $objeto->geraHtml();
        }

        $p .= "</p>";

        return $p;
    }
    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }


}
