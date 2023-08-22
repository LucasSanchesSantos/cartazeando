<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class TipoCartaz extends Entity
{
    protected int $id;
    protected string $descricao;
    protected string $dimensaoInicial;
    protected string $dimensaoFinal;
    protected int $qtdFolhas;


    public function __construct(array $tipoCartaz)
    {
        $this->setId($tipoCartaz['id']);
        $this->setDescricao($tipoCartaz['descricao']);
        $this->setDimensaoIinicial($tipoCartaz['dimensaoInicial']);
        $this->setDimensaoIfinal($tipoCartaz['dimensaoFinal']);
        $this->setQtdFolhas($tipoCartaz['qtdFolhas']);

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

    public function getDimensaoInicial(): string
    {
        return $this->dimensaoInicial;
    }

    private function setDimensaoIinicial(string $dimensaoInicial): self
    {
        $this->dimensaoInicial = $dimensaoInicial;

        return $this;
    }

    public function getDimensaofinal(): string
    {
        return $this->dimensaoFinal;
    }

    private function setDimensaoIfinal(string $dimensaoFinal): self
    {
        $this->dimensaoFinal = $dimensaoFinal;

        return $this;
    }

    public function getQtdFolhas(): string
    {
        return $this->qtdFolhas;
    }

    private function setQtdFolhas(string $qtdFolhas): self
    {
        $this->qtdFolhas = $qtdFolhas;

        return $this;
    }
    
}
