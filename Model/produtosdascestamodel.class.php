<?php

require_once 'modelabstract.class.php';

class ProdutosDasCestaModel extends ModelAbstract{
    private $prceCestClieCpf;
    private $prceProdId;
    
    function __construct($prceCestClieCpf= null, $prceProdId = null) {
        parent::__construct();
        $this->prceCestClieCpf = $prceCestClieCpf;
        $this->prceProdId = $prceProdId;
    }
    
    function getPrceCestClieCpf() {
        return $this->prceCestClieCpf;
    }

    function getPrceProdId() {
        return $this->prceProdId;
    }

    function setPrceCestClieCpf($prceCestClieCpf) {
        $this->prceCestClieCpf = $prceCestClieCpf;
    }

    function setPrceProdId($prceProdId) {
        $this->prceProdId = $prceProdId;
    }

    
    public function checaAtributos() {
        $dadosOk = true;
 
        return $dadosOk;
        
        
    }

}
