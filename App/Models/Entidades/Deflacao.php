<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Deflacao extends Entity
{
    public int $id;
    public int $id_tipo_pagamento;
    public int $parcela_de;
    public int $parcela_ate;
    public float $valor_deflacao;


    public function __construct(array $deflacao)
    {
        $this->setId($deflacao['id']);
        $this->setId_tipo_pagamento($deflacao['id_tipo_pagamento']);
        $this->setParcela_de($deflacao['parcela_de']);
        $this->setparcela_ate($deflacao['parcela_ate']);
        $this->setvalor_deflacao($deflacao['valor_deflacao']);

    }

    public function getId(): int
    {
        return $this->id;
    }

    private function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getid_tipo_pagamento(): int
    {
        return $this->id_tipo_pagamento;
    }

    private function setid_tipo_pagamento(int $id_tipo_pagamento): self
    {
        $this->id_tipo_pagamento = $id_tipo_pagamento;

        return $this;
    }
    
    public function getparcela_de(): int
    {
        return $this->parcela_de;
    }

    private function setparcela_de(int $parcela_de): self
    {
        $this->parcela_de = $parcela_de;

        return $this;
    }

    public function getparcela_ate(): int
    {
        return $this->parcela_ate;
    }

    private function setparcela_ate(int $parcela_ate): self
    {
        $this->parcela_ate = $parcela_ate;

        return $this;
    }

    public function getvalor_deflacao(): float
    {
        return $this->valor_deflacao;
    }

    private function setvalor_deflacao(float $valor_deflacao): self
    {
        $this->valor_deflacao = $valor_deflacao;

        return $this;
    }

}
