<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;
use App\Models\Entidades\ProdutoCadastro;

class ProdutoCadastroDAO extends DAO
{
    public function listar(): ?array
    {
        $sql = $this->getSqlListarProdutosCadastro();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarProdutosCadastro(): string
    {
        return 
            "SELECT
                p.*
                ,c.descricao as cor
                ,v.descricao as voltagem
            FROM produtonew p
            left join cor c on c.id = p.id_cor
            left join voltagem v on v.id = p.id_voltagem";
    }

    public function cadastrar(ProdutoCadastro $produtoCadastro): bool
    {
        $parametros = $produtoCadastro->toArray(true);

        return $this->insert(
            'produtonew',
            $parametros
        );
    }

    public function editar(ProdutoCadastro $produtoCadastro): bool
    {
        $parametros = $produtoCadastro->toArray(true, ['id']);

        return $this->update(
            'produtonew',
            $parametros,
            "id = {$produtoCadastro->getId()}"
        );
    }


    public function getDadosProdutoCadastro(int $id): ?array
    {
        $sql = $this->getSqlProdutoCadastro();

        $parametro = [
            'id' => $id
        ];

        $resultado = $this->selectOneWithBindValue($sql, $parametro);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlProdutoCadastro(): string
    {
        return "SELECT
                *
            FROM
                produtonew
            WHERE id = :id    
            ";
    }

    public function deletar($produtoCadastro)
    {        
        return $this->delete(
            'produtonew',
            'id',
            $produtoCadastro    
        );
    }


    public function listarCadastroPromocao(): ?array
    {
        $sql = $this->getSqlListarProdutosCadastroPromocao();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlListarProdutosCadastroPromocao(): string
    {
        return "SELECT DISTINCT
                id_produto
                ,CONCAT(id_produto, ' - ',produto) as produto
            FROM
                produtonew";
    }
}
