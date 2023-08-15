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
            'tipoPagamento',
            $parametros
        );
    }

    public function editar(TipoPagamento $tipoPagamento): bool
    {
        $parametros = $tipoPagamento->toArray(true, ['id']);

        return $this->update(
            'tipoPagamento',
            $parametros,
            "id = {$tipoPagamento->getId()}"
        );
    }
}
