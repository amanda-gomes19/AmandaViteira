<?php

require_once 'modelabstract.class.php';

class CestaDeCompraModel extends ModelAbstract {
    private $cestClieCpf;
    
    function __construct( $cestClieCpf = null) {
        $this->cestClieId = $cestClieCpf;
    }

    function getCestClieCpf() {
        return $this->cestClieCpf;
    }

    function setCestClieCpf($cestClieCpf) {
        $this->cestClieCpf = $cestClieCpf;
    }

        
    public function checaAtributos() {
        $dadosOk = true;
        
        return $dadosOk;
    }

}
