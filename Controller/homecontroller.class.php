<?php

require_once '../ADO/produtosdacestaado.class.php';
require_once '../View/produtoshomeview.class.php';

class HomeController {

    private $produtosDaCesta = null;
    private $produtoHomeView = null;
    private $acao = null;

    function __construct() {

        $this->produtosDaCesta = new ProdutosDaCestaAdo();
        $this->produtoHomeView = new ProdutosHomeView();
        $this->acao = $this->produtoHomeView->getBt();
        session_start();
        if (isset($_SESSION["clieCpf"])) {
            $aux = $_SESSION["clieCpf"];
            switch ($this->acao) {
                case "incCesta":


                    break;

                default:
                    break;
            }
        } else {
            $this->cestaDeCompraView->adicionaMensagem("Faça login novamente");
            return;
        }
    }
    
    private function incluiProdutoNaCesta($produtoDaCestaModel) {
        
        $inseriu = $this->produtosDaCesta->insereObjeto($produtosDaCestaModel);
        
        if ($inseriu) {
            $this->produtoHomeView->adicionaMensagem("Produto adicionado com sucesso!");
            
        }else{
            $this->produtoHomeView->adicionaMensagem("Deu ruim!");
        }
        
        
    }

}
