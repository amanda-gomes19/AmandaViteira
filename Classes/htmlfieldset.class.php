<?php

require_once 'htmlabstract.class.php';

class HtmlFieldset extends HtmlAbstract {

    private $legend = null;
    private $objetos;

    function __construct($legend = null) {
        $this->setLegend($legend);
        $this->objetos = array();
    }

    public function adicionaArrayDeObjetos(Array $objetos) {
        foreach ($objetos as $objeto) {
            $this->objetos [] = $objeto;
        }
    }

    public function adicionaObjeto(HtmlAbstract $objeto) {
        $this->objetos [] = $objeto;
    }

    public function geraHtml() {
        $field = "<fieldset>";
        $field .= $this->legend;

        foreach ($this->objetos as $objeto) {
            $field .= $objeto->geraHtml();
        }

        $field .= "</fieldset>";

        return $field;
    }

    function getLegend() {
        return $this->legend;
    }

    function setLegend($legend = null) {
        if (is_null($legend) || trim($legend) === "") {
            // Faz nada;
        } else {
            $this->legend = "<legend>{$legend}</legend>";
        }
    }

}

?>