<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\CorDAO;
use App\Models\Entidades\Cor;

class CorController extends Controller
{
    public function index(): void
    {
        $corDAO = new CorDAO();

        self::setViewParam('cor', $corDAO->listar());

        $this->render('cor/index');
    }

    public function edicao(): void
    {
        $corDAO = new CorDAO();

        self::setViewParam('cor', $corDAO->getDadosCor($_GET['id']));

        $this->render('cor/editar');
    }

    public function cadastro(): void
    {
        $this->render('cor/cadastrar');
    }

    public function cadastrar(): void
    {
        $cor = new Cor([
            'id' => 0,
            'descricao' => strval($_POST['descricao'])
        ]);

        $corDAO = new CorDAO();

        try {
            $corDAO->cadastrar($cor);

            Sessao::gravaSucesso("Cor cadastrado com sucesso!");
            $this->redirect('cor', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar cor. Contate o suporte.");
            $this->redirect('cor', 'cadastro');
        }
    }

    public function editar(): void
    {
        $cor = new Cor(
            $this->getDadosCor()
        );

        $corDAO = new CorDAO();

        try {
            $corDAO->editar($cor);

            Sessao::gravaSucesso("Cor editado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar cor.");
        }

        $this->redirect('cor', "edicao?id={$cor->getId()}");
    }

    private function getDadosCor(): array
    {
        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
        ];
    }

    public function deletar(): void
    {
        $id = $_GET['id'];
        $corDAO = new CorDAO();

        try {
            $corDAO->deletar($id);

            Sessao::gravaSucesso("Cor removido com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao remover Cor.");
        }

        $this->redirect('cor', "index");
    }
}
