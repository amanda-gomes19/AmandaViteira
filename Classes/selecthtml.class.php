<?php

/**
 * Description of selecthtml
 *
 * @author kaique
 */
require_once 'htmlabstract.class.php';

class SelectHtml extends HtmlAbstract {

    private $name;
    private $options;

    function __construct($name = null) {
        parent::__construct();

        $this->name = $name;
        $this->options = array();
    }

    public function geraHtml() {
        $select = "<select name='{$this->name}'>";
        foreach ($this->options as $option) {
            $select .= $option->geraHtml();
        }
        $select .= "</select>";
        return $select;
    }

    function getName() {
        return $this->name;
    }

    function getOptions() {
        return $this->options;
    }

    function setName($name) {
        $this->name = $name;
    }

//    function adicionaOptions($options) {
//        $this->options [] = $options;
//    }
    function adicionaOption(OptionHtml $option) {
        $this->options [] = $option;
    }

}
