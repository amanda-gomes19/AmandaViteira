<?php

/**
 * Description of inputhtml
 *
 * @author kaique
 */
require_once 'htmlabstract.class.php';

class InputHtml extends HtmlAbstract {

    private $type;
    private $name;
    private $value;
    private $texto = null;
    private $checked = null;
    private $hidden = null;

    function __construct($type = "text", $name = null, $value = null) {
        parent::__construct();
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;

        $this->setChecked();
    }

    public function geraHtml() {
        $html = null;
        $html .= "<input type='{$this->type}'{$this->hidden} name='{$this->name}' value='{$this->value}'{$this->checked}>";
        $html .= $this->texto;
        $html .= "</input>";
        return $html;
    }

    function getType() {
        return $this->type;
    }

    function getName() {
        return $this->name;
    }

    function getValue() {
        return $this->value;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function getChecked() {
        return $this->checked;
    }

    function setChecked($checked = false) {
        if ($checked) {
            $this->checked = " checked ='checked'";
        } else {
            $this->checked = null;
        }
    }

    function getHidden() {
        return $this->hidden;
    }
    
    function setHidden($hidden) {
        if($hidden){
            $this->hidden = " hidden";
        }else{
            $this->hidden = null;
        }
    }

}
