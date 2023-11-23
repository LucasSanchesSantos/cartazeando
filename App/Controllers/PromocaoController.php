<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\CorDAO;
use App\Models\DAO\FilialDAO;
use App\Models\DAO\PagamentoEntradaDAO;
use App\Models\DAO\ProdutoCadastroDAO;
use App\Models\DAO\PromocaoDAO;
use App\Models\DAO\QtdParcelaDAO;
use App\Models\DAO\SituacaoDAO;
use App\Models\DAO\TipoPagamentoDAO;
use App\Models\DAO\VoltagemDAO;
use App\Models\Entidades\Promocao;
use Dotenv\Parser\Parser;

class PromocaoController extends Controller
{
    public function index(): void
    {
        $promocaoDAO = new PromocaoDAO();
        $tipoPagamentoDAO = new TipoPagamentoDAO();
        $corDAO = new CorDAO();
        $voltagemDAO = new VoltagemDAO();
        $filialDAO = new FilialDAO();
        $produtoCadastroDAO = new ProdutoCadastroDAO();

        self::setViewParam('promocao', $promocaoDAO->listar());
        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->listar());
        self::setViewParam('cor', $corDAO->listar());
        self::setViewParam('voltagem', $voltagemDAO->listar());
        self::setViewParam('filial', $filialDAO->listar());
        self::setViewParam('produtoCadastro', $produtoCadastroDAO->listarCadastroPromocao());

        $this->render('promocao/index');
    }

    public function edicao(): void
    {
        $promocaoDAO = new PromocaoDAO();
        $tipoPagamentoDAO = new TipoPagamentoDAO();
        $corDAO = new CorDAO();
        $voltagemDAO = new VoltagemDAO();
        $filialDAO = new FilialDAO();
        $situacaoDAO = new SituacaoDAO();
        $produtoCadastroDAO = new ProdutoCadastroDAO();
        $qtdParcelaDAO = new QtdParcelaDAO();
        $PagementoEntrada = new PagamentoEntradaDAO();

        self::setViewParam('promocao', $promocaoDAO->getDadosPromocao($_GET['id']));
        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->listar());
        self::setViewParam('cor', $corDAO->listar());
        self::setViewParam('voltagem', $voltagemDAO->listar());
        self::setViewParam('filial', $filialDAO->listar());
        self::setViewParam('situacao', $situacaoDAO->listar());
        self::setViewParam('produtoCadastro', $produtoCadastroDAO->listarCadastroPromocao());
        self::setViewParam('qtdParcela', $qtdParcelaDAO->listar());
        self::setViewParam('pagementoEntrada', $PagementoEntrada->listar());

        $this->render('promocao/editar');
    }

    public function cadastro(): void
    {
        $tipoPagamentoDAO = new TipoPagamentoDAO();
        $corDAO = new CorDAO();
        $voltagemDAO = new VoltagemDAO();
        $filialDAO = new FilialDAO();
        $produtoCadastroDAO = new ProdutoCadastroDAO();
        $qtdParcelaDAO = new QtdParcelaDAO();
        $PagementoEntrada = new PagamentoEntradaDAO();

        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->listar());
        self::setViewParam('cor', $corDAO->listar());
        self::setViewParam('voltagem', $voltagemDAO->listar());
        self::setViewParam('filial', $filialDAO->listar());
        self::setViewParam('produtoCadastro', $produtoCadastroDAO->listarCadastroPromocao());
        self::setViewParam('qtdParcela', $qtdParcelaDAO->listar());
        self::setViewParam('pagementoEntrada', $PagementoEntrada->listar());

        $this->render('promocao/cadastrar');

    }

    public function cadastrar(): void
    {
        $promocao = new Promocao([
            'id' => 0,
            'descricao' => strval($_POST['descricao']),
            'data_cadastro' => date('Y-m-d H:i:s'),
            'id_produto' => intval($_POST['id_produto']),
            'id_cor' => intval($_POST['id_cor']),
            'id_voltagem' => intval($_POST['id_voltagem']),
            'id_filial' => intval($_POST['id_filial']),
            'valor_promocao' => $_POST['valor_promocao'],
            'data_inicio' => strval($_POST['data_inicio']),
            'data_fim' => strval($_POST['data_fim']),
            'id_tipo_pagamento' => intval($_POST['id_tipo_pagamento']),
            'parcela_inicio' => intval($_POST['parcela_inicio']),
            'parcela_fim' => intval($_POST['parcela_fim']),
            'id_situacao' => 1,
        ]);

        $promocaoDAO = new PromocaoDAO();

        try {
            $promocaoDAO->cadastrar($promocao);

            Sessao::gravaSucesso("Promoção cadastrado com sucesso!");
            $this->redirect('promocao', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar promoção. Contate o suporte.");
            $this->redirect('promocao', 'cadastro');
        }
    }

    public function editar(): void
    {
        $promocao = new Promocao(
            $this->getDadosPromocao()
        );

        $promocaoDAO = new PromocaoDAO();

        try {
            $promocaoDAO->editar($promocao);

            Sessao::gravaSucesso("Promoção editada com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar promoção.");
        }

        $this->redirect('promocao', "edicao?id={$promocao->getId()}");
    }

    private function getDadosPromocao(): array
    {

        $preco_formatado = $this->formatarValorEmFormatoAmericano($_POST['valor_promocao']);

        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
            'data_cadastro' => date('Y-m-d H:i:s'),
            'id_produto' => intval($_POST['id_produto']),
            'id_cor' => intval($_POST['id_cor']),
            'id_voltagem' => intval($_POST['id_voltagem']),
            'id_filial' => intval($_POST['id_filial']),
            'valor_promocao' => $_POST['valor_promocao'],
            'data_inicio' => strval($_POST['data_inicio']),
            'data_fim' => strval($_POST['data_fim']),
            'id_tipo_pagamento' => intval($_POST['id_tipo_pagamento']),
            'parcela_inicio' => intval($_POST['parcela_inicio']),
            'parcela_fim' => intval($_POST['parcela_fim']),
            'id_situacao' => intval($_POST['id_situacao']),
        ];
    }

    public function deletar(): void
    {
        $id = $_GET['id'];
        $promocaoDAO = new PromocaoDAO();

        try {
            $promocaoDAO->deletar($id);

            Sessao::gravaSucesso("Promoção removida com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao remover promoção.");
        }

        $this->redirect('promocao', "index");
    }
    
    public function formatarValorEmFormatoAmericano($valor){
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);

        return $valor;
    }
}
