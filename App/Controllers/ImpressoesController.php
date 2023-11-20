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

            $impressoes = new Impressoes([
                'id' => 0,
                'id_promocao' => $idPromocao,
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
