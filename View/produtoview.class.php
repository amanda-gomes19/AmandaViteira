<?php

require_once 'interfacehtmladm.class.php';
require_once '../Model/produtomodel.class.php';
require_once '../Controller/produtocontroller.class.php';
require_once '../ADO/fornecedorado.class.php';
require_once '../Model/fornecedormodel.class.php';

class ProdutoView extends InterfaceHtmlAdm {

    private $form = null;
    
    protected function montaFormConsulta() {
        $formConsulta = new FormHtml("cadastraproduto.php", "post");

        $label = new LabelHtml("Produtos");

        $formConsulta->adicionaObjeto($label);

        $combobox = new SelectHtml("prodId");

        $produtoAdo = new ProdutoAdo();

        try {
            $buscou = $produtosModel = $produtoAdo->buscaTodosOsProdutos();
        } catch (Exception $ex) {
            $this->adicionaMensagem($ex->getMessage());
        }

        if ($buscou) {
            //continua
        } else {
            if ($buscou === 0) {
                $this->adicionaMensagem("Tabela vazia!");
            } else {
                $this->adicionaMensagem("Erro na busca de produtos! Contate o responsável pelo sistema!");
            }

            $produtosModel = array();
        }

        $option = new OptionHtml(-1, FALSE, "Escolha um produto...");
        $combobox->adicionaOption($option);

        foreach ($produtosModel as $produtoModel) {
            $option = new OptionHtml($produtoModel->getProdId(), FALSE, $produtoModel->getProdNome());
            $combobox->adicionaOption($option);
        }

        $formConsulta->adicionaObjeto($combobox);
        $formConsulta->adicionaObjeto(new BrHtml());

        $formConsulta->adicionaObjeto(new ButtonHtml("submit", "bt", "con", "Consultar"));

        return $formConsulta;
    }

    protected function montaTituloDoModulo() {
        return "Cadastro de Produtos";
    }

    public function montaFormDosDados($produtoModel) {
        $div = new DivHtml();

        $div->adicionaObjeto($this->montaObjetosDoFormulario($produtoModel));

        return $div;
    }

    public function recebeDadosDaConsulta() {

        $produtoModel = new ProdutoModel($_POST['prodId']);
        return $produtoModel;
    }

    public function recebeDadosDoFormulario() {
        $prodId = null;
        if (isset($_POST ['prodId'])) {
            if (strlen(trim($_POST['prodId'])) > 0) {
                $prodId = $_POST['prodId'];
            }
        }
        return new ProdutoModel($prodId, $_POST['prodNome'], $_POST['prodValor'], $_POST['prodQtde']);
    }

    public function montaBotoes() {
        foreach ($this->botoes as $botao) {
            $this->form->adicionaObjeto($botao);
        }
    }

    private function montaObjetosDoFormulario($produtoModel) {
        
        $form = new FormHtml("cadastraproduto.php", "post");

        $br = new BrHtml();

        $p = new PHtml();

        $inputIdDeProduto = new InputHtml("hidden", "prodId", $produtoModel->getProdId());
        $p->adicionaObjeto($inputIdDeProduto);
        $form->adicionaObjeto($p);

        $p = new PHtml();

        $labelNomeProduto = new LabelHtml("Produto ");
        $p->adicionaObjeto($labelNomeProduto);

        $inputNomeProduto = new InputHtml("text", "prodNome", $produtoModel->getProdNome());
        $p->adicionaObjeto($inputNomeProduto);
        $form->adicionaObjeto($p);

        $p = new PHtml();

        $labelValorProduto = new LabelHtml("Valor ");
        $p->adicionaObjeto($labelValorProduto);

        $inputValorProduto = new InputHtml("text", "prodValor", $produtoModel->getProdValor());
        $p->adicionaObjeto($inputValorProduto);
        $form->adicionaObjeto($p);

        $p = new PHtml();

        $labelQuantidadeProduto = new LabelHtml("Quantidade ");
        $p->adicionaObjeto($labelQuantidadeProduto);

        $inputQuantidadeProduto = new InputHtml("text", "prodQtde", $produtoModel->getProdQtde());
        $p->adicionaObjeto($inputQuantidadeProduto);
        $form->adicionaObjeto($p);

        $form->adicionaArrayDeObjetos($this->botoes);
        
        $form->adicionaObjeto($this->montaFieldsetFornecedorDeProduto($produtoModel->getProdId()));
        
        return $form;
    }

