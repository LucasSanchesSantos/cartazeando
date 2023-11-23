<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;

class QtdParcelaDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarQtdParcelas();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarQtdParcelas(): string
    {
        return "SELECT
                *
            FROM
                qtd_parcela";
    }
}
