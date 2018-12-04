<?php

require_once '../View/clienteview.class.php';
require_once '../ADO/clienteado.class.php';
require_once '../Model/clientemodel.class.php';

class ClienteController {
    private $clienteAdo = null;
    private $clienteModel = null;
    private $clienteView = null;
    
    function __construct() {
        $this->clienteAdo = new ClienteAdo();
        $this->clienteModel = new ClienteModel();
        $this->clienteView = new ClienteView();
        
        $acao = $this->clienteView->getBt();
        
        switch ($acao) {
            case "cad":
                $this->cadastra();

                break;

            default:
                break;
        }
        
        $this->clienteView->displayInterface("Cadastro de Clientes", $this->clienteModel, $acao);
    }
    
    private function cadastra() {
        $this->clienteModel = $this->clienteView->recebeDadosDoFormulario();
        
        $checagemOk = $this->clienteModel->checaAtributos();
        if($checagemOk){
            //continua
        }else{
            $this->clienteView->adicionaMensagens($this->clienteModel->getMensagens());
            return;
        }
        
        $inseriu = $this->clienteAdo->insereObjeto($this->clienteModel);
        if ($inseriu) {
            $this->clienteView->adicionaMensagem("Deu Certo!!");
            
        }else{
            $this->clienteView->adicionaMensagem("Deu Errado!!");
        }
    }

}
