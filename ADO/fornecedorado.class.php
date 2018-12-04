<?php

require_once 'adopdoabstract.class.php';
require_once '../View/interfacehtml.class.php';

class FornecedorAdo extends AdoPdoAbstract {
    
    function __construct() {
        parent::__construct();
        parent::setNomeDaTabela("Fornecedores");
        
    }

    
    public function alteraObjeto(\ModelAbstract $objetoModel) {
        $query = "UPDATE Fornecedores SET fornNome = ?, fornEmail = ?, fornFone1 = ?, fornFone2 = ?, fornEnd = ?, fornCep = ?, fornCidade = ?, fornUf = ? WHERE fornCnpj = ? ";

        $arrayDeValores = array($clienteModel->getClieNome(),  $fornecedorModel->getFornEmail(), $fornecedorModel->getFornFone1(), $fornecedorModel->getFornFone2(), $fornecedorModel->getFornEnd(), $fornecedorModel->getFornCep(), $fornecedorModel->getFornCidade(), $fornecedorModel->getFornUf(), $fornecedorModel->getFornCnpj());

        return $this->executaPs($query, $arrayDeValores);
        
    }
    
    //METODO QUE VAI EXCLUIR UM FORNECEDOR DA TABELA FORNECEDOR NO BANCO DE DADOS
    public function excluiObjeto(\ModelAbstract $fornecedorModel) {
           $query = "DELETE FROM Fornecedores WHERE fornCnpj = ?";
        return parent::executaPs($query, array($fornecedorModel->getFornCnpj()));

    }

    //METODO QUE VAI INSERIR UM FORNECEDOR À TABELA FORNECEDOR NO BANCO DE DADOS
    public function insereObjeto(ModelAbstract $fornecedorModel) {
         $query = "INSERT INTO Fornecedores(fornCnpj, fornNome, fornEmail, fornFone1, fornFone2, fornEnd, fornCep, fornCidade, fornUf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return parent::executaPs($query, array($fornecedorModel->getFornCnpj(), $fornecedorModel->getFornNome(), $fornecedorModel->getFornEmail(), $fornecedorModel->getFornFone1(), $fornecedorModel->getFornFone2(), $fornecedorModel->getFornEnd(), $fornecedorModel->getFornCep(), $fornecedorModel->getFornCidade(), $fornecedorModel->getFornUf()));
    }
    
      public function buscaFornecedor($fornCNPJ) {
        $query = "SELECT * FROM Fornecedores where fornCnpj = ?";

        $executou = parent::executaPs($query, array($fornCNPJ));
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

        return new FornecedorModel($objetoBD['fornCnpj'], $objetoBD['fornNome'], $objetoBD['fornEmail'], $objetoBD['fornFone1'], $objetoBD['fornFone2'], $objetoBD['fornEnd'],  $objetoBD['fornCep'], $objetoBD['fornCidade'], $objetoBD['fornUf']);
    }

    public function buscaTodosOsFornecedores() {
        try {
            $fornecedorModel = $this->buscaArrayObjetoComPs(array(), 1, "order by fornNome");
        } catch (Exception $e) {
            throw new Exception($e->getMensagem());
        }

        return $fornecedorModel;
    }

    public function buscaFornecedoresDeProdutos($prodId) {
        $query = "SELECT fornCnpj, fornNome FROM Fornecedores WHERE fornCNPJ NOT IN (SELECT fproFornCNPJ FROM FornecedoresDeProdutos WHERE fproProdId = ?)";
        $buscou = parent::executaPs($query, array($prodId));
        if ($buscou) {
            if (parent::qtdeLinhas() == 0) {
                return 0;
            }
        } else {
            return false;
        }

        $fornecedores = array();
        while ($objetoBd = parent::leTabelaBD()) {
            $fornecedores[] = new FornecedorModel($objetoBd['fornCnpj'], $objetoBd['fornNome']);
        }
        return $fornecedores;
    }

    public function buscaFonecedoresAssociados($prodId) {
        $query = "SELECT fornCnpj, fornNome FROM Fornecedores INNER JOIN FornecedoresDeProdutos ON fornCnpj = fproFornCnpj INNER JOIN Produtos ON fproProdId = prodId WHERE prodId = ?";
        $buscou = parent::executaPs($query, array($prodId));

        if ($buscou) {
            if (parent::qtdeLinhas() == 0) {
                return 0;
            }
        } else {
            return false;
        }

        $fornecedores = array();
        while ($objetoBd = parent::leTabelaBD()) {
            $fornecedores[] = new FornecedorModel($objetoBd['fornCnpj'], $objetoBd['fornNome']);
        }
        return $fornecedores;
    }

}



