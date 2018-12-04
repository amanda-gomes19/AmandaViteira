<?php

/**
 * Description of labelhtml
 *
 * @author kaique
 */
require_once 'htmlabstract.class.php';

class LabelHtml extends HtmlAbstract {

    private $texto;

    function __construct($texto = null) {
        $this->texto = $texto;
    }

    public function geraHtml() {
        $html = "<label>";
        $html .= $this->texto;
        $html .= "</label>";
        return $html;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function getDisabled() {
        return NULL;
    }

    function setDisabled($disabled = false) {
        $this->disabled = NULL;
    }

}
