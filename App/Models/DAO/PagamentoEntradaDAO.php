<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;

class PagamentoEntradaDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarPagamentoEntrada();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarPagamentoEntrada(): string
    {
        return "SELECT
                *
            FROM
                pagamento_entrada";
    }


}
