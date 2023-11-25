<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\Constants\TipoPermissao;
use App\Models\DAO\ImpressaoPersonalizadaDAO;
use App\Models\DAO\QtdParcelaDAO;
use App\Models\DAO\TipoPagamentoDAO;
use Exception;

class ImpressaoPersonalizadaController extends Controller
{
    public function index(): void
    {
        $impressaoPersonalizadaDAO = new ImpressaoPersonalizadaDAO();
        $qtdParcelaDAO = new QtdParcelaDAO();
        $tipoPagamentoDAO = new TipoPagamentoDAO();

        $usuario = Sessao::getUsuario();

        if ($usuario['id_tipo_permissao'] === TipoPermissao::ADMINISTRATIVO->value) {
            $filiais = $impressaoPersonalizadaDAO->getFiliais();
        } else {
            $filiais = $impressaoPersonalizadaDAO->getFilialEspecifica($usuario['id']);
        }

        self::setViewParam('tiposCartazes', $impressaoPersonalizadaDAO->getTiposCartazes());
        self::setViewParam('produtos', $impressaoPersonalizadaDAO->getProdutos());
        self::setViewParam('filiais', $filiais);
        self::setViewParam('qtdParcela', $qtdParcelaDAO->listar());
        self::setViewParam('tipoPagamento', $tipoPagamentoDAO->listar());

        $this->render('impressaoPersonalizada/index');
    }

    public function imprime()
    {
    }

    public function getDadosParaImpressao()
    {
        try {
            $impressaoDAO = new ImpressaoPersonalizadaDAO();

            $dadosProdutos = $impressaoDAO->getDescricaoProduto($_GET['idprodutoxy']);
            $dadosFilial = $impressaoDAO->getDadosFilial($_GET['idfilial']);
            
            if ($_GET['quantidadeParcelasEntrada'] == 1) {
                $quantidadeParcelaTotal = $_GET['quantidadeParcelasTotal'] - 1;
            }else{
                $quantidadeParcelaTotal = $_GET['quantidadeParcelasTotal'];
            }

            http_response_code(200);

            echo json_encode([
                'idproduto_x_y' => $_GET['idprodutoxy'],
                'id_produto' => $dadosProdutos['id_produto'],
                'id_grade_x' => $dadosProdutos['id_grade_x'],
                'id_grade_y' => $dadosProdutos['id_grade_y'],
                'cor' => $dadosProdutos['cor'],
                'voltagem' => $dadosProdutos['voltagem'],
                'produto' => $dadosProdutos['produto'],
                'de' => $_GET['valorDe'],
                'preco_venda' => $_GET['valorAtual'],
                'preco_partida' => $_GET['valorAtual'],
                'preco_a_prazo' => $_GET['valorAtual'],
                'prazo_inicial' => $_GET['quantidadeParcelasEntrada'],
                'prazo_final' => $quantidadeParcelaTotal,
                'tipo' => $_GET['tipo'],
                'data_inicial' => $_GET['validoDe'],
                'data_final' => $_GET['validoAte'],
                'idfilial' => $_GET['idfilial'],
                'tipoFormato' => $dadosFilial['tipo_formato'],
            ]);
        } catch (Exception $e) {
            http_response_code($e->getCode());

            echo 'Erro ao obter dados para impressão.';
        }
    }
}