<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\RotinaProdutos;

class RotinaProdutosDAO extends DAO
{
    public function getStatusFilialRotinaProdutos(int $idFilial): ?array
    {
        $sql = $this->getSqlStatusFilialRotinaProdutos();

        $parametros = [
            'idFilial' => $idFilial,
            'idFilialCadastrada' => $idFilial
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametros);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function cadastrarOuAtualizar(RotinaProdutos $rotinaProdutos): bool
    {
        $parametros = $rotinaProdutos->toArray(true);

        return $this->upsert(
            'rotina_produtos',
            $parametros
        );
    }

    private function getSqlStatusFilialRotinaProdutos(): string
    {
        return "SELECT EXISTS(
                SELECT
                    *
                FROM
                    rotina_produtos
                WHERE
                    id_filial = :idFilial
                    AND data_hora_execucao < DATE_SUB(NOW(), INTERVAL 6 HOUR)
            ) AS filial_precisa_atualizar_produtos,
            EXISTS(
                SELECT
                    *
                FROM
                    rotina_produtos
                WHERE
                    id_filial = :idFilialCadastrada
            ) AS filial_cadastrada_na_rotina_produtos";
    }
}
