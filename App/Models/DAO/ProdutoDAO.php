<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\Produto;

class ProdutoDAO extends DAO
{
    public function cadastrarOuAtualizar(Produto $produto): bool
    {
        $parametros = $produto->toArray(true);

        return $this->upsert(
            'produto',
            $parametros
        );
    }
    
    public function getProdutosPorFiltros(array $parametros): ?array
    {
        $sql = $this->getSqlProdutosPorFiltros($parametros);

        foreach ($parametros as $index => $parametro) {
            if ($parametro === null) {
                unset($parametros[$index]);
            }
        }

        $resultado = $this->selectWithBindValue($sql, $parametros);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlProdutosPorFiltros(array $parametros): string
    {
        $clausulaIdPromocao = empty($parametros['promocao']) ? '' : 'AND p.id = :id_promocao';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : 'AND pm.id_produto = :idProduto';

        //$clausulaIdProduto = empty($parametros['idProduto']) ? '' : 'AND pm.id_produto = :idProduto';

        return "SELECT 
                    p.*
                    ,p.id_cor          as id_grade_x
	                ,p.id_voltagem     as id_grade_y
                    ,c.descricao       as cor
                    ,v.descricao       as voltagem
                    ,pm.data_inicio    as data_inicial
                    ,pm.data_fim       as data_final
                    ,pm.parcela_inicio as prazo_inicial
                    ,pm.parcela_fim    as prazo_final
                    ,pm.valor_promocao as preco_a_prazo
                    ,case when pm.parcela_inicio = 0 then 'Sem Entrada' else 'Com Entrada' end as tipo_prazo_promocao
                    ,tp.id             as id_tipo_pagamento
                    ,tp.descricao      as tipo
                    ,pm.id_filial      as id_filial
                    ,pm.descricao      as promocao
                    ,pm.id             as id_promocao
                    ,concat('http://localhost:8082/',p.caminho_imagem) as imagem
                from produtonew p 
                left join cor c       on c.id = p.id_cor 
                left join voltagem v  on v.id = p.id_voltagem 
                left join promocao pm on pm.id_produto = p.id_produto and pm.id_cor = p.id_cor  and pm.id_voltagem = p.id_voltagem 
                left join tipo_pagamento tp on tp.id = id_tipo_pagamento 
                where 
                    pm.id_situacao = 1
                    and id_filial = :idFilial
                    and current_date() between pm.data_inicio and pm.data_fim
                    $clausulaIdPromocao
                    $clausulaIdProduto

                union

                SELECT 
                    p.*
                    ,p.id_cor          as id_grade_x
                    ,p.id_voltagem     as id_grade_y
                    ,c.descricao       as cor
                    ,v.descricao       as voltagem
                    ,CURRENT_DATE()    as data_inicial
                    ,DATE_ADD(CURRENT_DATE() , INTERVAL 30 DAY)as data_final
                    ,rp.parcela_inicio as prazo_inicial
                    ,rp.parcela_fim    as prazo_final
                    ,p.preco_venda     as preco_a_prazo
                    ,case when rp.parcela_inicio = 0 then 'Sem Entrada' else 'Com Entrada' end as tipo_prazo_promocao
                    ,tp.id             as id_tipo_pagamento
                    ,tp.descricao      as tipo
                    ,f.id 		       as id_filial
                    ,'PREÇO PADRÃO'    as promocao
                    ,0   	           as id_promocao
                    ,concat('http://localhost:8082/',p.caminho_imagem) as imagem
                from produtonew p 
                left join cor c       on c.id = p.id_cor 
                left join voltagem v  on v.id = p.id_voltagem 
                left join filial f on true
                left join regra_parcelamento_padrao rp on true
                left join tipo_pagamento tp on tp.id = rp.id_tipo_pagamento 
                where 
                f.id = :idFilial2
                and p.id >= :validacaoFiltroPromocao
                ";
    }
}
