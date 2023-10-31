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
        return 
        "SELECT DISTINCT
            p.*
            ,c.descricao as cor
            ,v.descricao as voltagem
            ,t.descricao as tipo_pagamento
            ,s.descricao as situacao
            ,CONCAT(f.numero, ' - ', f.cidade) as filial
            ,CONCAT(pn.id_produto, ' - ', pn.produto) as produto
        from promocao p
        LEFT join cor c on c.id = p.id_cor
        left join voltagem v on v.id = p.id_voltagem
        left join tipo_pagamento t on t.id = p.id_tipo_pagamento
        left join situacao s on s.id = p.id_situacao
        left join filial f on f.id = p.id_filial
        left join produtonew pn on pn.id_produto = p.id_produto";
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
