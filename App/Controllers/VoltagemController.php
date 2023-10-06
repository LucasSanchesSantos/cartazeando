<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\VoltagemDAO;
use App\Models\Entidades\Voltagem;

class VoltagemController extends Controller
{
    public function index(): void
    {
        $voltagemDAO = new VoltagemDAO();

        self::setViewParam('voltagem', $voltagemDAO->listar());

        $this->render('voltagem/index');
    }

    public function edicao(): void
    {
        $voltagemDAO = new VoltagemDAO();

        self::setViewParam('voltagem', $voltagemDAO->getDadosVoltagem($_GET['id']));

        $this->render('voltagem/editar');
    }

    public function cadastro(): void
    {
        $this->render('voltagem/cadastrar');
    }

    public function cadastrar(): void
    {
        $voltagem = new Voltagem([
            'id' => 0,
            'descricao' => strval($_POST['descricao'])
        ]);

        $voltagemDAO = new VoltagemDAO();

        try {
            $voltagemDAO->cadastrar($voltagem);

            Sessao::gravaSucesso("Voltagem cadastrado com sucesso!");
            $this->redirect('voltagem', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar voltagem. Contate o suporte.");
            $this->redirect('voltagem', 'cadastro');
        }
    }

    public function editar(): void
    {
        $voltagem = new Voltagem(
            $this->getDadosVoltagem()
        );

        $voltagemDAO = new VoltagemDAO();

        try {
            $voltagemDAO->editar($voltagem);

            Sessao::gravaSucesso("Voltagem editado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar voltagem.");
        }

        $this->redirect('voltagem', "edicao?id={$voltagem->getId()}");
    }

    private function getDadosVoltagem(): array
    {
        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
        ];
    }

    public function deletar(): void
    {
        $id = $_GET['id'];
        $voltagemDAO = new VoltagemDAO();

        try {
            $voltagemDAO->deletar($id);

            Sessao::gravaSucesso("Voltagem removido com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao remover voltagem.");
        }

        $this->redirect('voltagem', "index");
    }
}
