s<?php
require_once 'interfacehtml.class.php';
require_once '../Controller/clientecontroller.class.php';
require_once '../Model/clientemodel.class.php';

class ClienteView extends InterfaceHtml {

    private $form = null;

    protected function montaFormConsulta() {
        
    }

    protected function montaTituloDoModulo() {
        return "Cadastro - Cliente";
    }

    public function montaFormDosDados($clienteModel) {
        $this->form = new FormHtml();
        $this->form->setAction("cadastracliente.php");
        $this->form->setMethod("post");

        $this->montaInputs($clienteModel);

        $this->montaBotoes();

        return $this->form;
    }

    public function montaInputs($clienteModel) {
        $p = new PHtml();
        $br = new BrHtml();

        $this->form->adicionaObjeto($br);

        $labelCpfCliente = new LabelHtml("CPF ");
        $p->adicionaObjeto($labelCpfCliente);

        $inputCpfCliente = new InputHtml("text", "clieCpf", $clienteModel->getClieCpf());
        $p->adicionaObjeto($inputCpfCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelNomeCliente = new LabelHtml("Nome ");
        $p->adicionaObjeto($labelNomeCliente);

        $inputNomeCliente = new InputHtml("text", "clieNome", $clienteModel->getClieNome());
        $p->adicionaObjeto($inputNomeCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelRgCliente = new LabelHtml("RG ");
        $p->adicionaObjeto($labelRgCliente);

        $inputRgCliente = new InputHtml("text", "clieRg", $clienteModel->getClieRg());
        $p->adicionaObjeto($inputRgCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelUfRgCliente = new LabelHtml("UF do RG ");
        $p->adicionaObjeto($labelUfRgCliente);

        $inputUfRgCliente = new InputHtml("text", "clieUfRg", $clienteModel->getClieUfRg());
        $p->adicionaObjeto($inputUfRgCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelDtRgExpedicaoCliente = new LabelHtml("Data de expedição do RG ");
        $p->adicionaObjeto($labelDtRgExpedicaoCliente);

        $inputDtRgExpedicaoCliente = new InputHtml("date", "clieRgDtExpedicao", $clienteModel->getClieRgDtExpedicao());
        $p->adicionaObjeto($inputDtRgExpedicaoCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelEnderecoCliente = new LabelHtml("Endereço ");
        $p->adicionaObjeto($labelEnderecoCliente);

        $inputEnderecoCliente = new InputHtml("text", "clieEndereco", $clienteModel->getClieEndereco());
        $p->adicionaObjeto($inputEnderecoCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelCepCliente = new LabelHtml("CEP ");
        $p->adicionaObjeto($labelCepCliente);

        $inputCepCliente = new InputHtml("text", "clieCep", $clienteModel->getClieCep());
        $p->adicionaObjeto($inputCepCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelFoneCliente = new LabelHtml("Fone ");
        $p->adicionaObjeto($labelFoneCliente);

        $inputFoneCliente = new InputHtml("text", "clieFone", $clienteModel->getClieFone());
        $p->adicionaObjeto($inputFoneCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelEmailCliente = new LabelHtml("Email ");
        $p->adicionaObjeto($labelEmailCliente);

        $inputEmailCliente = new InputHtml("text", "clieEmail", $clienteModel->getClieEmail());
        $p->adicionaObjeto($inputEmailCliente);
        $this->form->adicionaObjeto($p);

        $p = new PHtml();
        $this->form->adicionaObjeto($br);

        $labelSenhaCliente = new LabelHtml("Senha ");
        $p->adicionaObjeto($labelSenhaCliente);

        $inputSenhaCliente = new InputHtml("text", "clieSenha", $clienteModel->getClieSenha());
        $p->adicionaObjeto($inputSenhaCliente);
        $this->form->adicionaObjeto($p);

        $this->form->adicionaObjeto($br);
    }

    public function recebeDadosDoFormulario() {
        return new ClienteModel($_POST['clieCpf'], $_POST['clieNome'], $_POST['clieRg'], $_POST['clieUfRg'], $_POST['clieRgDtExpedicao'], $_POST['clieEndereco'], $_POST['clieCep'], $_POST['clieFone'], $_POST['clieEmail'], $_POST['clieSenha']);
    }

    private function montaBotoes() {
        //Button OK
        $button = new ButtonHtml();
        $button->setType("submit");
        $button->setName("bt");
        $button->setValue("cad");
        $button->setTexto("CADASTRAR");
        //Adiciona ao array de objetos
        $this->form->adicionaObjeto($button);

        //Button Limpar
        $button = new ButtonHtml();
        $button->setType("submit");
        $button->setName("bt");
        $button->setValue("limp");
        $button->setTexto("LIMPAR");
        //Adiciona ao array de objetos
        $this->form->adicionaObjeto($button);
    }

}
