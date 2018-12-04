<?php

require_once 'modelabstract.class.php';

class ClienteModel extends ModelAbstract {

    private $clieNome;
    private $clieCpf;
    private $clieRg;
    private $clieUfRg;
    private $clieRgDtExpedicao;
    private $clieEndereco;
    private $clieCep;
    private $clieFone;
    private $clieEmail;
    private $clieSenha;

    function __construct( $clieCpf = null, $clieNome = null, $clieRg = null, $clieUfRg = null, $clieRgDtExpedicao = null, $clieEndereco = null, $clieCep = null, $clieFone = null, $clieEmail = null, $clieSenha = null) {
        $this->clieCpf = $clieCpf;
        $this->clieNome = $clieNome;
        $this->clieRg = $clieRg;
        $this->clieUfRg = $clieUfRg;
        $this->clieRgDtExpedicao = $clieRgDtExpedicao;
        $this->clieEndereco = $clieEndereco;
        $this->clieCep = $clieCep;
        $this->clieFone = $clieFone;
        $this->clieEmail = $clieEmail;
        $this->clieSenha = $clieSenha;
    }

    function getClieNome() {
        return $this->clieNome;
    }

    function getClieCpf() {
        return $this->clieCpf;
    }

    function getClieRg() {
        return $this->clieRg;
    }

    function getClieUfRg() {
        return $this->clieUfRg;
    }

    function getClieRgDtExpedicao() {
        return $this->clieRgDtExpedicao;
    }

    function getClieFone() {
        return $this->clieFone;
    }

    function getClieEmail() {
        return $this->clieEmail;
    }

    function getClieEndereco() {
        return $this->clieEndereco;
    }

    function getClieCep() {
        return $this->clieCep;
    }

    function getClieSenha() {
        return $this->clieSenha;
    }

    function setClieNome($clieNome) {
        $this->clieNome = $clieNome;
    }

    function setClieCpf($clieCpf) {
        $this->clieCpf = $clieCpf;
    }

    function setClieRg($clieRg) {
        $this->clieRg = $clieRg;
    }

    function setClieUfRg($clieUfRg) {
        $this->clieUfRg = $clieUfRg;
    }

    function setClieRgDtExpedicao($clieRgDtExpedicao) {
        $this->clieRgDtExpedicao = $clieRgDtExpedicao;
    }

    function setClieFone($clieFone) {
        $this->clieFone = $clieFone;
    }

    function setClieEmail($clieEmail) {
        $this->clieEmail = $clieEmail;
    }

    function setClieEndereco($clieEndereco) {
        $this->clieEndereco = $clieEndereco;
    }

    function setClieCep($clieCep) {
        $this->clieCep = $clieCep;
    }

    function setClieSenha($clieSenha) {
        $this->clieSenha = $clieSenha;
    }

    public function checaAtributosLogin() {
        $dadosOk = true;
        
        //VERIFICA SE O EMAIL ESTA NULO OU VAZIO E SE POSSUI ATE 60 CARACTERES
        if (is_null($this->clieEmail) || trim($this->clieEmail) == "") {
            $this->adicionaMensagem("Insira seu email!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieEmail) > 60) {
                $this->adicionaMensagem("Insira um email válido!");
                $dadosOk = false;
            }
        }


        //VERIFICA SE A SENHA ESTA NULA OU VAZIA E SE POSSUI ATE 45 CARACTERES
        if (is_null($this->clieSenha) || trim($this->clieSenha) == "") {
            $this->adicionaMensagem("Insira a senha!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieSenha) > 45) {
                $this->adicionaMensagem("Insira a senha corretamente!");
                $dadosOk = false;
            }
        }
        
        return $dadosOk;
    }
    
