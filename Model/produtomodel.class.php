<?php

require_once 'modelabstract.class.php';

class ProdutoModel extends ModelAbstract {

    private $prodId; //int
    private $prodNome; //varchar(45)
    private $prodValor; //float
    private $prodQtde; //int

    function __construct($prodId = null, $prodNome = null, $prodValor = null, $prodQtde = null) {
        $this->prodNome = $prodNome;
        $this->prodId = $prodId;
        $this->prodValor = $prodValor;
        $this->prodQtde = $prodQtde;
    }

    function getProdId() {
        return $this->prodId;
    }

    function getProdNome() {
        return $this->prodNome;
    }

    function getProdValor() {
        return $this->prodValor;
    }

    function getProdQtde() {
        return $this->prodQtde;
    }

    function setProdId($prodId) {
        $this->prodId = $prodId;
    }

    function setProdNome($prodNome) {
        $this->prodNome = $prodNome;
    }

    function setProdValor($prodValor) {
        $this->prodValor = $prodValor;
    }

    function setProdQtde($prodQtde) {
        $this->prodQtde = $prodQtde;
    }

    public function checaAtributos() {
        $dadosOk = true;

        if (is_null($this->prodNome) || trim($this->prodNome) == "") {
            $this->adicionaMensagem("Insira o nome do produto!");
            $dadosOk = false;
        } else {
            if (strlen($this->prodNome) > 45) {
                $this->adicionaMensagem("Insira o nome do produto contendo até 45 caracteres!");
                $dadosOk = false;
            }
        }

        if (is_null($this->prodValor) || trim($this->prodValor) == "") {
            $this->adicionaMensagem("Insira o valor do produto!");
            $dadosOk = false;
        } else {
            if (is_numeric($this->prodValor)) {
                //continua
            }else{
                $this->adicionaMensagem("Insira apenas números no valor do produto");
                $dadosOk = false;
            }
        }

        if (is_null($this->prodQtde) || trim($this->prodQtde) == "") {
            $this->adicionaMensagem("Insira a quantidade de produtos!");
            $dadosOk = false;
        } else {
            if (!is_numeric($this->prodQtde)) {
                $dadosOk = false;
            }
        }

        return $dadosOk;
    }

}
