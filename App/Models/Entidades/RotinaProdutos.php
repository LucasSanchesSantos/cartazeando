<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class RotinaProdutos extends Entity
{
    protected int $idFilial;
    protected string $dataHoraExecucao;

    public function __construct(int $idFilial, string $dataHoraExecucao)
    {
        $this->setIdFilial($idFilial);
        $this->setDataHoraExecucao($dataHoraExecucao);
    }

    public function getIdFilial(): int
    {
        return $this->idFilial;
    }

    private function setIdFilial(int $idFilial): self
    {
        $this->idFilial = $idFilial;

        return $this;
    }

    public function getDataHoraExecucao(): string
    {
        return $this->dataHoraExecucao;
    }

    public function setDataHoraExecucao(string $dataHoraExecucao): self
    {
        $this->dataHoraExecucao = $dataHoraExecucao;

        return $this;
    }
}
