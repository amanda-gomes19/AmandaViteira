<?php

/**
 * Description of Interfacehtml
 *
 * @author kaique
 */
require_once '../Classes/inputhtml.class.php';
require_once '../Classes/labelhtml.class.php';
require_once '../Classes/buttonhtml.class.php';
require_once '../Classes/texteareahtml.class.php';
require_once '../Classes/brhtml.class.php';
require_once '../Classes/phtml.class.php';
require_once '../Classes/formhtml.class.php';
require_once '../Classes/optionhtml.class.php';
require_once '../Classes/selecthtml.class.php';
require_once '../Classes/divhtml.class.php';
require_once '../Classes/htmlfieldset.class.php';
require_once '../Classes/htmltr.class.php';
require_once '../Classes/htmlth.class.php';
require_once '../Classes/htmltd.class.php';
require_once '../Classes/htmltable.class.php';
require_once '../Classes/htmlul.class.php';
require_once '../Classes/htmlli.class.php';
require_once '../Classes/htmla.class.php';
require_once '../Classes/htmlimg.class.php';

abstract class InterfaceHtml {

//    protected $divDeConsulta         = null;
    protected $divDaConsulta = null;
    protected $textoDaLegenda = null;
    protected $divDosDados = null;
    protected $divDoMenu = null;
    protected $divDoConteudo = null;
    protected $divDoCabecalho = null;
    protected $divDasMensagens = null;
    protected $divDoTituloDoModulo = null;
    protected $botoes;
    protected $inputHtml;
    protected $labelHtml;
    protected $buttonHtml;
    protected $texteAreaHtml;
    protected $break;
    protected $p;
    protected $formhtml;
    protected $optionhtml;
    protected $selecthtml;
    protected $htmlFieldset;
    private $mensagens;
    protected $bt = null;
    private $html1 = null;
    private $html2 = null;
    private $fielsetDosDados = null;
    private $textoMensagens = null;
    private $trhtml;
    private $thhtml;
    private $tdhtml;
    private $tablehtml;

    public function __construct() {
        $this->inputHtml = new InputHtml();
        $this->labelHtml = new LabelHtml();
        $this->buttonHtml = new ButtonHtml();
        $this->texteAreaHtml = new TexteAreaHtml();
        $this->break = new BrHtml();
        $this->p = new PHtml();
        $this->formhtml = new FormHtml();
        $this->optionhtml = new OptionHtml();
        $this->selecthtml = new SelectHtml();
        $this->htmlFieldset = new HtmlFieldset();
        $this->mensagens = array();

        $this->divDoMenu = new DivHtml();
        $this->divDoMenu->setId("divMenu");
        $this->divDoConteudo = new DivHtml();
        $this->divDoConteudo->setId("divConteudo");
        $this->divDasMensagens = new DivHtml();
        $this->divDasMensagens->setId("divMensagens");

        $this->botoes = array();
    }

    public function displayInterface($titulo, $dados, $acao) {
        $this->montaHtml1($titulo);
        $this->montaDivDoCabecalho();
        $this->montaDivDoMenu();
        $this->montaDivDoConteudo($dados, $acao);
        $this->montaHtml2();

        $htmlDaDivDoCabecalho = $this->divDoCabecalho->geraHtml();
        $htmlDaDivDoMenu = $this->divDoMenu->geraHtml();
        $htmlDaDivDoConteudo = $this->divDoConteudo->geraHtml();

        echo $this->html1 . $htmlDaDivDoCabecalho . $htmlDaDivDoMenu . $htmlDaDivDoConteudo . $this->html2;
    }

    private function montaDivDoCabecalho() {
        $this->divDoCabecalho = new DivHtml();
        $this->divDoCabecalho->setId("divCabecalho");
        $this->divDoCabecalho->setClass("container");

//        $imgIfg = new HtmlImg("../CSS/ifg-inhumas.jpg", "Imagem do IFG");
//        $this->divDoCabecalho->adicionaObjeto($imgIfg);
    }

    private function montaDivDoMenu() {
        $ul = new HtmlUl();

        $li = new HtmlLi();

        $a = new HtmlA();
        $a->setHref("home.php");
        $a->adicionaObjeto("Home");
        $li->adicionaObjeto($a);

        $ul->adicionaObjeto($li);
        
        $li = new HtmlLi();

        $a = new HtmlA();
        $a->setHref("login.php");
        $a->adicionaObjeto("Login");
        $li->adicionaObjeto($a);

        $ul->adicionaObjeto($li);
        
        $li = new HtmlLi();

        $a = new HtmlA();
        $a->setHref("cadastracliente.php");
        $a->adicionaObjeto("Cadastro de Clientes");
        $li->adicionaObjeto($a);

        $ul->adicionaObjeto($li);

        $li = new HtmlLi();

        $a = new HtmlA();
        $a->setHref("cestadecompras.php");
        $a->adicionaObjeto("Cesta de Produtos");
        $li->adicionaObjeto($a);

        $ul->adicionaObjeto($li);


        $this->divDoMenu->adicionaObjeto($ul);
    }

