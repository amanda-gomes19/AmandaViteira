<?php

require_once 'modelabstract.class.php';

class ProdutosDasCestas extends ModelAbstract{
    private $prceCestClieCpf;
    private $prceProdId;
    
    function __construct($prceCestClieCpf= null, $prceProdId = null) {
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
        
        //VERIFICA SE O prceClieCpf ESTA NULO OU VAZIO E SE POSSUI 11 CARACTERES
        if (is_null($this->prceCestClieCpf) || trim($this->prceCestClieCpf) == "") {
            $this->adicionaMensagem("Insira o número do CPF do cliente da cesta!");
            $dadosOk = false;
        } else {
            if (is_numeric($this->prceCestClieCpf)) {
                if (strlen($this->prceCestClieCpf) != 11) {
                    $this->adicionaMensagem(("Insira um CPF válido! (11 dìgitos)"));
                    $dadosOk = false;
                } else {
                    //continua
                }
            }
        }
        
         //VERIFICA SE O prceProdId ESTA NULO OU VAZIO
        if (is_null($this->prceProdId) || trim($this->prceProdId) == "") {
            $this->adicionaMensagem("Ruim no Id");
            $dadosOk = false;
        } else {
            if (is_numeric($this->prceProdId)) {
                if (strlen($this->prceProdId) != 11) {
                    $this->adicionaMensagem(("Ruim no ID2"));
                    $dadosOk = false;
                } else {
                    //continua
                }
            }
        }
        
        
    }

}
