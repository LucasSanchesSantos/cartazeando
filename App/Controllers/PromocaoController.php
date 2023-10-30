<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\PromocaoDAO;
use App\Models\Entidades\Promocao;

class PromocaoController extends Controller
{
    public function index(): void
    {
        $promocaoDAO = new PromocaoDAO();

        self::setViewParam('promocao', $promocaoDAO->listar());

        $this->render('promocao/index');
    }

    public function edicao(): void
    {
        $promocaoDAO = new PromocaoDAO();

        self::setViewParam('promocao', $promocaoDAO->getDadosPromocao($_GET['id']));

        $this->render('promocao/editar');
    }

    public function cadastro(): void
    {
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
            'valor_promocao' => floatval($_POST['valor_promocao']),
            'data_inicio' => strval($_POST['data_inicio']),
            'data_fim' => strval($_POST['data_fim']),
            'id_tipo_promocao' => intval($_POST['id_tipo_promocao']),
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
        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
            'data_cadastro' => date('Y-m-d H:i:s'),
            'id_produto' => intval($_POST['id_produto']),
            'id_cor' => intval($_POST['id_cor']),
            'id_voltagem' => intval($_POST['id_voltagem']),
            'id_filial' => intval($_POST['id_filial']),
            'valor_promocao' => floatval($_POST['valor_promocao']),
            'data_inicio' => strval($_POST['data_inicio']),
            'data_fim' => strval($_POST['data_fim']),
            'id_tipo_promocao' => intval($_POST['id_tipo_promocao']),
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
}
