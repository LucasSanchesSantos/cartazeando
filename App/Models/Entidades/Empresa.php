<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Empresa extends Entity
{
    protected int $id;
    protected string $descricao;
    protected string $cnpj;

    public function __construct(array $empresa)
    {
        $this->setId($empresa['id']);
        $this->setDescricao($empresa['descricao']);
        $this->setCnpj($empresa['cnpj']);

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

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    private function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

}
