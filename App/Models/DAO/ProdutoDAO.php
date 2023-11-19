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
        $clausulaIdPromocao = empty($parametros['id_promocao']) ? '' : 'AND p.id = :id_promocao';
        // $clausulaTipoPromocao = empty($parametros['tipoPromocao']) ? '' : 'AND tipo = :tipoPromocao';
        // $clausulaIdDepartamento = empty($parametros['idDepartamento']) ? '' : 'AND id_departamento = :idDepartamento';
        // $clausulaIdSubdepartamento = empty($parametros['idSubdepartamento']) ? '' : 'AND id_sub_departamento = :idSubdepartamento';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : 'AND pm.id_produto = :idProduto';

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
                    ,'Sem Entrada'     as tipo_prazo_promocao
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
                    id_filial = :idFilial
                    $clausulaIdPromocao
                    $clausulaIdProduto";
    }
}
