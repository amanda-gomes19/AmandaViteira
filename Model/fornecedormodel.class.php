<?php

require_once 'modelabstract.class.php';

class FornecedorModel extends ModelAbstract {

    private $fornCnpj; //BIGINT
    private $fornNome; //varchar(45)
    private $fornEmail; //varchar(80)
    private $fornFone1; //varchar(15)
    private $fornFone2; //varchar(45)
    private $fornEnd; //varchar(100)
    private $fornCep; //varchar(10)
    private $fornCidade; //varchar(30)
    private $fornUf; //varchar(2)

    function __construct($fornCnpj = null, $fornNome = null, $fornEmail = null, $fornFone1 = null, $fornFone2 = null, $fornEnd = null, $fornCep = null, $fornCidade = null, $fornUf = null) {
        $this->fornCnpj = $fornCnpj;
        $this->fornNome = $fornNome;
        $this->fornEmail = $fornEmail;
        $this->fornFone1 = $fornFone1;
        $this->fornFone2 = $fornFone2;
        $this->fornEnd = $fornEnd;
        $this->fornCep = $fornCep;
        $this->fornCidade = $fornCidade;
        $this->fornUf = $fornUf;
    }

    function getFornCnpj() {
        return $this->fornCnpj;
    }

    function getFornNome() {
        return $this->fornNome;
    }

    function getFornEmail() {
        return $this->fornEmail;
    }

    function getFornFone1() {
        return $this->fornFone1;
    }

    function getFornFone2() {
        return $this->fornFone2;
    }

    function getFornEnd() {
        return $this->fornEnd;
    }

    function getFornCep() {
        return $this->fornCep;
    }

    function getFornCidade() {
        return $this->fornCidade;
    }

    function getFornUf() {
        return $this->fornUf;
    }

    function setFornCnpj($fornCnpj) {
        $this->fornCnpj = $fornCnpj;
    }

    function setFornNome($fornNome) {
        $this->fornNome = $fornNome;
    }

    function setFornEmail($fornEmail) {
        $this->fornEmail = $fornEmail;
    }

    function setFornFone1($fornFone1) {
        $this->fornFone1 = $fornFone1;
    }

    function setFornFone2($fornFone2) {
        $this->fornFone2 = $fornFone2;
    }

    function setFornEnd($fornEnd) {
        $this->fornEnd = $fornEnd;
    }

    function setFornCep($fornCep) {
        $this->fornCep = $fornCep;
    }

    function setFornCidade($fornCidade) {
        $this->fornCidade = $fornCidade;
    }

    function setFornUf($fornUf) {
        $this->fornUf = $fornUf;
    }

    public function checaAtributos() {
        $dadosOK = true;
        if (is_null($this->fornCnpj) || trim($this->fornCnpj == "")) {
            $this->adicionaMensagem("Insira o CNPJ!");
            $dadosOK = false;
        } else {
            if (is_numeric($this->fornCnpj)) {
                //continua...
            } else {
                $this->adicionaMensagem("Informe apenas números para o CNPJ!");
                $dadosOK = false;
            }
        }if (is_null($this->fornNome) || trim($this->fornNome == "")) {
            echo '1';
            $this->adicionaMensagem("Insira o Nome!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornNome) > 45) {
                echo '2';
                $this->adicionaMensagem("Insira o nome com até 45 caracteres!");
                $dadosOK = false;
            }
        }if (is_null($this->fornEmail) || trim($this->fornEmail == "")) {
            echo '3';
            $this->adicionaMensagem("Insira o Email!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornEmail) > 80) {
                $this->adicionaMensagem("Insira um email com até 80 caracteres!");
                $dadosOK = false;
            }
        }if (is_null($this->fornFone1) || trim($this->fornFone1 == "")) {
            $this->adicionaMensagem("Insira o telefone 1!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornFone1) > 15) {
                $this->adicionaMensagem("Insira um telefone com até 15 caracteres!");
                $dadosOK = false;
            }
        }

        if (strlen($this->fornFone2) > 15) {
            $this->adicionaMensagem("Insira um telefone com até 15 caracteres!");
            $dadosOK = false;
        }

        if (is_null($this->fornEnd) || trim($this->fornEnd == "")) {
            $this->adicionaMensagem("Insira o endereço!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornEnd) > 100) {
                $this->adicionaMensagem("Insira um endereço com até 100 caracteres!");
                $dadosOK = false;
            }
        }if (is_null($this->fornCep) || trim($this->fornCep == "")) {
            $this->adicionaMensagem("Insira o Cep!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornCep) > 10) {
                $this->adicionaMensagem("Insira um cep com até 10 caracteres!");
                $dadosOK = false;
            }
        }if (is_null($this->fornCidade) || trim($this->fornCidade == "")) {
            $this->adicionaMensagem("Insira a cidade!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornCidade) > 30) {
                $this->adicionaMensagem("Insira uma cidade com até 30 caracteres!");
                $dadosOK = false;
            }
        }if (is_null($this->fornUf) || trim($this->fornUf == "")) {
            $this->adicionaMensagem("Insira a Unidade Federativa!");
            $dadosOK = false;
        } else {
            if (strlen($this->fornUf) > 2) {
                $this->adicionaMensagem("Insira uma unidade federativa com até 2 caracteres!");
                $dadosOK = false;
            }
        }

        return $dadosOK;
    }

}
