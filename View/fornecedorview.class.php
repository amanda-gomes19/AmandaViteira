<?php

require_once 'interfacehtmladm.class.php';

class FornecedorView extends InterfaceHtmlAdm{
    
    protected function montaFormConsulta() {
        $formConsulta = new FormHtml("cadastrafornecedor.php", "post");

        $label = new LabelHtml("Fornecedores");

        $formConsulta->adicionaObjeto($label);

        $combobox = new SelectHtml("fornCnpj");

        $fornecedorAdo = new FornecedorAdo();
        try {
            $buscou            = $fornecedoresModel = $fornecedorAdo->buscaTodosOsFornecedores();
        } catch (Exception $e) {
            $this->adicionaMensagem($e->getMessage());
        }
        if ($buscou) {
            //continua
        } else {
            if ($buscou === 0) {
                $this->adicionaMensagem("Tabela vazia!");
            } else {
                $this->adicionaMensagem("Erro na busca de fornecedores! Contate o responsável pelo sistema.");
            }
            $fornecedoresModel = array();
        }
        $option = new OptionHtml(-1, FALSE, "Escolha um fornecedor...");
        $combobox->adicionaOption($option);

        foreach ($fornecedoresModel as $fornecedorModel) {
            $option = new OptionHtml($fornecedorModel->getFornCNPJ(), FALSE, $fornecedorModel->getFornNome());
            $combobox->adicionaOption($option);
        }

        $formConsulta->adicionaObjeto($combobox);
        $formConsulta->adicionaObjeto(new BrHtml());

        $formConsulta->adicionaObjeto(new ButtonHtml("submit", "bt", "con", "Consultar"));

        return $formConsulta;
    }

    public function montaFormDosDados($fornecedorModel) {
        $form = new FormHtml();
        $form->setAction("cadastrafornecedor.php");
        $form->setMethod("post");

        $arrayDeObjetosDoFormulario = $this->montaobjetosDoFormulario($fornecedorModel);

        $form->adicionaArrayDeObjetos($arrayDeObjetosDoFormulario);
        $form->adicionaArrayDeObjetos($this->botoes);

        return $form;
    }
    
     public function recebeDadosDaConsulta() {
        return new Fornecedormodel($_POST ['fornCnpj']);
    }

    public function recebeDadosDoFormulario() {
        return new Fornecedormodel($_POST ['fornCnpj'], $_POST['fornNome'], $_POST['fornEmail'], $_POST['fornFone1'], $_POST['fornFone2'], $_POST['fornEnd'], $_POST['fornCep'], $_POST['fornCidade'], $_POST['fornUf']);
    }

    public function montaBotoes() {


        foreach ($this->botoes as $botao) {
            $this->form->adicionaObjeto($botao);
        }
    }
    
     private function montaobjetosDoFormulario($fornecedorModel) {
        $arrayDeObjetosDoFormulario = array();

        $br = new BrHtml();
        
        $p = new PHtml();

        $labelCnpjDoFornecedor = new LabelHtml();
        $labelCnpjDoFornecedor->setTexto("Informe o CNPJ do fornecedor ");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelCnpjDoFornecedor);

        $inputCnpjDoFornecedor = new InputHtml();
        $inputCnpjDoFornecedor->setType("text");
        $inputCnpjDoFornecedor->setName("fornCnpj");
        $inputCnpjDoFornecedor->setValue($fornecedorModel->getFornCnpj());

        $p->adicionaObjeto($inputCnpjDoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;

        $p = new PHtml();

        $labelNomeDoFornecedor = new LabelHtml();
        $labelNomeDoFornecedor->setTexto("Informe o nome do fornecedor");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelNomeDoFornecedor);

        $inputNomeDoFornecedor = new InputHtml();
        $inputNomeDoFornecedor->setType("text");
        $inputNomeDoFornecedor->setName("fornNome");
        $inputNomeDoFornecedor->setValue($fornecedorModel->getFornNome());

