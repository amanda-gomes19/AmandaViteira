<?php

require_once '../ADO/produtosdacestaado.class.php';
require_once '../ADO/cestadecompraado.class.php';
require_once '../Model/cestadecompramodel.class.php';
require_once '../View/cestadecomprasview.class.php';

class CestaDeCompraController{
    private $cestaDeCompraView = null;
    private $cestaDeCompraModel = null;
    private $cestaDeCompraAdo = null;
    private $acao = null;

    
    function __construct() {
        
        $this->cestaDeCompraAdo = new CestaDeCompraAdo();
        $this->cestaDeCompraModel = new CestaDeCompraModel();
        $this->cestaDeCompraView = new CestaDeComprasView();
        $this->acao = $this->cestaDeCompraView->getBt();
        
        switch ($this->acao) {
            case "ret":
                $this->retiraProdutoDaCesta();
                break;

            default:
                break;
        }
        
        session_start();
        if (isset($_SESSION["clieCpf"])) {
            $aux = $_SESSION["clieCpf"];
        } else {
            $this->cestaDeCompraView->adicionaMensagem("Faça login novamente");
            return;
        }
        
    }
    
    private function retiraProdutoDaCesta() {
        $produtosDaCesta = $this->cestaDeCompraView->recebeProdutosDaCompra();
        $dadosok = $produtosDaCesta->checaAtributos();
        if ($dadosok) {
            //continua...
        } else {
            $this->cestaDeCompraView->adicionaMensagem($produtosDaCesta->getMensagens());
            return;
        }
        
        
        $produtosDaCestaAdo = new ProdutosDaCestaAdo();
        $cestaDeCompraView = new CestaDeCompraView();
      
       
        $excluiu = $produtosDaCestaAdo->excluiObjeto($produtosDaCesta);

        if ($excluiu) {
            $this->cestaDeCompraView->adicionaMensagem("O produto foi excluído da sua cesta com sucesso!");
//            $this->cestaDeCompraModel = new CestaDeCompraModel();
//            $this->acao = "nov";
        } else {
            $this->cestaDeCompraView->adicionaMensagem("Não foi possível excluir o produto da sua cesta!");
        }
    }

}