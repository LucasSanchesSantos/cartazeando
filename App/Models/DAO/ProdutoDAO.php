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
        $clausulaDescricaoPromocao = empty($parametros['descricaoPromocao']) ? '' : 'AND promocao = :descricaoPromocao';
        $clausulaTipoPromocao = empty($parametros['tipoPromocao']) ? '' : 'AND tipo = :tipoPromocao';
        $clausulaIdDepartamento = empty($parametros['idDepartamento']) ? '' : 'AND id_departamento = :idDepartamento';
        $clausulaIdSubdepartamento = empty($parametros['idSubdepartamento']) ? '' : 'AND id_sub_departamento = :idSubdepartamento';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : 'AND id_produto = :idProduto';

        return "SELECT 
        *
    FROM 
        (
            SELECT
                *
                ,CONCAT('https://s3-sa-east-1.amazonaws.com/static.gazinatacado.com.br/thumb/', LPAD(id_produto, 6, 0), LPAD            (id_grade_x, 4, 0), '01150.jpg') AS imagem
            FROM
                produto
            WHERE
                id_filial = :idFilial
                $clausulaDescricaoPromocao
                $clausulaTipoPromocao
                $clausulaIdDepartamento
                $clausulaIdSubdepartamento
                $clausulaIdProduto
        ) p
    LEFT JOIN (
            SELECT
                u.id_filial
                ,u.numero_filial
                ,CONCAT(LPAD(id_empresa,2,'0'),'.',LPAD(u.numero_filial,3,'0'), ' - ',u.cidade) AS filial
                ,tf.descricao AS tipo_formato
            FROM usuario u
            LEFT JOIN tipo_formato tf ON tf.id = u.id_tipo_formato
            LEFT JOIN tipo_permissao tp ON tp.id = u.id_tipo_permissao
            WHERE
                u.id_tipo_permissao != 2
            GROUP BY 1,2,3,4) tf on tf.id_filial = p.id_filial";
    }
}