    private function montaDivDoConteudo($dados, $acao) {
        $this->montaTextoDoTituloModulo();
        $this->montaMensagens();
        $this->montaConsulta();
        $this->montaDados($dados, $acao);

        $this->divDoConteudo->adicionaArrayDeObjetos(array($this->divDoTituloDoModulo, $this->divDasMensagens, $this->divDaConsulta, $this->divDosDados));
    }

    protected function montaTextoDoTituloModulo() {
        $this->divDoTituloDoModulo = new DivHtml("<h1>{$this->montaTituloDoModulo()}</h1>");
        $this->divDoTituloDoModulo->setId("divTitulo");
    }

    abstract protected function montaTituloDoModulo();

    protected function montaConsulta() {
        $fieldset = new HtmlFieldset("Consulta");
        $consultou = $formConsulta = $this->montaFormConsulta();
        if ($consultou) {
            $fieldset->adicionaObjeto($formConsulta);
        } else {
            return $this->divDaConsulta = null;
        }

        $this->divDaConsulta = new DivHtml();
        $this->divDaConsulta->setId("divConsulta");
        $this->divDaConsulta->adicionaObjeto($fieldset);
    }

    protected function montaDados($dados, $acao) {
        $this->divDosDados = new DivHtml();
        $this->divDosDados->setId("divDados");
        $this->montaLegendaDados($acao);
        $this->montaBotoesDaEntradaDeDados($acao);

        $fieldset = new HtmlFieldset($this->textoDaLegenda);

        $montou = $formDosDados = $this->montaFormDosDados($dados);
        if ($montou) {
            $fieldset->adicionaObjeto($formDosDados);
        } else {
            return $this->divDosDados = null;
        }

        $this->divDosDados->adicionaObjeto($fieldset);
    }

    /**
     * Este método abstrato deve ser implementado na view gerando e retornando 
     * um objeto do tipo FormHtml.
     */
    abstract protected function montaFormConsulta();

    /**
     * Este método abstrato deve ser implementado na view gerando e retornando 
     * um objeto do tipo FormHtml.
     */
    public abstract function montaFormDosDados($dados);

    protected function montaLegendaDados($acao) {
        $this->textoDaLegenda = null;
        switch ($acao) {
            case 'nov' :
            case 'inc' :
            case 'cad':
                $this->textoDaLegenda = "Inclusão";

                break;

            case 'con' :
            case 'alt' :
            case 'conforn':
            case "excluirF":
            case 'exc' :
                $this->textoDaLegenda = "Alteração/Exclusão";

                break;
        }
    }

    protected function montaBotoesDaEntradaDeDados($acao) {
        switch ($acao) {
            case "nov":
            case "inc":
            case "cad":
                $button1 = new ButtonHtml();
                $button1->setType("submit");
                $button1->setName("bt");
                $button1->setValue("inc");
                $button1->setTexto("INCLUIR");
                //Adiciona ao array de botoes
                $this->botoes [] = $button1;

                $button2 = new ButtonHtml();
                $button2->setType("submit");
                $button2->setName("bt");
                $button2->setValue("nov");
                $button2->setTexto("LIMPAR");
                //Adiciona ao array de objetos
                $this->botoes [] = $button2;

                break;

            case "con":
            case "alt":
            case "ext":
                //Button alterar
                $button1 = new ButtonHtml();
                $button1->setType("submit");
                $button1->setName("bt");
                $button1->setValue("alt");
                $button1->setTexto("ALTERAR");
                //Adiciona ao array de objetos
                $this->botoes [] = $button1;

                //Button excluir
                $button2 = new ButtonHtml();
                $button2->setType("submit");
                $button2->setName("bt");
                $button2->setValue("exc");
                $button2->setTexto("EXCLUIR");
                //Adiciona ao array de objetos
                $this->botoes [] = $button2;

                $button3 = new ButtonHtml();
                $button3->setType("submit");
                $button3->setName("bt");
                $button3->setValue("nov");
                $button3->setTexto("LIMPAR");
                //Adiciona ao array de objetos
                $this->botoes [] = $button3;

                break;

            default:
                break;
        }
    }

    public function montaHtml1($titulo) {
        $this->html1 = "<html><head><title>{$titulo}</title><link rel='stylesheet' type='text/css' href='../CSS/estilo.css' /></head><body>";
    }

    public function montaHtml2() {
        $this->html2 = "</body></html>";
    }

    function getBt() {
        if (isset($_POST['bt'])) {
            return $this->bt = $_POST['bt'];
        } else {
            return $this->bt = "nov";
        }
    }

    function setBt($bt) {
        $this->bt = $bt;
    }

    public function getMensagens() {
        return $this->mensagens;
    }

    public function adicionaMensagem($mensagem) {
        $this->mensagens [] = $mensagem;
    }

    public function adicionaMensagens(Array $mensagens) {
        foreach ($mensagens as $mensagem) {
            $this->adicionaMensagem($mensagem);
        }
    }

    protected function montaMensagens() {
        foreach ($this->mensagens as $mensagem) {
            $pHtml = new PHtml($mensagem);
            $this->divDasMensagens->adicionaObjeto($pHtml);
        }
    }

    protected function montaFieldsetDaEntradaDeDados() {
        
    }

}

?>