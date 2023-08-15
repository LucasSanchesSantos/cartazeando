<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class TipoPagamento extends Entity
{
    protected int $id;
    protected string $descricao;

    public function __construct(array $tipoPagamento)
    {
        $this->setId($tipoPagamento['id']);
        $this->setDescricao($tipoPagamento['descricao']);
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

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    private function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    
}
