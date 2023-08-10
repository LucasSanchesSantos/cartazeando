<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\DeflacaoDAO;
use App\Models\DAO\TipoPagamentoDAO;
use App\Models\DAO\TipoPermissaoDAO;
use App\Models\Entidades\Deflacao;

class DeflacaoController extends Controller
{
    public function index(): void
    {
        $deflacaoDAO = new DeflacaoDAO();

        self::setViewParam('deflacao', $deflacaoDAO->getDeflacao());

        $this->render('deflacao/index');
    }

    public function edicao(): void
    {
        $deflacaoDAO = new DeflacaoDAO();
        $tipoPermissaoDAO = new TipoPermissaoDAO();
        $tipoPagamentoDAO = new TipoPagamentoDAO();

        self::setViewParam('deflacao', $deflacaoDAO->getDadosDeflacao($_GET['id']));
        self::setViewParam('tiposPermissao', $tipoPermissaoDAO->listar());
        self::setViewParam('tiposPagamento', $tipoPagamentoDAO->listar());

        $this->render('deflacao/editar');
    }

    public function editar(): void
    {
        $deflacao = new Deflacao([
            'id' => intval($_POST['id']),
            'id_tipo_pagamento' => intval($_POST['id_tipo_pagamento']),
            'parcela_de' => intval($_POST['parcela_de']),
            'parcela_ate' => intval($_POST['parcela_ate']),
            'valor_deflacao' => floatval($_POST['valor_deflacao'])
        ]);

        $deflacaoDAO = new DeflacaoDAO();

        try {
            $deflacaoDAO->editar($deflacao);

            Sessao::gravaSucesso("Valores editados com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao alterar valores.");
        }
        $this->redirect('deflacao', "edicao?id={$deflacao->getId()}");
    }
}
