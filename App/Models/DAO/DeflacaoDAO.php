<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Deflacao;

class DeflacaoDAO extends DAO
{
    public function getDeflacao() {
        $sql = $this->getSqlDadosDeflacao();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    } 

    public function editar(Deflacao $deflacao): bool
    {
        $parametros = $deflacao->toArray(true, ['id']);

        return $this->update(
            'controle_deflacao',
            $parametros,
            "id = {$deflacao->getId()}"
        );
    }
    
    public function getDadosDeflacao(int $id) {
        $sql = $this->getSqlDadosDeflacaoAtual();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlDadosDeflacaoAtual(): string
    {
        return "SELECT
                *
            FROM
                controle_deflacao d
            WHERE
                d.id = :id";
    }

    private function getSqlDadosDeflacao(): string
    {
        return "SELECT
            c.id
            ,c.id_tipo_pagamento
            ,t.descricao as tipo_pagamento
            ,c.parcela_de
            ,c.parcela_ate
            ,c.valor_deflacao
        FROM controle_deflacao c
        left join tipo_pagamento t on t.id = c.id_tipo_pagamento
        order by t.descricao,c.parcela_ate";
    }
}
