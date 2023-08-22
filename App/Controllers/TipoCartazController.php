<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\TipoCartazDAO;
use App\Models\DAO\TipoFormatoDAO;
use App\Models\DAO\TipoPermissaoDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\TipoCartaz;
use App\Models\Entidades\Usuario;

class TipoCartazController extends Controller
{
    public function index(): void
    {
        $tipoCartazDAO = new TipoCartazDAO();

        self::setViewParam('tipoCartaz', $tipoCartazDAO->listar());

        $this->render('tipoCartaz/index');
    }

    public function edicao(): void
    {
        $tipoCartazDAO = new TipoCartazDAO();

        self::setViewParam('tipoCartaz', $tipoCartazDAO->getDadosTipoCartaz($_GET['id']));

        $this->render('tipoCartaz/editar');
    }

    public function cadastro(): void
    {
        $tipoFormatoDAO = new TipoFormatoDAO();
        $tipoPermissaoDAO = new TipoPermissaoDAO();

        self::setViewParam('tiposFormato', $tipoFormatoDAO->listar());
        self::setViewParam('tiposPermissao', $tipoPermissaoDAO->listar());

        $this->render('tipoCartaz/cadastrar');
    }

    public function cadastrar(): void
    {
        $tipoCartaz = new TipoCartaz([
            'id' => 0,
            'descricao' => strval($_POST['descricao']),
            'dimensaoInicial' => strval($_POST['dimensaoInicial']),
            'dimensaoFinal' => strval($_POST['dimensaoFinal']),
            'qtdFolhas' => intval($_POST['qtdFolhas']),        
        ]);

        $tipoCartazDAO = new TipoCartazDAO();

        try {
            $tipoCartazDAO->cadastrar($tipoCartaz);

            Sessao::gravaSucesso("Novo tipo de cartaz cadastrado com sucesso!");
            $this->redirect('tipoCartaz', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar novo tipo de cartaz. Contate o suporte.");
            $this->redirect('tipoCartaz', 'cadastro');
        }
    }

    public function editar(): void
    {
        $tipoCartaz = new TipoCartaz(
            $this->getDadosTipoCartaz()
        );

        $tipoCartazDAO = new TipoCartazDAO();

        try {
            $tipoCartazDAO->editar($tipoCartaz);

            Sessao::gravaSucesso("Tipo de cartaz editado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar tipo de cartaz.");
        }

        $this->redirect('tipoCartaz', "edicao?id={$tipoCartaz->getId()}");
    }

    private function getDadosTipoCartaz(): array
    {
        return [
            'id' => intval($_POST['id']),
            'descricao' => strval($_POST['descricao']),
            'dimensaoInicial' => strval($_POST['dimensaoInicial']),
            'dimensaoFinal' => strval($_POST['dimensaoFinal']),
            'qtdFolhas' => intval($_POST['qtdFolhas']),
        ];
    }


}
