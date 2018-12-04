<?php

require_once 'adopdoabstract.class.php';

class ClienteAdo extends AdoPdoAbstract {

    function __construct() {
        parent::__construct();
        parent::setNomeDaTabela("Clientes");
    }

    public function alteraObjeto(ModelAbstract $clienteModel) {
        $query = "UPDATE {$this->getNomeDaTabela()} SET clieCpf = ?, clieNome = ?, clieRg = ?, clieUfRg = ?, clieRgDtExpedicao = ?, clieEndereco = ?, clieCep = ?, clieFone = ?, clieEmail = ?, clieSenha = ?";

        return $this->executaPs($query, array($clienteModel->getClieCpf(), $clienteModel->getClieNome(), $clienteModel->getClieRg(), $clienteModel->getClieUfRg(), $clienteModel->getClieRgDtExpedicao(), $clienteModel->getClieEndereco(), $clienteModel->getClieCep(), $clienteModel->getClieFone(), $clienteModel->getClieEmail(), $clienteModel->getClieSenha()));
    }

    public function excluiObjeto(ModelAbstract $clienteModel) {
        $query = "DELETE FROM {$this->getNomeDaTabela()} WHERE clieCpf = ?";

        return $this->executaPs($query, array($clienteModel->getClieCpf()));
    }

    public function insereObjeto(ModelAbstract $clienteModel) {
        $query = "INSERT INTO {$this->getNomeDaTabela()} (clieCpf, clieNome, clieRg, clieUfRg, clieRgDtExpedicao, clieEndereco, clieCep, clieFone, clieEmail, clieSenha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

        return $this->executaPs($query, array($clienteModel->getClieCpf(), $clienteModel->getClieNome(), $clienteModel->getClieRg(), $clienteModel->getClieUfRg(), $clienteModel->getClieRgDtExpedicao(), $clienteModel->getClieEndereco(), $clienteModel->getClieCep(), $clienteModel->getClieFone(), $clienteModel->getClieEmail(), $clienteModel->getClieSenha()));
    }
    

    public function buscaCliente($clieEmail) {
        $query = "SELECT * FROM {$this->getNomeDaTabela()} where clieEmail = ?";

        $executou = parent::executaPs($query, array($clieEmail));
        if ($executou) {
            if (parent::qtdeLinhas() === 0) {
                return 0;
            }
        } else {
            return false;
        }

        $leu = $objetoBD = $this->leTabelaBD();
        if ($leu) {
            //continua...
        } else {
            return FALSE;
        }
        //montar clienteModel
        return new ClienteModel($objetoBD['clieCpf'], $objetoBD['clieNome'], $objetoBD['clieRg'], $objetoBD['clieUfRg'], $objetoBD['clieRgDtExpedicao'], $objetoBD['clieEndereco'], $objetoBD['clieCep'], $objetoBD['clieFone'], $objetoBD['clieEmail'], $objetoBD['clieSenha']);
    }

    public function buscaClientePeloLogin($clienteModel) {
        $executou = $this->consultaClientePeloLogin($clienteModel);
        if ($executou) {
            //continua
        } else {
            return $executou;
        }

        $leu = $objetoBD = $this->leTabelaBD(5);

        if ($leu) {
            //continua...
        } else {
            return FALSE;
        }

        //montar clienteModel
        return new ClienteModel($objetoBD->clieCpf, $objetoBD->clieNome, $objetoBD->clieRg, $objetoBD->clieUfRg, $objetoBD->clieRgDtExpedicao, $objetoBD->clieEndereco, $objetoBD->clieCep, $objetoBD->clieFone, $objetoBD->clieEmail, $objetoBD->clieSenha);
    }

    public function consultaClientePeloLogin($clienteModel) {
        $query = "SELECT * FROM {$this->getNomeDaTabela()} where clieCpf = ? and clieSenha = ?";

        $executou = parent::executaPs($query, array($clienteModel->getClieCpf(), $clienteModel->getClieSenha()));
        if ($executou) {
            if (parent::qtdeLinhas() === 0) {
                return 0;
            }
            return true;
        } else {
            return false;
        }
    }

}
