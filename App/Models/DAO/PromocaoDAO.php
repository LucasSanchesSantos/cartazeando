<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Promocao;

class PromocaoDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarPromocao();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarPromocao(): string
    {
        return "SELECT
                *
            FROM
                promocao";
    }

    public function cadastrar(Promocao $promocao): bool
    {
        $parametros = $promocao->toArray(true);

        return $this->insert(
            'promocao',
            $parametros
        );
    }

    public function editar(Promocao $promocao): bool
    {
        $parametros = $promocao->toArray(true, ['id']);

        return $this->update(
            'promocao',
            $parametros,
            "id = {$promocao->getId()}"
        );
    }


    public function getDadosPromocao(int $id): ?array
    {
        $sql = $this->getSqlPromocao();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlPromocao(): string
    {
        return "SELECT
                *
            FROM
                promocao
            WHERE id = :id    
            ";
    }

    public function deletar($promocao)
    {        
        return $this->delete(
            'promocao',
            'id',
            $promocao    
        );
    }
}
