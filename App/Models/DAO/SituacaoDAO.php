<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;

class SituacaoDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarVoltagens();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarVoltagens(): string
    {
        return "SELECT
                *
            FROM
                situacao";
    }
}
