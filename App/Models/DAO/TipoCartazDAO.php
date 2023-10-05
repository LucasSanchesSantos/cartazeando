<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\TipoCartaz;

class TipoCartazDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarTipoCartaz();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarTipoCartaz(): string
    {
        return "SELECT
                *
            FROM
                tipo_cartaz";
    }

    public function cadastrar(TipoCartaz $tipoCartaz): bool
    {
        $parametros = $tipoCartaz->toArray(true);

        return $this->insert(
            'tipo_cartaz',
            $parametros
        );
    }

    public function editar(TipoCartaz $tipoCartaz): bool
    {
        $parametros = $tipoCartaz->toArray(true, ['id']);

        return $this->update(
            'tipo_cartaz',
            $parametros,
            "id = {$tipoCartaz->getId()}"
        );
    }


    public function getDadosTipoCartaz(int $id): ?array
    {
        $sql = $this->getSqlTipoCartaz();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlTipoCartaz(): string
    {
        return "SELECT
                *
            FROM
                tipo_cartaz
            WHERE id = :id    
            ";
    }

    public function deletar($id)
    {        
        return $this->delete(
            'tipo_cartaz',
            'id',
            $id    
        );
    }
}