        $p->adicionaObjeto($inputNomeDoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;
        
         $p = new PHtml();

        $labelEmail = new LabelHtml();
        $labelEmail->setTexto("Informe o email");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelEmail);

        $inputEmail = new InputHtml();
        $inputEmail->setType("text");
        $inputEmail->setName("fornEmail");
        $inputEmail->setValue($fornecedorModel->getFornEmail());

        $p->adicionaObjeto($inputEmail);
        $arrayDeObjetosDoFormulario [] = $p;

        $p = new PHtml();

        $labelFone1DoFornecedor = new LabelHtml();
        $labelFone1DoFornecedor->setTexto("Informe o telefone 1 do fornecedor");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelFone1DoFornecedor);

        $inputFone1DoFornecedor = new InputHtml();
        $inputFone1DoFornecedor->setType("text");
        $inputFone1DoFornecedor->setName("fornFone1");
        $inputFone1DoFornecedor->setValue($fornecedorModel->getFornFone1());

        $p->adicionaObjeto($inputFone1DoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;

        $p = new PHtml();

        $labelFone2DoFornecedor = new LabelHtml();
        $labelFone2DoFornecedor->setTexto("Informe o telefone 2 do fornecedor");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelFone2DoFornecedor);

        $inputFone2DoFornecedor = new InputHtml();
        $inputFone2DoFornecedor->setType("text");
        $inputFone2DoFornecedor->setName("fornFone2");
        $inputFone2DoFornecedor->setValue($fornecedorModel->getFornFone2());

        $p->adicionaObjeto($inputFone2DoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;
        
        $p = new PHtml();

        $labelEnderecoDoFornecedor = new LabelHtml();
        $labelEnderecoDoFornecedor->setTexto("Informe o endereço do fornecedor");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelEnderecoDoFornecedor);

        $inputEnderecoDoFornecedor = new InputHtml();
        $inputEnderecoDoFornecedor->setType("text");
        $inputEnderecoDoFornecedor->setName("fornEnd");
        $inputEnderecoDoFornecedor->setValue($fornecedorModel->getFornEnd());

        $p->adicionaObjeto($inputEnderecoDoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;

        $p = new PHtml();

        $labelCepDoFornecedor = new LabelHtml();
        $labelCepDoFornecedor->setTexto("Informe o CEP do fornecedor");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelCepDoFornecedor);

        $inputCepDoFornecedor = new InputHtml();
        $inputCepDoFornecedor->setType("text");
        $inputCepDoFornecedor->setName("fornCep");
        $inputCepDoFornecedor->setValue($fornecedorModel->getFornCep());

        $p->adicionaObjeto($inputCepDoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;
        
        $p = new PHtml();

        $labelCidadeDoFornecedor = new LabelHtml();
        $labelCidadeDoFornecedor->setTexto("Informe a cidade do fornecedor :");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelCidadeDoFornecedor);

        $inputCidadeDoFornecedor = new InputHtml();
        $inputCidadeDoFornecedor->setType("text");
        $inputCidadeDoFornecedor->setName("fornCidade");
        $inputCidadeDoFornecedor->setValue($fornecedorModel->getFornCidade());

        $p->adicionaObjeto($inputCidadeDoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;

        $p = new PHtml();

        $labelUfDoFornecedor = new LabelHtml();
        $labelUfDoFornecedor->setTexto("Informe o uf do fornecedor");
        //Adiciona ao array de objetos
        $p->adicionaObjeto($labelUfDoFornecedor);

        $inputUfDoFornecedor = new InputHtml();
        $inputUfDoFornecedor->setType("text");
        $inputUfDoFornecedor->setName("fornUf");
        $inputUfDoFornecedor->setValue($fornecedorModel->getFornUF());

        $p->adicionaObjeto($inputUfDoFornecedor);
        $arrayDeObjetosDoFormulario [] = $p;

        return $arrayDeObjetosDoFormulario;
    }

    protected function montaTituloDoModulo() {
        return "Cadastro de Fornecedores";
    }

    
}

