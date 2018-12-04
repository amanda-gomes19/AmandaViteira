<?php

abstract class HtmlAbstract {

    protected $class;
    protected $id;
    protected $title;
    protected $disabled;

    function __construct($class = null, $id = null, $title = null) {
        $this->setClass($class);
        $this->setId($id);
        $this->setTitle($title);
    }

    function geraAtributosGlobais() {
        return "{$this->id}{$this->class}{$this->title}";
    }

    abstract function geraHtml();

    function setClass($class = null) {
        if (is_null($class) || trim($class) === "") {
            $this->class = NULL;
        } else {
            $this->class = " class='{$class}'";
        }
    }

    function setId($id = null) {
        if (is_null($id) || trim($id) === "") {
            $this->id = NULL;
        } else {
            $this->id = " id='{$id}'";
        }
    }

    function setTitle($title = null) {
        if (is_null($title) || trim($title) === "") {
            $this->title = NULL;
        } else {
            $this->title = " title='{$title}'";
        }
    }

    function getClass() {
        return $this->class;
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getDisabled() {
        return $this->disabled;
    }

    function setDisabled($disabled = false) {
        if ($disabled) {
            $this->disabled = " disabled";
        } else {
            $this->disabled = null;
        }
    }

}

?>