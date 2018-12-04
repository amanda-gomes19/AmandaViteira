<?php

require_once '../ADO/produtosdacestaado.class.php';
require_once '../ADO/cestadecompraado.class.php';
require_once '../Model/cestadecompramodel.class.php';
require_once '../Model/produtosdascestamodel.class.php';
require_once '../View/cestadecomprasview.class.php';

class CestaDeCompraController {

    private $cestaDeCompraView = null;
    private $cestaDeCompraModel = null;
    private $produtoDaCestaModel = null;
    private $cestaDeCompraAdo = null;
    private $produtosDaCestaAdo = null;
    private $acao = null;

    function __construct() {

        $this->cestaDeCompraAdo = new CestaDeCompraAdo();
        $this->produtosDaCestaAdo = new ProdutosDaCestaAdo();
        $this->cestaDeCompraModel = new CestaDeCompraModel();
        $this->produtoDaCestaModel = new ProdutosDaCestaAdo();
        $this->cestaDeCompraView = new CestaDeComprasView();
        $this->acao = $this->cestaDeCompraView->getBt();


        session_start();
        if (isset($_SESSION["clieCpf"])) {
            $aux = $_SESSION["clieCpf"];
            switch ($this->acao) {
                case "ret":
                    $this->retiraProdutoDaCesta($aux);
                    break;

                default:
                    break;
            }
        } else {
            $this->cestaDeCompraView->adicionaMensagem("Faça login novamente");
            return;
        }

        $this->cestaDeCompraView->displayInterface("Cesta de Compras", $this->cestaDeCompraView, $this->acao);
    }

    private function retiraProdutoDaCesta($aux) {
        $this->produtoDaCestaModel = $this->cestaDeCompraView->recebeProdutosDaCesta($aux);
        $retirou = $this->produtosDaCestaAdo->excluiObjeto($this->produtoDaCestaModel);
        if ($retirou) {
            
            $this->cestaDeCompraView->adicionaMensagem("O produto foi excluído da sua cesta com sucesso!");
        } else {
           $this->cestaDeCompraView->adicionaMensagem("Não foi possível excluir o produto da sua cesta!");
        }

    }

}
