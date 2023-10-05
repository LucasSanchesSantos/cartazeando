<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\TipoPagamento;

class TipoPagamentoDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarTiposPagamentos();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarTiposPagamentos(): string
    {
        return "SELECT
                *
            FROM
                tipo_pagamento";
    }

    public function cadastrar(TipoPagamento $tipoPagamento): bool
    {
        $parametros = $tipoPagamento->toArray(true);

        return $this->insert(
            'tipo_pagamento',
            $parametros
        );
    }

    public function editar(TipoPagamento $tipoPagamento): bool
    {
        $parametros = $tipoPagamento->toArray(true, ['id']);

        return $this->update(
            'tipo_pagamento',
            $parametros,
            "id = {$tipoPagamento->getId()}"
        );
    }


    public function getDadosTipoPagamento(int $id): ?array
    {
        $sql = $this->getSqlTipoPagamento();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlTipoPagamento(): string
    {
        return "SELECT
                *
            FROM
                tipo_pagamento
            WHERE id = :id    
            ";
    }

    public function deletar($tipoPagamento)
    {        
        return $this->delete(
            'tipo_pagamento',
            'id',
            $tipoPagamento    
        );
    }
}
