<?php

require_once 'interfacehtml.class.php';

class CestaDeComprasView extends InterfaceHtml {

    protected function montaFormConsulta() {
        
    }

    protected function montaTituloDoModulo() {
        return "Cesta de Compra";
    }

    public function montaFormDosDados($dados) {
        $montou = $tabelaDaCestaDeProdutos = $this->montaTabelaCesta($clieId);
        if ($montou) {
            return $tabelaDaCestaDeProdutos;
        } else {
            $this->adicionaMensagem("A sua cesta de produtos ainda está vazia!");
            return false;
        }
    }
    
    public function montaObjetoForm($cesta) {
        $form = new FormHtml();
        $form->setMethod("post");

        $inputProduto = new InputHtml("text", "prceProdId", $cesta->prodId);
        $inputProduto->setType("hidden");
        $form->adicionaObjeto($inputProduto);

        $inputCesta = new InputHtml("text", "prceCestClieCpf", $cesta->cestClieCpf);
        $inputCesta->setType("hidden");
        $form->adicionaObjeto($inputCesta);

        $bt = new ButtonHtml("submit", "bt", "ret", "RETIRAR");

        $form->adicionaObjeto($bt);

        return $form;
    }
    
    public function montaTabelaCesta($clieCpf) {
        $cestaDeComprasAdo = new CestaDeCompraAdo();
        $buscou            = $cestaDeProdutos   = $cestaDeComprasAdo->buscaProdutosDaCesta($clieCpf);

        if ($buscou) {
            //continua
        } else {
            if ($buscou === 0) {
                $this->adicionaMensagem("Tabela Vazia");
            } else {
                $this->adicionaMensagem("Erro! Contate o responsável pelo sistema.");
            }
            return false;
        }

        $formRetirar = new FormHtml();

        $table = new HtmlTable();

        $tr = new HtmlTr();
        $tr->adicionaObjeto(new HtmlTh("Produto"));
        $tr->adicionaObjeto(new HtmlTh("Valor"));
        $tr->adicionaObjeto(new HtmlTh("Quantidade"));
        $tr->adicionaObjeto(new HtmlTh("Ação"));
        $table->adicionaObjeto($tr);

        foreach ($cestaDeProdutos as $cesta) {
            //Nome do produto
            $tr = new HtmlTr();
            $tr->adicionaObjeto(new HtmlTd($cesta->prodNome));

            //Valor do produto
            $tr->adicionaObjeto(new HtmlTd($cesta->prodValor));

            //Quantidade do produto
            $tr->adicionaObjeto(new HtmlTd(new InputHtml("text", "prodQtde", 1)));

            //Chamando método que faz o formulário que retira o produto
            $formRetirar = $this->montaObjetoForm($cesta);

            //Botão para retirar o produto
            $tr->adicionaObjeto(new HtmlTd($formRetirar));

            $table->adicionaObjeto($tr);
        }
    }
    
    function montaLegendaDados($acao) {
        $this->textoDaLegenda = null;
    }

}
