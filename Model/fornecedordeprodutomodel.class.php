<?php

require_once 'modelabstract.class.php';

class FornecedorDeProdutoModel extends ModelAbstract {

    private $fproFornCnpj;
    private $fproProdId;
    function __construct($fproFornCnpj = null, $fproProdId = null) {
        parent::__construct();
        $this->fproFornCnpj = $fproFornCnpj;
        $this->fproProdId   = $fproProdId;
    }

    public function checaAtributos() {
        $dadosCorretos = true;

        return $dadosCorretos;
    }
    function getFproFornCnpj() {
        return $this->fproFornCnpj;
    }

    function getFproProdId() {
        return $this->fproProdId;
    }

    function setFproFornCnpj($fproFornCnpj) {
        $this->fproFornCnpj = $fproFornCnpj;
    }

    function setFproProdId($fproProdId) {
        $this->fproProdId = $fproProdId;
    }


}
