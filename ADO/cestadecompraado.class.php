<?php

require_once 'adopdoabstract.class.php';

class CestaDeCompraAdo extends AdoPdoAbstract {

    function __construct() {
        parent::__construct();
        parent::setNomeDaTabela("CestaDeCompras");
    }

    public function alteraObjeto(\ModelAbstract $objetoModel) {
        
    }

    public function excluiObjeto(\ModelAbstract $objetoModel) {
        
    }

    public function insereObjeto(\ModelAbstract $objetoModel) {
        
    }

    public function buscaProdutosDaCesta($clieCpf) {
        $query = "SELECT cestClieCpf, prodId, prodNome, prodQtde, prodValor FROM CestasDeCompras"
                . "INNER JOIN Produtos ON prodId = prceProdId"
                . "INNER JOIN ProdutosDasCestas ON prceCestClieCpf = cestClieCpf"
                . "WHERE cestClieCpf = ? ";

        $executou = parent::executaPs($query, array($clieCpf));

        if ($executou) {
            if ($this->qtdeLinhas() > 0) {
                //continue
            } else {
                return 0;
            }
        } else {
            return false;
        }

        $arrayProdutosDaCesta = array();

        while ($scProdutos = $this->leTabelaBD(5)) {
            $arrayProdutosDaCesta[] = $scProdutos;
        }

        return $arrayProdutosDaCesta;
    }

}
