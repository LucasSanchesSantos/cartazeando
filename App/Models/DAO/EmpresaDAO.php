<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Empresa;
use App\Models\Entidades\Filial;

class EmpresaDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarEmpresa();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarEmpresa(): string
    {
        return "SELECT
                *
            FROM
                empresa";
    }

    public function cadastrar(Empresa $empresa): bool
    {
        $parametros = $empresa->toArray(true);

        return $this->insert(
            'empresa',
            $parametros
        );
    }

    public function editar(Empresa $empresa): bool
    {
        $parametros = $empresa->toArray(true, ['id']);

        return $this->update(
            'empresa',
            $parametros,
            "id = {$empresa->getId()}"
        );
    }


    public function getDadosEmpresa(int $id): ?array
    {
        $sql = $this->getSqlEmpresa();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlEmpresa(): string
    {
        return "SELECT
                *
            FROM
                empresa
            WHERE id = :id    
            ";
    }
}