    protected function montaFieldsetFornecedorDeProduto($proId) {
        $br = new BrHtml();
        $fieldsetFornecedor = new HtmlFieldset("Fornecedor");
        $botaoInsereFornecedor = new ButtonHtml("submit", "bt", "incforn", "Incluir");

        $combobox = new SelectHtml("fornCnpj");
        $fornecedorAdo = new FornecedorAdo();

        try {
            $buscou = $fornecedoresModel = $fornecedorAdo->buscaFornecedoresDeProdutos($proId);
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

        $option = new OptionHtml(-1, FALSE, "Escolha um Fornecedor...");
        $combobox->adicionaOption($option);

        foreach ($fornecedoresModel as $fornecedorModel) {
            $option = new OptionHtml($fornecedorModel->getFornCnpj(), FALSE, $fornecedorModel->getFornNome());
            $combobox->adicionaOption($option);
        }

        $formCombobox = new FormHtml("cadastraproduto.php", "post");
        $input = new InputHtml("text", "prodId", $proId);
        $input->setType("hidden");
        $formCombobox->adicionaObjeto($input);
        $formCombobox->adicionaObjeto($combobox);
        $formCombobox->adicionaObjeto($br);
        $formCombobox->adicionaObjeto($botaoInsereFornecedor);
        $fieldsetFornecedor->adicionaObjeto($formCombobox);

        $fieldsetFornecedor->adicionaObjeto($this->montaTableFornecedorDeProduto($proId));

        return $fieldsetFornecedor;
    }

    public function montaTableFornecedorDeProduto($prodId) {
        $fornecedorAdo = new FornecedorAdo();

        try {
            $buscou = $fornecedoresModel = $fornecedorAdo->buscaFonecedoresAssociados($prodId);
        } catch (Exception $ex) {
            $this->adicionaMensagem($ex->getMessage());
        }
        if ($buscou) {
            //Continua
        } else {
            if ($buscou === 0) {
                $this->adicionaMensagem("Não há fornecedores associados!");
            } else {
                $this->adicionaMensagem("Erro na busca de fornecedores! Contate o responsável pelo sistema!");
            }
            $fornecedoresModel = array();
        }

        $table = new HtmlTable();

        $tr = new HtmlTr();
        $tr->adicionaObjeto(new HtmlTd("Fornecedor"));
        $tr->adicionaObjeto(new HtmlTd("Ação"));
        $table->adicionaObjeto($tr);

        foreach ($fornecedoresModel as $fornecedor) {
            // Nome do fornecedor.
            $tr = new HtmlTr();
            $tr->adicionaObjeto(new HtmlTd($fornecedor->getFornNome()));

            // Botao para excluir.
            $td = new HtmlTd();

            $form = new FormHtml("cadastraproduto.php", "post");

            $produto = new InputHtml("text", "prodId", $prodId);
            $produto->setHidden(true);
            $form->adicionaObjeto($produto);

            $fornecedorCnpj = new InputHtml("text", "fornCnpj", $fornecedor->getFornCnpj());
            $fornecedorCnpj->setHidden(true);
            $form->adicionaObjeto($fornecedorCnpj);

            $form->adicionaObjeto(new ButtonHtml("submit", "bt", "excluirF", "Excluir"));

            $td->adicionaObjeto($form);

            $tr->adicionaObjeto($td);
            $table->adicionaObjeto($tr);
        }
        return $table;
    }

    public function recebeDadosAssociacao() {
        return array("prodId" => $_POST['prodId'], "fornCnpj" => $_POST['fornCnpj']);
    }

    public function recebeDadosParaAPagarFornecedor() {
        return array("prodId" => $_POST['prodId'], "fornCnpj" => $_POST['fornCnpj']);
    }

}
