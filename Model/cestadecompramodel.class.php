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
        
        //VERIFICA SE O ClieCpf ESTA NULO OU VAZIO E SE POSSUI 11 CARACTERES
        if (is_null($this->cestClieCpf) || trim($this->cestClieCpf) == "") {
            $this->adicionaMensagem("Insira o número do seu CPF!");
            $dadosOk = false;
        } else {
            if (is_numeric($this->cestClieCpf)) {
                if (strlen($this->cestClieCpf) != 11) {
                    $this->adicionaMensagem(("Insira um CPF válido! (11 dìgitos)"));
                    $dadosOk = false;
                } else {
                    //continua
                }
            }
        }
    }

}
