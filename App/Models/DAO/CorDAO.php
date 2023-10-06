<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Cor;

class CorDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarCores();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarCores(): string
    {
        return "SELECT
                *
            FROM
                cor";
    }

    public function cadastrar(Cor $cor): bool
    {
        $parametros = $cor->toArray(true);

        return $this->insert(
            'cor',
            $parametros
        );
    }

    public function editar(Cor $cor): bool
    {
        $parametros = $cor->toArray(true, ['id']);

        return $this->update(
            'cor',
            $parametros,
            "id = {$cor->getId()}"
        );
    }


    public function getDadosCor(int $id): ?array
    {
        $sql = $this->getSqlCor();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlCor(): string
    {
        return "SELECT
                *
            FROM
                cor
            WHERE id = :id    
            ";
    }

    public function deletar($cor)
    {        
        return $this->delete(
            'cor',
            'id',
            $cor    
        );
    }
}
