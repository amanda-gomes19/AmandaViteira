<?php

require_once 'adopdoabstract.class.php';


class ProdutoAdo extends AdoPdoAbstract {

    function __construct() {
        parent::__construct();
    parent::setNomeDaTabela("Produtos");        
    }

    
    public function alteraObjeto(ModelAbstract $produtoModel) {
        $query = "UPDATE Produtos SET prodNome= ?, prodValor= ?, prodQtde= ? WHERE prodId = ? ";

        return $this->executaPs($query, array($produtoModel->getProdNome(), $produtoModel->getProdValor(), $produtoModel->getProdQtde(), $produtoModel->getProdId()));
    }

    public function excluiObjeto(ModelAbstract $produtoModel) {
        $query = "DELETE FROM Produtos WHERE prodId = ? ";

        return $this->executaPs($query, array($produtoModel->getProdId()));
    }

    public function insereObjeto(ModelAbstract $produtoModel) {
        $query = "INSERT INTO Produtos (prodId, prodNome, prodValor, prodQtde) values (?, ? , ?, ?) ";

        return $this->executaPs($query, array( $produtoModel->getProdId(), $produtoModel->getProdNome(), $produtoModel->getProdValor(), $produtoModel->getProdQtde()));
    }

    public function buscaProduto($prodId) {
        $query = "SELECT * FROM Produtos WHERE prodId = ?";

        $executou = parent::executaPs($query, array($prodId));
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

        return new Produtomodel($objetoBD['prodId'], $objetoBD['prodNome'], $objetoBD['prodValor'], $objetoBD['prodQtde']);
    }
    

    public function buscaTodosOsProdutos() {
        try {
            $produtoModel = $this->buscaArrayObjetoComPs(array(), 1, "order by prodNome");
        } catch (Exception $e) {
            throw new Exception($e->getMensagem());
        }

        return $produtoModel;
    }

}
