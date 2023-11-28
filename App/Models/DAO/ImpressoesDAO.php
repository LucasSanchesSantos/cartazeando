<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Impressoes;

class ImpressoesDAO extends DAO
{
 
    public function cadastrar(Impressoes $impressoes): bool
    {
        $parametros = $impressoes->toArray(true);

        return $this->insert(
            'impressoes',
            $parametros
        );
    }


    public function listar(): ?array
    {
        $sql = $this->getSqlDadosImpressoes();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlDadosImpressoes(): string
    {
        return "SELECT
                    i.promocao as promocao
                    ,CONCAT(f.numero,' - ', f.cidade) as filial
                    ,i.id_produto 
                    ,p2.produto
                    ,tp.descricao as tipo_pagamento
                    ,i.preco_a_prazo as valor_promocao
                    ,i.data_hora_impressao as data_impressao
                FROM impressoes i 
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto = i.id_produto
                left join tipo_pagamento tp on tp.id = i.id_tipo_pagamento";
    }
}
