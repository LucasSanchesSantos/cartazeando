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
                    case when i.id_promocao = 0 then 'PREÇO PADRÃO' else CONCAT(i.id_promocao,' - ', p.descricao) end as promocao
                    ,CONCAT(f.numero,' - ', f.cidade) as filial
                    ,coalesce(p.id_produto,i.id_produto) as id_produto
                    ,p2.produto
                    ,CASE WHEN i.id_promocao = 0 then 'Carnê' else tp.descricao end as tipo_pagamento
                    ,i.preco_a_prazo as valor_promocao
                    ,i.data_hora_impressao as data_impressao
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                left join tipo_pagamento tp on tp.id = p.id_tipo_pagamento
                order by i.data_hora_impressao";
    }


    public function Filtrar(array $parametros): ?array
    {
        $sql = $this->getSqlFiltrar($parametros);

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

    private function getSqlFiltrar(array $parametros): string
    {
        $clausulaIdPromocao = empty($parametros['promocao']) ? '' : ' AND i.id_promocao = :idPromocao';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : ' AND i.id_produto = :idProduto';
        $clausulaIdFilial = empty($parametros['idFilial']) ? '' : ' AND i.id_filial = :idFilial';
        $clausulaData = empty($parametros['dataInicio']) ? '' : ' AND date(i.data_hora_impressao) between :dataInicio and :dataFim';

        return "SELECT
                    case when i.id_promocao = 0 then 'PREÇO PADRÃO' else CONCAT(i.id_promocao,' - ', p.descricao) end as promocao
                    ,CONCAT(f.numero,' - ', f.cidade) as filial
                    ,coalesce(p.id_produto,i.id_produto) as id_produto
                    ,p2.produto
                    ,CASE WHEN i.id_promocao = 0 then 'Carnê' else tp.descricao end as tipo_pagamento
                    ,i.preco_a_prazo as valor_promocao
                    ,i.data_hora_impressao as data_impressao
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                left join tipo_pagamento tp on tp.id = p.id_tipo_pagamento
                where i.id is not null
                $clausulaIdPromocao
                $clausulaIdProduto
                $clausulaIdFilial
                $clausulaData";
    }


    public function listarRelatorioQuantidade(): ?array
    {
        $sql = $this->getSqlDadosRelatorioQuantidade();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlDadosRelatorioQuantidade(): string
    {
        return "SELECT
                    case when i.id_promocao = 0 then 'PREÇO PADRÃO' else CONCAT(i.id_promocao,' - ', p.descricao) end as promocao
                    ,CONCAT(f.numero,' - ', f.cidade) as filial
                    ,DATE(i.data_hora_impressao) as data_impressao
                    ,count(i.id_promocao) as quantidade_impressoes
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                left join tipo_pagamento tp on tp.id = p.id_tipo_pagamento
                group by 1,2,3
                order by i.data_hora_impressao";
    }


    public function listarRelatorioProduto(): ?array
    {
        $sql = $this->getSqlDadosRelatorioProduto();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlDadosRelatorioProduto(): string
    {
        return "SELECT
                    CONCAT(f.numero,' - ', f.cidade) as filial
                    ,i.id_produto as id_produto
                    ,p2.produto
                    ,DATE(i.data_hora_impressao) as data_impressao
                    ,count(i.id_promocao) as quantidade_impressoes
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                group by 1,2,3,4
                order by i.data_hora_impressao";
    }


    public function ListarImpressoesPorFilial(): ?array
    {
        $sql = $this->getSqlDadosImpressoesPorFilial();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlDadosImpressoesPorFilial(): string
    {
        return "SELECT
                    CONCAT(f.numero,' - ', f.cidade) as filial
                    ,DATE(i.data_hora_impressao) as data_impressao
                    ,count(i.id_promocao) as quantidade_impressoes
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                group by 1,2
                order by i.data_hora_impressao";
    }

    public function FiltrarImpressoesPorFilial(array $parametros): ?array
    {
        $sql = $this->getSqlFiltrarImpressoesPorFilial($parametros);

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

    private function getSqlFiltrarImpressoesPorFilial(array $parametros): string
    {
        $clausulaIdPromocao = empty($parametros['promocao']) ? '' : ' AND i.id_promocao = :idPromocao';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : ' AND i.id_produto = :idProduto';
        $clausulaIdFilial = empty($parametros['idFilial']) ? '' : ' AND i.id_filial = :idFilial';
        $clausulaData = empty($parametros['dataInicio']) ? '' : ' AND date(i.data_hora_impressao) between :dataInicio and :dataFim';

        return "SELECT
                    CONCAT(f.numero,' - ', f.cidade) as filial
                    ,DATE(i.data_hora_impressao) as data_impressao
                    ,count(i.id_promocao) as quantidade_impressoes
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                WHERE 
                    i.id is not null 
                $clausulaIdPromocao
                $clausulaIdProduto
                $clausulaIdFilial
                $clausulaData

                group by 1,2
                order by i.data_hora_impressao";
    }



    public function FiltrarRelatorioProduto(array $parametros): ?array
    {
        $sql = $this->getSqlFiltrarRelatorioProduto($parametros);

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

    private function getSqlFiltrarRelatorioProduto(array $parametros): string
    {
        $clausulaIdPromocao = empty($parametros['promocao']) ? '' : ' AND i.id_promocao = :idPromocao';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : ' AND i.id_produto = :idProduto';
        $clausulaIdFilial = empty($parametros['idFilial']) ? '' : ' AND i.id_filial = :idFilial';
        $clausulaData = empty($parametros['dataInicio']) ? '' : ' AND date(i.data_hora_impressao) between :dataInicio and :dataFim';

        return "SELECT
                    CONCAT(f.numero,' - ', f.cidade) as filial
                    ,i.id_produto as id_produto
                    ,p2.produto
                    ,DATE(i.data_hora_impressao) as data_impressao
                    ,count(i.id_promocao) as quantidade_impressoes
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                where
                    i.id is not null 
                $clausulaIdPromocao
                $clausulaIdProduto
                $clausulaIdFilial
                $clausulaData
                group by 1,2,3,4
                order by i.data_hora_impressao";
    }


    public function FiltrarRelatorioQuantidade(array $parametros): ?array
    {
        $sql = $this->getSqlFiltrarRelatorioQuantidade($parametros);

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

    private function getSqlFiltrarRelatorioQuantidade(array $parametros): string
    {
        $clausulaIdPromocao = empty($parametros['promocao']) ? '' : ' AND i.id_promocao = :idPromocao';
        $clausulaIdProduto = empty($parametros['idProduto']) ? '' : ' AND i.id_produto = :idProduto';
        $clausulaIdFilial = empty($parametros['idFilial']) ? '' : ' AND i.id_filial = :idFilial';
        $clausulaData = empty($parametros['dataInicio']) ? '' : ' AND date(i.data_hora_impressao) between :dataInicio and :dataFim';

        return "SELECT
                    case when i.id_promocao = 0 then 'PREÇO PADRÃO' else CONCAT(i.id_promocao,' - ', p.descricao) end as promocao
                    ,CONCAT(f.numero,' - ', f.cidade) as filial
                    ,DATE(i.data_hora_impressao) as data_impressao
                    ,count(i.id_promocao) as quantidade_impressoes
                FROM impressoes i 
                left join promocao p on p.id = i.id_promocao
                left join filial f on f.id = i.id_filial
                left join produtonew p2 on p2.id_produto in (p.id_produto,i.id_produto)
                left join tipo_pagamento tp on tp.id = p.id_tipo_pagamento
                where
                    i.id is not null 
                $clausulaIdPromocao
                $clausulaIdProduto
                $clausulaIdFilial
                $clausulaData
                
                group by 1,2,3
                order by i.data_hora_impressao
                ";
    }
}
