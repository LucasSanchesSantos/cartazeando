<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;

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
}
