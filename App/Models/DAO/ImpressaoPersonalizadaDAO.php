<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;

class ImpressaoPersonalizadaDAO extends DAO
{

    public function getProdutos(): array
    {
        $sql = $this->getSqlProdutos();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlProdutos(): string
    {
        return "SELECT 
                    p.id_produto
                    ,p.id_cor as id_grade_x
                    ,p.id_voltagem as id_grade_y 
                    ,p.produto
                FROM produtonew p 
                GROUP BY 1,2,3,4";
    }

    public function getTiposCartazes(): ?array
    {
        $sql = $this->getSqlTiposCartazes();
        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlTiposCartazes(): string
    {
        return "SELECT
                    tipo_cartaz
                    ,dimensao_inicial
                    ,dimensao_final
                    ,concat(qtd_folhas, CASE WHEN qtd_folhas = 1 THEN ' Folha' ELSE ' Folhas' END) AS qtd_folhas
                FROM tipo_cartaz
                ORDER BY tipo_cartaz DESC 
                ";
    }

    public function getDescricaoProduto(string $idprodutoxy): ?array
    {
        $sql = $this->getSqlDescricaoProduto();

        $explode = explode(".", $idprodutoxy);

        $parametro = [
            'idProduto' => $explode[0],
            'idGradeX' => $explode[1],
            'idGradeY' => $explode[2],
        ];

        $resultado = $this->selectOneWithBindValue($sql,$parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getSqlDescricaoProduto(): string
    {
        return 
        "SELECT 
            p.id_produto
            ,p.id_cor as id_grade_x
            ,p.id_voltagem as id_grade_y
            ,p.produto
            ,c.descricao as cor
            ,v.descricao as voltagem
        FROM produtonew p
        left join cor c on c.id = p.id_cor
        left join voltagem v on v.id = p.id_voltagem
        WHERE p.id_produto = CAST(:idProduto AS SIGNED)
        AND c.id = CAST(:idGradeX AS SIGNED)
        AND v.id = CAST(:idGradeY AS SIGNED)
        ";
    }

    public function getFiliais(): ?array
    {
        $sql = $this->getSqlFiliais();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getFilialEspecifica(int $idUsuario): ?array
    {
        $sql = $this->getSqlFilialEspecifica();

        $parametro = [
            'idUsuario' => $idUsuario
        ];

        $resultado = $this->selectWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlFiliais(): string
    {
        return "SELECT
                    id as id_filial,
                    numero as numero_filial,
                    cidade,
                    CONCAT(LPAD(numero, 3, '0'), ' - ', cidade) AS filial
                FROM
                filial
                ORDER BY
                id_filial";
    }

    private function getSqlFilialEspecifica(): string
    {
        return "SELECT
                    f.id as id_filial,
                    f.numero as numero_filial,
                    f.cidade,
                    CONCAT(LPAD(f.numero, 3, '0'), ' - ', f.cidade) AS filial
                FROM
                filial f 
                left join usuario u on u.id_filial = f.id
                where u.id = :idUsuario
                ORDER BY
                id_filial";

                
    }

    public function getDadosFilial(string $idfilial): ?array
    {
        $sql = $this->getSqlDadosFilial();
        
        $parametro = ['idfilial' => $idfilial];

        $resultado = $this->selectOneWithBindValue($sql,$parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }
    

    public function getSqlDadosFilial(): string
    {
        return 
        "SELECT 
            u.id_filial 
            ,u.numero_filial 
            ,CONCAT(LPAD(id_empresa,2,'0'),'.',LPAD(u.numero_filial,3,'0'), ' - ',u.cidade) AS filial
            ,tf.descricao AS tipo_formato
        FROM usuario u
        LEFT JOIN tipo_formato tf ON tf.id = u.id_tipo_formato
        LEFT JOIN tipo_permissao tp ON tp.id = u.id_tipo_permissao
        WHERE 
            u.id_filial = :idfilial
            AND u.id_tipo_permissao != 1
        GROUP BY 1,2,3,4
        ";
    }
}
