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

}
