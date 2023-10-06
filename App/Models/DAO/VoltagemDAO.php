<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Voltagem;

class VoltagemDAO extends DAO
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
                voltagem";
    }

    public function cadastrar(Voltagem $voltagem): bool
    {
        $parametros = $voltagem->toArray(true);

        return $this->insert(
            'voltagem',
            $parametros
        );
    }

    public function editar(Voltagem $voltagem): bool
    {
        $parametros = $voltagem->toArray(true, ['id']);

        return $this->update(
            'voltagem',
            $parametros,
            "id = {$voltagem->getId()}"
        );
    }


    public function getDadosVoltagem(int $id): ?array
    {
        $sql = $this->getSqlVoltagem();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlVoltagem(): string
    {
        return "SELECT
                *
            FROM
                voltagem
            WHERE id = :id    
            ";
    }

    public function deletar($voltagem)
    {        
        return $this->delete(
            'voltagem',
            'id',
            $voltagem    
        );
    }
}
