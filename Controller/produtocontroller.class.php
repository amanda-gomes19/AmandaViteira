<?php

require_once '../ADO/produtoado.class.php';
require_once '../ADO/fornecedorado.class.php';
require_once '../ADO/fornecedordeprodutoado.class.php';
require_once '../Model/fornecedormodel.class.php';
require_once '../Model/produtomodel.class.php';
require_once '../Model/fornecedordeprodutomodel.class.php';
require_once '../View/produtoview.class.php';
require_once '../View/produtoviewalteracao.class.php';


class ProdutoController {

    private $produtoAdo = null;
    private $produtoModel = null;
    private $produtoView = null;
    private $acao = null;

    function __construct() {
        $this->produtoAdo = new ProdutoAdo();
        $this->produtoModel = new ProdutoModel();
        $this->produtoView = new ProdutoView();
        $this->acao = $this->produtoView->getBt();

        switch ($this->acao) {
            case "inc":
                $this->inclui();

                break;

            case "con":
                $this->consulta();

                break;

            case "alt":
                $this->altera();

                break;

            case "exc":
                $this->exclui();

                break;

            case "incforn":
                $this->incluirFornecedor();
                break;

            case "excluirF":
                $this->apagarFornecedor();
                break;

            default:
                break;
        }

        $this->produtoView->displayInterface("Cadastro de Produtos", $this->produtoModel, $this->acao);
    }

    private function consulta() {
        $this->produtoModel = $this->produtoView->recebeDadosDaConsulta();
        $buscou = $produtoModel = $this->produtoAdo->buscaProduto($this->produtoModel->getProdId());
        
        
        if ($buscou) {
            $this->produtoModel = $produtoModel;
        } else {
            if ($buscou === 0) {
                $this->produtoView->adicionaMensagem("Não encontrou o produto escolhido.");
            } else {
                $this->produtoView->adicionaMensagem("Não foi possivel buscar os dados! Contate o responsável pelo sistema.");
            }
        }
    }

    private function inclui() {
        $this->produtoModel = $this->produtoView->recebeDadosDoFormulario();

        $checagemOk = $this->produtoModel->checaAtributos();
        
        if ($checagemOk) {
            $inseriu = $this->produtoAdo->insereObjeto($this->produtoModel);
            if ($inseriu) {
                $this->produtoView->adicionaMensagem("Foi!");
                $this->produtoModel = new ProdutoModel();

                $this->acao = "con";
            } else {
                $this->produtoView->adicionaMensagem("Deu ruim!");
            }
        } else {

            $this->produtoView->adicionaMensagens($this->produtoModel->getMensagens());
        }
    }

    private function altera() {
        $this->produtoModel = $this->produtoView->recebeDadosDoFormulario();
        $checagemOk = true;

        if ($checagemOk) {
            $inseriu = $this->produtoAdo->alteraObjeto($this->produtoModel);
            if ($inseriu) {
                $this->produtoView->adicionaMensagem("Alterado com Sucesso!");
                $this->produtoModel = new ProdutoModel();
                ;

                $this->acao = "nov";
            } else {
                $this->produtoView->adicionaMensagem("Erro na Alteração!");
            }
        } else {
            $this->produtoView->adicionaMensagens($this->produtoModel->getMensagens());
        }
    }

    private function exclui() {
        $this->produtoModel = $this->produtoView->recebeDadosDoFormulario();
        $checagemOk = true;
        if ($checagemOk) {
            $inseriu = $this->produtoAdo->excluiObjeto($this->produtoModel);
            if ($inseriu) {
                $this->produtoView->adicionaMensagem("Excluido com Sucesso!");
                $this->produtoModel = new ProdutoModel();

                $this->acao = "nov";
            } else {
                $this->produtoView->adicionaMensagem("Erro na Exclusão!");
            }
        } else {
            $this->produtoView->adicionaMensagens($this->produtoModel->getMensagens());
        }
    }
    private function incluirFornecedor() {
        $this->consulta();
        $dados = $this->produtoView->recebeDadosAssociacao();

        $fornecedorDeProdutoAdo = new FornecedorDeProdutoAdo();

        if ($dados['fornCnpj'] == -1) {
            $this->produtoView->adicionaMensagem("Selecione um fornecedor para realizar a associação!");
            return;
        }
        $fornecedorDeProduto = new FornecedorDeProdutoModel($dados["fornCnpj"], $dados["prodId"]);
        
        $incluiu = $fornecedorDeProdutoAdo->insereObjeto($fornecedorDeProduto);
        if ($incluiu) {
            $this->produtoView->adicionaMensagem("Fornecedor associado com sucesso!");
            return;
        } else {
            $this->produtoView->adicionaMensagem("Não foi possível associar esse fornecedor.");
        }

    }

    private function apagarFornecedor() {
        $this->consulta();

        $fornecedorDeProdutoAdo = new FornecedorDeProdutoAdo();

        $dados                    = $this->produtoView->recebeDadosParaAPagarFornecedor();
        $fornecedorDeProdutoModel = new FornecedorDeProdutoModel($dados["fornCnpj"], $dados["prodId"]);

        $removeu = $fornecedorDeProdutoAdo->excluiObjeto($fornecedorDeProdutoModel);

        if ($removeu) {
            $this->produtoView->adicionaMensagem("Fornecedor apagado com sucesso!");
            return;
        } else {
            $this->produtoView->adicionaMensagem("Não foi possível apagar esse fornecedor.");
        }

    }

}
