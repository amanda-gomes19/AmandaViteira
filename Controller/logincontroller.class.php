<?php

require_once '../ADO/clienteado.class.php';
require_once '../Model/clientemodel.class.php';
require_once '../View/loginview.class.php';

class LoginController {

    private $loginView = null;
    private $clienteModel = null;
    private $clienteAdo = null;

    public function __construct() {
        $this->clienteAdo = new ClienteAdo();
        $this->clienteModel = new ClienteModel();

        $this->loginView = new LoginView();

        $acao = $this->loginView->getBt();

        switch ($acao) {
            case "loga":
                $this->loga();

                break;

            default:
                break;
        }

        $this->loginView->displayInterface("Login", $this->clienteModel, $acao);
    }
    
     private function loga() {
        $clienteModel    = $this->loginView->recebeDadosDoFormulario();
        $buscou       = $this->clienteModel = $this->clienteAdo->buscaClientePeloLogin($clienteModel);
        if ($buscou) {
            session_start();
            $_SESSION["clieCpf"]= $this->clienteModel->getClieCpf();
            header("Location: home.php");
        } else {
            $this->clienteModel = new ClienteModel();
            if ($buscou === 0) {
                $this->loginView->adicionaMensagem("Esse CPF não foi encontrado! Tente novamente.");
            } else {
                $this->loginView->adicionaMensagem("Ocorreu um erro ao tentar logar! Contate o responsável pelo sistema.");
            }
        }
    }
}
    