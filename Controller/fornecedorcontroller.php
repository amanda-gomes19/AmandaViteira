<?php

require_once '../ADO/fornecedorado.class.php';
require_once '../Model/fornecedormodel.class.php';
require_once '../View/fornecedorview.class.php';

class FornecedorController {

    private $fornecedorView = null;
    private $fornecedorModel = null;
    private $fornecedorAdo = null;
    
    private $acao = null;

    public function __construct() {
        $this->fornecedorAdo = new FornecedorAdo();
        $this->fornecedorModel = new FornecedorModel();

        $this->fornecedorView = new FornecedorView();

        $this->acao = $this->fornecedorView->getBt();

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

            default:
                break;
        }

        $this->fornecedorView->displayInterface("Cadastro de Fornecedores", $this->fornecedorModel, $this->acao);
    }

    private function consulta() {
        $this->fornecedorModel = $this->fornecedorView->recebeDadosDaConsulta();

        $buscou = $fornecedorModel = $this->fornecedorAdo->buscaFornecedor($this->fornecedorModel->getFornCnpj());

        if ($buscou) {
            $this->fornecedorModel = $fornecedorModel;
        } else {
            if ($buscou === 0) {
                $this->fornecedorView->adicionaMensagem("Não encontrou o fornecedor escolhido.");
            } else {
                $this->fornecedorView->adicionaMensagem("Não foi possivel buscar os dados! Contate o responsável pelo sistema.");
            }
        }
    }

    private function inclui() {
        $this->fornecedorModel = $this->fornecedorView->recebeDadosDoFormulario();

        $checagemOk = $this->fornecedorModel->checaAtributos();
       
        if ($checagemOk) {
            $inseriu = $this->fornecedorAdo->insereObjeto($this->fornecedorModel);
            if ($inseriu) {
                $this->fornecedorView->adicionaMensagem("Foi!");
                $this->fornecedorModel = new FornecedorModel();
                
                $this->acao = "nov";
            } else {
                $this->fornecedorView->adicionaMensagem("Deu ruim!");
            }
        } else {
            $this->fornecedorView->adicionaMensagens($this->fornecedorModel->getMensagens());
        }
    }

    private function altera() {
        $this->fornecedorModel = $this->fornecedorView->recebeDadosDoFormulario();
        $checagemOk = true;

        if ($checagemOk) {
            $inseriu = $this->fornecedorAdo->alteraObjeto($this->fornecedorModel);
            if ($inseriu) {
                $this->fornecedorView->adicionaMensagem("Alterado com Sucesso!");
                $this->fornecedorModel = new FornecedorModel();
                
                $this->acao = "nov";
            } else {
                $this->fornecedorView->adicionaMensagem("Erro na Alteração!");
            }
        } else {
            $this->fornecedorView->adicionaMensagens($this->fornecedorModel->getMensagens());
        }
    }

    private function exclui() {
        $this->fornecedorModel = $this->fornecedorView->recebeDadosDoFormulario();
        $checagemOk = true;
        if ($checagemOk) {
            $inseriu = $this->fornecedorAdo->excluiObjeto($this->fornecedorModel);
            if ($inseriu) {
                $this->fornecedorView->adicionaMensagem("Exluido com Sucesso!");
                $this->fornecedorModel = new FornecedorModel();
                
                $this->acao = "nov";
            } else {
                $this->fornecedorView->adicionaMensagem("Erro na Exclusão!");
            }
        } else {
            $this->fornecedorView->adicionaMensagens($this->fornecedorModel->getMensagens());
        }
    }

}