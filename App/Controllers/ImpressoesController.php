<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Models\DAO\ImpressoesDAO;
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

        self::setViewParam('impressoes', $impressaoDAO->listar());

        $this->render('RelatorioImpressoes/index');
    }

  
}
