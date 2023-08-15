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
        $usuarioLogado = Sessao::getUsuario();

        $idUsuario = !empty($_GET['id']) && $usuarioLogado['id_tipo_permissao'] == TipoPermissao::ADMINISTRATIVO->value ?
            intval($_GET['id']) : Sessao::getUsuario()['id'];

        $tipoPagamentoDAO = new TipoPagamentoDAO();

        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->listar());

        $this->render('tipoPagamento/editar');
    }

    public function cadastro(): void
    {
        $tipoFormatoDAO = new TipoFormatoDAO();
        $tipoPermissaoDAO = new TipoPermissaoDAO();

        self::setViewParam('tiposFormato', $tipoFormatoDAO->listar());
        self::setViewParam('tiposPermissao', $tipoPermissaoDAO->listar());

        $this->render('usuario/cadastrar');
    }

    public function cadastrar(): void
    {
        $tipoPagamento = new TipoPagamento([
            'id' => 0,
            'tipo_pagamento' => strval($_POST['tipo_pagamento'])
        ]);

        $tipoPagamentoDAO = new tipoPagamentoDAO();

        try {
            $tipoPagamentoDAO->cadastrar($tipoPagamento);

            Sessao::gravaSucesso("Usuário cadastrado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar usuário.");
        }

        $this->redirect('tipoPagamento', 'edicao');
    }

    public function editar(): void
    {
        $tipoPagamento = new TipoPagamento(
            $this->getDadosTipoPagamento()
        );

        $tipoPagamentoDAO = new TipoPagamentoDAO();

        try {
            $tipoPagamentoDAO->editar($tipoPagamento);

            Sessao::gravaSucesso("Usuário editado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar usuário.");
        }

        $this->redirect('tipoPagamento', "edicao?id={$tipoPagamento->getId()}");
    }

    private function getDadosTipoPagamento(): array
    {
        return [
            'id' => intval($_POST['id']),
            'tipoPagamento' => intval($_POST['tipoPagamento']),
        ];
    }


}
