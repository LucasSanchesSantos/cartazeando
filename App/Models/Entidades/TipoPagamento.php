<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class TipoPagamento extends Entity
{
    protected int $id;
    protected string $tipoPagamento;

    public function __construct(array $tipoPagamento)
    {
        $this->setId($tipoPagamento['id']);
        $this->setTipoPagamento($tipoPagamento['tipoPagamento']);
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

    public function getTipoPagamento(): string
    {
        return $this->tipoPagamento;
    }

    private function setTipoPagamento(string $tipoPagamento): self
    {
        $this->tipoPagamento = $tipoPagamento;

        return $this;
    }

    
}
