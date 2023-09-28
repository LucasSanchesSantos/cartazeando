<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\EmpresaDAO;
use App\Models\Entidades\Empresa;

class EmpresaController extends Controller
{
    public function index(): void
    {
        $empresaDAO = new EmpresaDAO();

        self::setViewParam('empresa', $empresaDAO->listar());

        $this->render('empresa/index');
    }

    public function edicao(): void
    {
        $empresaDAO = new EmpresaDAO();

        self::setViewParam('empresa', $empresaDAO->getDadosEmpresa($_GET['id']));

        $this->render('empresa/editar');
    }

    public function cadastro(): void
    {
        $empresaDAO = new EmpresaDAO();

        self::setViewParam('empresa', $empresaDAO->listar());

        $this->render('empresa/cadastrar');
    }

    public function cadastrar(): void
    {
        $empresa = new Empresa([
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
            'cnpj' => strval($_POST['cnpj']),
        ]);

        $empresaDAO = new EmpresaDAO();

        try {
            $empresaDAO->cadastrar($empresa);

            Sessao::gravaSucesso("Nova empresa cadastrada com sucesso!");
            $this->redirect('empresa', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar nova empresa. Contate o suporte.");
            $this->redirect('empresa', 'cadastro');
        }
    }

    public function editar(): void
    {
        $empresa = new Empresa(
            $this->getDadosEmpresa()
        );

        $empresaDAO = new EmpresaDAO();

        try {
            $empresaDAO->editar($empresa);

            Sessao::gravaSucesso("Empresa editada com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar empresa. Contate o suporte.");
        }

        $this->redirect('empresa', "edicao?id={$empresa->getId()}");
    }

    private function getDadosEmpresa(): array
    {
        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
            'cnpj' => strval($_POST['cnpj']),
        ];
    }


}
