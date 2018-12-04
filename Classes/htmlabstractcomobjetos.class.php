<?php

require_once 'htmlabstract.class.php';

abstract class HtmlAbstractComObjetos extends HtmlAbstract {

    protected $objetos;

    function __construct($class = null, $id = null, $title = null) {
        parent::__construct($class, $id, $title);
        $this->objetos = array();
    }

    public function adicionaObjeto($objeto = null) {
        if (is_null($objeto)) {
            // Nao faz nada;
        } else {
            $this->objetos[] = $objeto;
        }
    }

    public function montaObjetos() {
        $htmlString = "";

        foreach ($this->objetos as $objeto) {
            if (is_object($objeto)) {
                $htmlString .= $objeto->geraHtml();
            } else {
                $htmlString .= $objeto;
            }
        }

        return $htmlString;
    }

    function getObjetos() {
        return $this->objetos;
    }

    function setObjetos($objetos) {
        $this->objetos = $objetos;
    }

}

?>