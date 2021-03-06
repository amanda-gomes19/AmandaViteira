<?php

require_once 'interfacehtml.class.php';

class LoginView extends InterfaceHtml {

    private $form = null;

    protected function montaFormConsulta() {
        
    }

    protected function montaTituloDoModulo() {

        return "Login";
    }

    public function montaFormDosDados($clienteModel) {
        $this->form = new FormHtml();
        $this->form->setAction("login.php");
        $this->form->setMethod("post");

        $this->montaInputs($clienteModel);

        $this->montaBotoes();

        return $this->form;
    }

    public function recebeDadosDoFormulario() {
        $cliente = new ClienteModel();
        $cliente->setClieCpf($_POST['clieCpf']);
        $cliente->setClieSenha($_POST['clieSenha']);
        return $cliente;
    }

    private function montaBotoes() {
        //Button OK
        $button = new ButtonHtml();

        $button->setType("submit");
        $button->setName("bt");
        $button->setValue("loga");
        $button->setTexto("LOGAR");

        $this->form->adicionaObjeto($button);

        $button = new ButtonHtml();

        $button->setType("submit");
        $button->setName("bt");
        $button->setValue("altSenha");
        $button->setTexto("ALTERAR A SENHA");
        //Adiciona ao array de objetos
        $this->form->adicionaObjeto($button);

        $button = new ButtonHtml();

        $button->setType("submit");
        $button->setName("bt");
        $button->setValue("altDados");
        $button->setTexto("ALTERAR DADOS");
        //Adiciona ao array de objetos
        $this->form->adicionaObjeto($button);
    }

    private function montaInputs($clienteModel) {
        $p = new PHtml();

        $labelCpfCliente = new LabelHtml("CPF ");
        $p->adicionaObjeto($labelCpfCliente);
        $inputCpfCliente = new InputHtml("text", "clieCpf", NULL);
        $p->adicionaObjeto($inputCpfCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $labelSenhaCliente = new LabelHtml("Senha ");
        $p->adicionaObjeto($labelSenhaCliente);
        $inputSenhaCliente = new InputHtml("password", "clieSenha", NULL);
        $p->adicionaObjeto($inputSenhaCliente);
        $this->form->adicionaObjeto($p);
    }

    public function montaInputsAlterarSenha($clienteModel) {
        $form = new FormHtml("alteraSenha.php", "post");
        $p = new PHtml();

        $labelCpfCliente = new LabelHtml("CPF ");
        $p->adicionaObjeto($labelCpfCliente);
        $inputCpfCliente = new InputHtml("text", "clieCpf", null);
        $p->adicionaObjeto($inputCpfCliente);
        $form->adicionaObjeto($p);

        $p = new PHtml();

        $labelSenhaCliente = new LabelHtml("Senha ");
        $p->adicionaObjeto($labelSenhaCliente);
        $inputSenhaCliente = new InputHtml("password", "clieSenha", null);
        $p->adicionaObjeto($inputSenhaCliente);
        $form->adicionaObjeto($p);

        $p = new PHtml();

        $labelSenhaNovamenteCliente = new LabelHtml("Senha ");
        $p->adicionaObjeto($labelSenhaNovamenteCliente);
        $inputSenhaNovamenteCliente = new InputHtml("password", "clieSenhaNovamente", null);
        $p->adicionaObjeto($inputSenhaNovamenteCliente);
        $form->adicionaObjeto($p);
        
        return $form;
    }

    public function montaLegendaDados($acao) {
        $this->textoDaLegenda = null;
    }

}
