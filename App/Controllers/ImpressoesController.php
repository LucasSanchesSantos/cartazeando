<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Models\DAO\FilialDAO;
use App\Models\DAO\ImpressoesDAO;
use App\Models\DAO\ProdutoCadastroDAO;
use App\Models\DAO\PromocaoDAO;
use App\Models\Entidades\Impressoes;

class ImpressoesController extends Controller
{
    public function inserirRegistrosImpressoes(): void {
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (isset($data['dados']) && !empty($data['dados'])) {
            $idFilial = $data['dados'][0]['id_filial'];
            $idPromocao = $data['dados'][0]['id_promocao'];
            $idProduto = $data['dados'][0]['id_produto'];
            $idGradeX = $data['dados'][0]['id_grade_x'];
            $idGradeY = $data['dados'][0]['id_grade_y'];
            $idTipoPagamento = $data['dados'][0]['id_tipo_pagamento'];
            $idPromocao = $data['dados'][0]['id_promocao'];
            $precoAPrazo = $data['dados'][0]['preco_a_prazo'];
            $promocao = $data['dados'][0]['promocao'];

            IF($promocao == 'PREÇO PADRÃO'){   
                $idPromocao = 0;
            }

            $impressoes = new Impressoes([
                'id' => 0,
                'id_promocao' => $idPromocao,
                'id_produto' => $idProduto,
                'id_grade_x' => $idGradeX,
                'id_grade_y' => $idGradeY,
                'id_tipo_pagamento' => $idTipoPagamento,
                'preco_a_prazo' => $precoAPrazo,
                'id_filial' => $idFilial,
                'id_usuario' => 0,
                'data_hora_impressao' => date('Y-m-d H:i:s'),
            ]);
    
            $impressoesDAO = new ImpressoesDAO();
    
            try {
                $impressoesDAO->cadastrar($impressoes);
            } catch (\Exception $e) {
            }
        } 
    }

    public function index(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();
        
        self::setViewParam('impressoes', $impressaoDAO->listar());
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/index');
    }

    public function Filtrar(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        $idFilial = $_POST['idFilial'] ?: null;
        // $idPromocao = $_POST['idPromocao'] ?: null;
        $idProduto = $_POST['idProduto'] ?: null;
        $dataInicio = $_POST['dataInicio'] ?: null;
        $dataFim = $_POST['dataFim'] ?: null;


        $filtros = [
            'idFilial' => is_null($idFilial) ? null : strval($idFilial),
            // 'idPromocao' => is_null($idPromocao) ? null : strval($idPromocao),
            'idProduto' => is_null($idProduto) ? null : strval($idProduto),
            'dataInicio' => is_null($dataInicio) ? null : strval($dataInicio),
            'dataFim' => is_null($dataFim) ? null : strval($dataFim),
        ];

        self::setViewParam('impressoes', $impressaoDAO->Filtrar($filtros));
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/Index');
    }

    public function RelatorioQuantidade(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        self::setViewParam('impressoes', $impressaoDAO->listarRelatorioQuantidade());
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/RealorioQuantidade');
    }

    public function RelatorioProduto(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        self::setViewParam('impressoes', $impressaoDAO->listarRelatorioProduto());
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/RelatorioProduto');
    }

    public function FiltrarRelatorioQuantidade(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        $idFilial = $_POST['idFilial'] ?: null;
        // $idPromocao = $_POST['idPromocao'] ?: null;
        $idProduto = $_POST['idProduto'] ?: null;
        $dataInicio = $_POST['dataInicio'] ?: null;
        $dataFim = $_POST['dataFim'] ?: null;


        $filtros = [
            'idFilial' => is_null($idFilial) ? null : strval($idFilial),
            // 'idPromocao' => is_null($idPromocao) ? null : strval($idPromocao),
            'idProduto' => is_null($idProduto) ? null : strval($idProduto),
            'dataInicio' => is_null($dataInicio) ? null : strval($dataInicio),
            'dataFim' => is_null($dataFim) ? null : strval($dataFim),
        ];

        self::setViewParam('impressoes', $impressaoDAO->FiltrarRelatorioQuantidade($filtros));
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/RealorioQuantidade');
    }

    public function ImpressoesPorFilial(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        self::setViewParam('impressoes', $impressaoDAO->listarImpressoesPorFilial());
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/ImpressoesPorFilial');
    }

    public function FiltrarRelatorioProduto(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        $idFilial = $_POST['idFilial'] ?: null;
        // $idPromocao = $_POST['idPromocao'] ?: null;
        $idProduto = $_POST['idProduto'] ?: null;
        $dataInicio = $_POST['dataInicio'] ?: null;
        $dataFim = $_POST['dataFim'] ?: null;


        $filtros = [
            'idFilial' => is_null($idFilial) ? null : strval($idFilial),
            // 'idPromocao' => is_null($idPromocao) ? null : intval($idPromocao),
            'idProduto' => is_null($idProduto) ? null : strval($idProduto),
            'dataInicio' => is_null($dataInicio) ? null : strval($dataInicio),
            'dataFim' => is_null($dataFim) ? null : strval($dataFim),
        ];

        self::setViewParam('impressoes', $impressaoDAO->FiltrarRelatorioProduto($filtros));
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/RelatorioProduto');
    }


    public function FiltrarImpressoesPorFilial(): void
    {
        $impressaoDAO = new ImpressoesDAO();
        $filialDAO = new FilialDAO();
        $produto = new ProdutoCadastroDAO();
        $promocao = new PromocaoDAO();

        $idFilial = $_POST['idFilial'] ?: null;
        // $idPromocao = $_POST['idPromocao'] ?: null;
        $idProduto = $_POST['idProduto'] ?: null;
        $dataInicio = $_POST['dataInicio'] ?: null;
        $dataFim = $_POST['dataFim'] ?: null;


        $filtros = [
            'idFilial' => is_null($idFilial) ? null : strval($idFilial),
            // 'idPromocao' => is_null($idPromocao) ? null : intval($idPromocao),
            'idProduto' => is_null($idProduto) ? null : strval($idProduto),
            'dataInicio' => is_null($dataInicio) ? null : strval($dataInicio),
            'dataFim' => is_null($dataFim) ? null : strval($dataFim),
        ];

        self::setViewParam('impressoes', $impressaoDAO->FiltrarImpressoesPorFilial($filtros));
        self::setViewParam('filiais', $filialDAO->listar());
        self::setViewParam('produtos', $produto->listar());
        self::setViewParam('promocoes', $promocao->listarSoPromocoes());

        $this->render('RelatorioImpressoes/ImpressoesPorFilial');
    }
}
