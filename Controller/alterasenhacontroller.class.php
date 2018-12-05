<?php

class AlteraSenhaController {
    
   private $alteraSenhaView = null;
   private $clienteModel = null;
   private $clienteAdo = null;
   
   private $acao;
   
   function __construct() {
       $this->alteraSenhaView =  new AlteraSenhaView();
       $this->clienteModel = new ClienteModel();
       $this->clienteAdo = new ClienteAdo();
       
       $acao = $this->loginView->getBt();
       
       switch ($acao) {
                          
            case "altSenha":
                $this->alteraSenha();

                break;
            case "altDados":
                $this->alteraDados();
                
                break;

           default:
               break;
       }
       
       $this->alteraSenhaView->displayInterface("Alteração de Senha", $this->clienteModel, $acao);
   }
   
      
    private function alteraSenha() {
        $clienteModel = $this->loginView->recebeDadosDoFormulario();
        $buscou = $this->clienteModel = $this->clienteAdo->buscaClientePeloLogin($clienteModel);
        
        if($buscou){
            session_start();
            $_SESSION["clieCpf"]= $this->clienteModel->getClieCpf();
            header("Location: home.php");
        }
    }
    

}
