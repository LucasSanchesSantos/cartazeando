<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class ImpressaoPersonalizada extends Entity
{
    protected int $id;
    protected string $tipoCartaz;
    protected float $dimensaoInicial;
    protected float $dimensaoFinal;

    public function __construct(array $impressaoPersonalizada)
    {
        $this->setId($impressaoPersonalizada['id']);
        $this->setTipoCartaz($impressaoPersonalizada['TipoCartaz']);
        $this->setDimensaoInicial($impressaoPersonalizada['DimensaoInicial']);
        $this->setDimensaoFinal($impressaoPersonalizada['DimensaoFinal']);
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

    public function getTipoCartaz(): int
    {
        return $this->id;
    }

    private function setTipoCartaz(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDimensaoInicial(): int
    {
        return $this->id;
    }

    private function setDimensaoInicial(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDimensaoFinal(): int
    {
        return $this->id;
    }

    private function setDimensaoFinal(int $id): self
    {
        $this->id = $id;

        return $this;
    }

}
