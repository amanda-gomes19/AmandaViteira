<?php

require_once '../ADO/produtosdacestaado.class.php';
require_once '../View/produtoshomeview.class.php';
require_once '../Model/produtosdascestamodel.class.php';

class HomeController {

    private $produtosDaCestaAdo = null;
    private $produtoHomeView = null;
    private $produtosdacestamodel = null;
    private $acao = null;

    function __construct() {

        $this->produtosDaCestaAdo = new ProdutosDaCestaAdo();
        $this->produtosdacestamodel = new ProdutosDasCestaModel();
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
            $this->produtoHomeView->adicionaMensagem("Faça login novamente");
            return;
        }
        
        $this->produtoHomeView->displayInterface("Home", $this->produtosdacestamodel, $acao);
    }
    
    private function incluiProdutoNaCesta($produtoDaCestaModel) {
        
        $inseriu = $this->produtosDaCestaAdo->insereObjeto($produtosDaCestaModel);
        
        if ($inseriu) {
            $this->produtoHomeView->adicionaMensagem("Produto adicionado com sucesso!");
            
        }else{
            $this->produtoHomeView->adicionaMensagem("Deu ruim!");
        }
        
        
    }

}
