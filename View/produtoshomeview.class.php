<?php

require_once 'interfacehtml.class.php';

class ProdutosHomeView extends InterfaceHtml {

    protected function montaFormConsulta() {
        
    }

    protected function montaTituloDoModulo() {
        return "Produtos Disponíveis";
    }

    public function montaFormDosDados($dados) {
        $div = new DivHtml();

        $div->adicionaObjeto($this->montaFieldsetProdutos());

        return $div;
    }

    protected function montaFieldsetProdutos() {
        $fieldsetProdutos = new HtmlFieldset();
        $fieldsetProdutos->adicionaObjeto($this->montaTabelaProdutos());
        return $fieldsetProdutos;
    }

    public function montaTabelaProdutos() {
        $form = new FormHtml("home.php", "post");
        $br = new BrHtml();
        $produtoAdo = new ProdutoAdo();
        $buscou = $produtosDisponiveis = $produtoAdo->buscaTodosOsProdutos();

        if ($buscou) {
            
        } else {
            if ($buscou === 0) {
                $this->adicionaMensagem("Nenhum produto disponível!");
            } else {
                $this->adicionaMensagem("Erro! Contate o responsável pelo sistema.");
            }

            return false;
        }

        $formIncluir = new FormHtml();

        $table = new HtmlTable();
        for ($j = 0; $j < count($produtosDisponiveis); $j++) {
            $tr = new HtmlTr();
            for ($i = 0; $i < 3; $i++) {
                if($j >= count($produtosDisponiveis)){
                    break;
                }
                $td = new HtmlTd();
                $td->adicionaObjeto($produtosDisponiveis[$j]->getProdNome());
                $td->adicionaObjeto($br);
                $td->adicionaObjeto($produtosDisponiveis[$j]->getProdValor());
                $td->adicionaObjeto($br);
                $formIncluir = $this->montaObjetoForm($produtosDisponiveis[$j]);
                $td->adicionaObjeto($formIncluir);
                $tr->adicionaObjeto($td);
                $j++;
            }
            $table->adicionaObjeto($tr);
        }
        $form->adicionaObjeto($table);
        return $form;
    }

    public function montaObjetoForm($produto) {
        $form = new FormHtml();
        $form->setMethod("post");

        $inputProduto = new InputHtml("text", "prodId", $produto->getProdId());
        $inputProduto->setType("hidden");
        $form->adicionaObjeto($inputProduto);

        $bt = new ButtonHtml("submit", "bt", "incCesta", "INCLUIR");

        $form->adicionaObjeto($bt);

        return $form;
    }

    function montaLegendaDados($acao) {
        $this->textoDaLegenda = NULL;
    }

}
