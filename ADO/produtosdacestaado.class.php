<?php

require_once 'adopdoabstract.class.php';

class ProdutosDaCestaAdo extends AdoPdoAbstract {

    public function __construct() {
        parent::__construct();
        parent::setNomeDaTabela("ProdutosDasCestas");
    }

    public function alteraObjeto(ModelAbstract $produtosDaCestaModel) {
        $query = "UPDATE {$this->getNomeDaTabela()} SET prodQtde= ? WHERE prceProdId = ? ";
  
        $arrayDeValores = array($produtosDaCestaModel->getProdQtde(), $produtosDaCestaModel->getPrceProdId() );

        return $this->executaPs($query, $arrayDeValores);
    }

    public function excluiObjeto(ModelAbstract $produtosDaCestaModel) {
        $query = "DELETE FROM {$this->getNomeDaTabela()} WHERE prceCestClieCpf = ? AND  prceProdId = ? ";

        return $this->executaPs($query, array($produtosDaCestaModel->getPrceCestClieCpf(), $produtosDaCestaModel->getPrceProdId()));
    }

    public function insereObjeto(ModelAbstract $produtosDaCestaModel) {
        $query = "INSERT INTO {$this->getNomeDaTabela()} (prceCestClieCpf, prceCestProdId) values (?,?) ";
        
        return $this->executaPs($query, array($produtosDaCestaModel->getPrceCestClieCpf(), $produtosDaCestaModel->getPrceProdId()));
    }

    public function buscaProdutoDaCesta($prceCestClieCpf) {
        $query = "SELECT * FROM {$this->getNomeDaTabela()} INNER JOIN  Produtos ON  prceProdId = prodId WHERE prceCestClieCpf = ?";

        $executou = parent::executaPs($query, array($prceCestClieCpf));
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

        return new ProdutoModel($objetoBD['prodId'], $objetoBD['prodNome'], $objetoBD['prodValor'], $objetoBD['prodQtde']);
    }

    public function buscaTodosOsProdutos() {
//        try {
//            $produtoModel = $this->buscaArrayObjetoComPs(array(), 1, "order by prodNome");
//        } catch (Exception $e) {
//            throw new Exception($e->getMensagem());
//        }
//
//        return $produtoModel;
    }

}