    public function checaAtributos() {
        $dadosOk = true;


        //VERIFICA SE O CPF ESTA NULO OU VAZIO E SE POSSUI 11 CARACTERES
        if (is_null($this->clieCpf) || trim($this->clieCpf) == "") {
            $this->adicionaMensagem("Insira o número do seu CPF!");
            $dadosOk = false;
        } else {
            if (is_numeric($this->clieCpf)) {
                if (strlen($this->clieCpf) != 11) {
                    $this->adicionaMensagem(("Insira um CPF válido! (11 dìgitos)"));
                    $dadosOk = false;
                } else {
                    //continua
                }
            }
        }

        //VERIFICA SE O NOME ESTA NULO OU VAZIO E SE POSSUI ATE 45 CARACTERES
        if (is_null($this->clieNome) || trim($this->clieNome) == "") {
            $this->adicionaMensagem("Insira o número do seu nome!");
            $dadosOk = false;
        } else {
            if (is_numeric($this->clieNome)) {
                if (strlen($this->clieNome) > 45) {
                    $this->adicionaMensagem("Insira o nome corretamente! (até 45 caracteres)");
                    $dadosOk = false;
                }
            } else {
                //continua
            }
        }

        //VERIFICA SE O RG ESTA NULO OU VAZIO E SE POSSUI APENAS NUMEROS
        if (is_null($this->clieRg) || trim($this->clieRg) == "") {
            $this->adicionaMensagem("Insira o número do seu RG!");
            $dadosOk = false;
        } else {
            if (!is_numeric($this->clieRg)) {
                $this->adicionaMensagem("Insira apenas números para o RG!");
                $dadosOk = false;
            }
        }


        //VERIFICA SE O UF DO RG ESTA NULO OU VAZIO E SE POSSUI APENAS 2 CARACTERES
        if (is_null($this->clieUfRg) || trim($this->clieUfRg) == "") {
            $this->adicionaMensagem("Insira a Unidade Federativa do seu RG!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieUfRg) != 2) {
                $this->adicionaMensagem("Insira a Unidade Federativa do seu RG corretamente!");
                $dadosOk = false;
            }
        }

        //VERIFICA SE O ENDERECO ESTA NULO OU VAZIO E SE POSSUI ATE 45 CARACTERES
        if (is_null($this->clieEndereco) || trim($this->clieEndereco) == "") {
            $this->adicionaMensagem("Insira o endereço!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieEndereco) > 45) {
                $this->adicionaMensagem("Insira o endereço com até 45 caracteres!");
                $dadosOk = false;
            }
        }

        //VERIFICA SE O CEP ESTA NULO OU VAZIO E SE POSSUI ATE 8 CARACTERES
        if (is_null($this->clieCep) || trim($this->clieCep) == "") {
            $this->adicionaMensagem("Insira o CEP!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieCep) > 8) {
                $this->adicionaMensagem("Insira um CEP válido!(8 dígitos)");
                $dadosOk = false;
            }
        }


        //VERIFICA SE O FONE ESTA NULO OU VAZIO E SE POSSUI ATE 15 CARACTERES
        if (is_null($this->clieFone) || trim($this->clieFone) == "") {
            $this->adicionaMensagem("Insira o telefone! ");
            $dadosOk = false;
        } else {
            if (strlen($this->clieFone) > 15) {
                $this->adicionaMensagem("Insira um telefone válido! (15 dígitos)");
                $dadosOk = false;
            }
        }

        //VERIFICA SE O EMAIL ESTA NULO OU VAZIO E SE POSSUI ATE 60 CARACTERES
        if (is_null($this->clieEmail) || trim($this->clieEmail) == "") {
            $this->adicionaMensagem("Insira seu email!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieEmail) > 60) {
                $this->adicionaMensagem("Insira o email corretamente!(até 60 dígitos)");
                $dadosOk = false;
            }
        }


        //VERIFICA SE A SENHA ESTA NULA OU VAZIA E SE POSSUI ATE 45 CARACTERES
        if (is_null($this->clieSenha) || trim($this->clieSenha) == "") {
            $this->adicionaMensagem("Insira a senha!");
            $dadosOk = false;
        } else {
            if (strlen($this->clieSenha) > 45) {
                $this->adicionaMensagem("Insira uma senha valida! (até 45 caracteres)");
                $dadosOk = false;
            }
        }

        return $dadosOk;
    }

}
