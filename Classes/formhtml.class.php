<?php

/**
 * Description of formhtml
 *
 * @author kaique
 */
require_once 'htmlabstract.class.php';

class FormHtml extends HtmlAbstract {

    private $action;
    private $method;
    private $objetos;

    function __construct($action=null, $method =null) {
        $this->action = $action;
        $this->method = $method;
        
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
        $form = "<form action='{$this->action}' method='{$this->method}'>";

        foreach ($this->objetos as $objeto) {
            $form .= $objeto->geraHtml();
        }

        $form .= "</form>";

        return $form;
    }

    function getAction() {
        return $this->action;
    }

    function getMethod() {
        return $this->method;
    }

    function getObjetos() {
        return $this->objetos;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setMethod($method) {
        $this->method = $method;
    }

}
