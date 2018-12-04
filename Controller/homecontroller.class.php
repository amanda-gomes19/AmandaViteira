<?php

require_once '../ADO/produtosdacestaado.class.php';
require_once '../View/produtoshomeview.class.php';
require_once '../ADO/produtoado.class.php';
require_once '../Model/produtomodel.class.php';
require_once '../Model/produtosdascestamodel.class.php';

class HomeController {

    private $produtosDaCestaAdo = null;
    private $produtoado = null;
    private $produtoHomeView = null;
    private $produtosdacestamodel = null;
    private $acao = null;
    private $produtomodel = null;

    function __construct() {

        $this->produtosDaCestaAdo = new ProdutosDaCestaAdo();
        $this->produtoado = new ProdutoAdo();
        $this->produtosdacestamodel = new ProdutosDasCestaModel();
        $this->produtomodel = new ProdutoModel();
        $this->produtoHomeView = new ProdutosHomeView();
        $this->acao = $this->produtoHomeView->getBt();


        session_start();
        if (isset($_SESSION["clieCpf"])) {
            $aux = $_SESSION["clieCpf"];
            switch ($this->acao) {
                case "incCesta":
                    $this->incluiProdutoNaCesta($aux);

                    break;

                default:
                    break;
            }
        } else {
            $this->produtoHomeView->adicionaMensagem("Faça login novamente");
            return;
        }

        $this->produtoHomeView->displayInterface("Home", $this->produtosdacestamodel, $this->acao);
    }

    private function incluiProdutoNaCesta($aux) {
        $this->produtosdacestamodel = $this->produtoHomeView->recebeDadosDoFormulario($aux);
        var_dump($this->produtosdacestamodel);
        $inseriu = $this->produtosDaCestaAdo->insereObjeto($this->produtosdacestamodel);

        if ($inseriu) {

            $this->produtoHomeView->adicionaMensagem("Produto adicionado com sucesso!");
        } else {
            $this->produtoHomeView->adicionaMensagem("Deu ruim!");
        }
    }

}
