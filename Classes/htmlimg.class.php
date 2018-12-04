<?php

require_once 'htmlabstract.class.php';

class HtmlImg extends HtmlAbstract {

    private $src    = null;
    private $alt    = null;
    private $height = null;
    private $width  = null;

    function __construct($src = null, $alt = null, $height = null, $width = null, $class = null, $id = null, $title = null) {
        $this->setSrc($src);
        $this->setAlt($alt);
        $this->setHeight($height);
        $this->setWidth($width);
        
        parent::__construct($class, $id, $title);
    }

    public function geraHtml() {
        $img = "<img{$this->src}{$this->alt}{$this->height}{$this->width}{$this->geraAtributosGlobais()}>";

        return $img;
    }

    function getSrc() {
        return $this->src;
    }

    function getAlt() {
        return $this->alt;
    }

    function getHeight() {
        return $this->height;
    }

    function getWidth() {
        return $this->width;
    }

    function setSrc($src) {
        $this->src = " src='{$src}'";
    }

    function setAlt($alt) {
        $this->alt = " alt='{$alt}'";
    }

    function setHeight($height) {
        $this->height = " height='{$height}'";
    }

    function setWidth($width) {
        $this->width = " width='{$width}'";
    }

}
