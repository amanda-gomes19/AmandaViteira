<?php

require_once 'interfacehtml.class.php';
require_once '../Model/produtomodel.class.php';
require_once '../Controller/produtocontroller.class.php';
require_once '../ADO/fornecedorado.class.php';
require_once '../Model/fornecedormodel.class.php';

class ProdutoViewAlteracao extends ProdutoView {

    protected function montaBotoesDaEntradaDeDados($acao) {
        $this->botoes    = array();
        //Button alterar
        $button1         = new ButtonHtml();
        $button1->setType("submit");
        $button1->setName("bt");
        $button1->setValue("alt");
        $button1->setTexto("ALTERAR");
        //Adiciona ao array de objetos
        $this->botoes [] = $button1;

        //Button excluir
        $button2         = new ButtonHtml();
        $button2->setType("submit");
        $button2->setName("bt");
        $button2->setValue("exc");
        $button2->setTexto("EXCLUIR");
        //Adiciona ao array de objetos
        $this->botoes [] = $button2;

        $button3         = new ButtonHtml();
        $button3->setType("submit");
        $button3->setName("bt");
        $button3->setValue("nov");
        $button3->setTexto("LIMPAR");
        //Adiciona ao array de objetos
        $this->botoes [] = $button3;
    }

}
