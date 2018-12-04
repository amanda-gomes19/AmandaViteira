<?php

require_once 'adopdoabstract.class.php';

class FornecedorDeProdutoAdo extends AdoPdoAbstract {

    public function __construct() {
        parent::__construct();
        parent::setNomeDaTabela("FornecedoresDeProdutos");
    }

    public function alteraObjeto(ModelAbstract $fornecedorDeProdutoModel) {
        
    }

    public function excluiObjeto(ModelAbstract $fornecedorDeProdutoModel) {
        $query = "DELETE FROM FornecedoresDeProdutos WHERE fproFornCnpj = ? and fproProdId = ?";
        return parent::executaPs($query, array($fornecedorDeProdutoModel->getFproFornCnpj(), $fornecedorDeProdutoModel->getFproProdId()));
    }

    public function insereObjeto(ModelAbstract $fornecedorDeProdutoModel) {
        $query = "INSERT INTO FornecedoresDeProdutos(fproFornCnpj, fproProdId) VALUES (?, ?)";
        return parent::executaPs($query, array($fornecedorDeProdutoModel->getFproFornCnpj(), $fornecedorDeProdutoModel->getFproProdId()));
    }

}
