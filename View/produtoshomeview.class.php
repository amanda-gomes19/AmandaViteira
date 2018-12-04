<?php

require_once 'interfacehtml.class.php';

class ProdutosHomeView extends InterfaceHtml {
    
    
    protected function montaFormConsulta() {
        
    }

    protected function montaTituloDoModulo() {
        return "Produtos Disponíveis";
    }

    public function montaFormDosDados($dados) {
        $montou = $tabelaDeProdutos = $this->montaTabelaProdutos();
        if ($montou) {
            return $tabelaDeProdutos;
        }else{
            $this->adicionaMensagem("Nenhum produto disponível!");
            return false;
        }
    }
    
    public function montaTabelaProdutos() {
        $br = new BrHtml();
        $produtoAdo = new ProdutoAdo();
        $buscou = $produtosDisponiveis = $produtoAdo->buscaTodosOsProdutos();
        
        if ($buscou) {
            
        }else{
            if ($buscou === 0) {
                $this->adicionaMensagem("Tabela vazia");
            }else{
                $this->adicionaMensagem("Erro! Contate o responsável pelo sistema.");
                        
            }
            
            return false;
        }
        
        $formIncluir = new FormHtml();
        
        $table = new HtmlTable();
        
        foreach ($produtosDisponiveis as $produto) {
            $tr = new HtmlTr();
            for ($i = 0; $i < 3; $i++) {
                $td = new HtmlTd();
                $td->adicionaObjeto($produto->prodNome);
                $td->adicionaObjeto($br);
                $td->adicionaObjeto($produto->prodValor);
                $td->adicionaObjeto($br);
                $formIncluir = $this->montaObjetoForm($produto);
                $td->adicionaObjeto($formIncluir);
                $tr->adicionaObjeto($td);
            }
            $table->adicionaObjeto($tr);
            
        }
    }
    
    public function montaObjetoForm($produto) {
        $form = new FormHtml();
        $form->setMethod("post");

        $inputProduto = new InputHtml("text", "prodId", $produto->prodId);
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
