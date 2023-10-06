<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Cor extends Entity
{
    protected int $id;
    protected string $descricao;

    public function __construct(array $cor)
    {
        $this->setId($cor['id']);
        $this->setDescricao($cor['descricao']);
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
