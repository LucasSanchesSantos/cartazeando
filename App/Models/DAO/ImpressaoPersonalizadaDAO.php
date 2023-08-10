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
                    ,p.id_grade_x
                    ,p.id_grade_y 
                    ,p.produto
                FROM produto p 
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

    public function getDeflacao(int $quantidadeParcelas): ?array
    {
        $sql = $this->getSqlDeflacao();

        $parametro = ['quantidadeParcelas' => $quantidadeParcelas];

        $resultado = $this->selectOneWithBindValue($sql,$parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getSqlDeflacao(): string
    {
        return 
        "SELECT 
            c.valor_deflacao
            ,t.descricao as tipo_pagamento
        FROM controle_deflacao c
        left join tipo_pagamento t on t.id = c.id_tipo_pagamento
        WHERE c.id_tipo_pagamento = 2
        AND c.parcela_ate = :quantidadeParcelas
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
            id_produto
            ,id_grade_x
            ,id_grade_y
            ,produto
            ,cor
            ,voltagem
        FROM produto
        WHERE id_produto = CAST(:idProduto AS SIGNED)
        AND id_grade_x = CAST(:idGradeX AS SIGNED)
        AND id_grade_y = CAST(:idGradeY AS SIGNED)
        GROUP BY 1,2,3,4,5,6
        ";
    }


    public function getTotalParcelas(): ?array
    {
        $sql = $this->getSqlTotalParcelas();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getSqlTotalParcelas(): string
    {
        return 
        "SELECT 
            parcela_ate
        FROM controle_deflacao c
        WHERE id_tipo_pagamento = 2
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
                u.id_filial,
                u.numero_filial,
                CONCAT(LPAD(u.id_empresa, 2, '0'), '.', LPAD(u.numero_filial, 3, '0'), ' - ', u.cidade) AS filial
            FROM
                usuario u
                LEFT JOIN tipo_formato tf ON tf.id = u.id_tipo_formato
                LEFT JOIN tipo_permissao tp ON tp.id = u.id_tipo_permissao
            GROUP BY
                u.id_filial,
                u.numero_filial,
                3";
    }

    private function getSqlFilialEspecifica(): string
    {
        return "SELECT
                u.id_filial,
                u.numero_filial,
                CONCAT(LPAD(u.id_empresa, 2, '0'), '.', LPAD(u.numero_filial, 3, '0'), ' - ', u.cidade) AS filial
            FROM
                usuario u
            WHERE
                u.id = :idUsuario
            GROUP BY
                u.id_filial,
                u.numero_filial,
                3";
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
