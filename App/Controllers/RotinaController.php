<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\RotinaProdutosDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Produto;
use App\Models\Entidades\RotinaProdutos;
use App\Models\Services\ApiGazin;

class RotinaController extends Controller
{
    public function produtos(): void
    {
        session_write_close();

        $acaoManual = empty($_GET['idFilial']) ? false : true;

        $idsFilial = empty($_GET['idFilial']) ? [] : [intval($_GET['idFilial'])];

        if (!$acaoManual) {
            $usuarioDAO = new UsuarioDAO;

            $idsFilial = $usuarioDAO->getFiliaisUsuarios();

            if (empty($idsFilial)) {
                http_response_code(500);

                echo 'Nenhuma filial encontrada!';

                return;
            }
        }

        $rotinaProdutosDAO = new RotinaProdutosDAO();

        $apiGazin = new ApiGazin;

        $qtdPromocoesSucesso = 0;
        $qtdPromocoesErro = 0;

        foreach ($idsFilial as $idFilial) {
            $statusFilialRotinaProdutos = $rotinaProdutosDAO->getStatusFilialRotinaProdutos($idFilial);

            if (
                $statusFilialRotinaProdutos['filial_cadastrada_na_rotina_produtos']
                && !$statusFilialRotinaProdutos['filial_precisa_atualizar_produtos']
                && !$acaoManual
            ) {
                continue;
            }

            try {
                $produtos = $apiGazin->relatorioProdutosPromocoesPorFilial($idFilial);

                foreach ($produtos as $produto) {
                    $produto = new Produto($produto, $idFilial);

                    $produtoDAO = new ProdutoDAO();

                    try {
                        $produtoDAO->cadastrarOuAtualizar($produto);

                        $qtdPromocoesSucesso++;
                    } catch (\Exception $e) {
                        $log = [
                            'tipo' => 'Erro ao cadastrar ou atualizar promoção',
                            'produto' => $produto->toArray(),
                            'erro' => $e->getMessage()
                        ];

                        $this->gravarLog(json_encode($log));

                        $qtdPromocoesErro++;

                        continue;
                    }
                }
            } catch (\Exception $e) {
                $log = [
                    'tipo' => 'Erro ao buscar promoções na API GAZIN',
                    'idFilial' => $idFilial,
                    'erro' => $e->getMessage()
                ];

                $this->gravarLog(json_encode($log));

                if ($acaoManual) {
                    http_response_code($e->getCode());

                    echo 'Erro ao buscar promoções na API Gazin.';

                    return;
                }

                continue;
            }

            $rotinaProdutos = new RotinaProdutos($idFilial, date('Y-m-d H:i:s'));

            $rotinaProdutosDAO->cadastrarOuAtualizar($rotinaProdutos);
        }

        $mensagem = "$qtdPromocoesSucesso promoções atualizadas com sucesso.";;

        if ($qtdPromocoesErro > 0) {
            $mensagem .= " $qtdPromocoesErro promoções não foram atualizadas pois houve algum erro.";
        }

        http_response_code(200);

        echo $mensagem;
    }

    private function gravarLog(string $dados): bool
    {
        $caminhoArquivo = PATH_LOG . 'log_rotina_produtos.json';

        if (file_put_contents($caminhoArquivo, $dados) !== false) {
            return true;
        }

        return false;
    }
}
