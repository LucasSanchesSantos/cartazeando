<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\Constants\TipoPermissao;
use App\Models\DAO\TipoFormatoDAO;
use App\Models\DAO\TipoPagamentoDAO;
use App\Models\DAO\TipoPermissaoDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\TipoPagamento;
use App\Models\Entidades\Usuario;

class TipoPagamentoController extends Controller
{
    public function index(): void
    {
        $tipoPagamentoDAO = new TipoPagamentoDAO();

        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->listar());

        $this->render('tipoPagamento/index');
    }

    public function edicao(): void
    {
        $tipoPagamentoDAO = new TipoPagamentoDAO();

        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->getDadosTipoPagamento($_GET['id']));

        $this->render('tipoPagamento/editar');
    }

    public function cadastro(): void
    {
        $tipoFormatoDAO = new TipoFormatoDAO();
        $tipoPermissaoDAO = new TipoPermissaoDAO();

        self::setViewParam('tiposFormato', $tipoFormatoDAO->listar());
        self::setViewParam('tiposPermissao', $tipoPermissaoDAO->listar());

        $this->render('tipoPagamento/cadastrar');
    }

    public function cadastrar(): void
    {
        $tipoPagamento = new TipoPagamento([
            'id' => 0,
            'descricao' => strval($_POST['descricao'])
        ]);

        $tipoPagamentoDAO = new tipoPagamentoDAO();

        try {
            $tipoPagamentoDAO->cadastrar($tipoPagamento);

            Sessao::gravaSucesso("Tipo de pagamento cadastrado com sucesso!");
            $this->redirect('tipoPagamento', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar tipo pagamento. Contate o suporte.");
            $this->redirect('tipoPagamento', 'cadastro');
        }
    }

    public function editar(): void
    {
        $tipoPagamento = new TipoPagamento(
            $this->getDadosTipoPagamento()
        );

        $tipoPagamentoDAO = new TipoPagamentoDAO();

        try {
            $tipoPagamentoDAO->editar($tipoPagamento);

            Sessao::gravaSucesso("Tipo de pagamento editado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar tipo de pagamento.");
        }

        $this->redirect('tipoPagamento', "edicao?id={$tipoPagamento->getId()}");
    }

    private function getDadosTipoPagamento(): array
    {
        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
        ];
    }


}
