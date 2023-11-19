<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Impressoes extends Entity
{
    protected int $id;
    protected int $idPromocao;
    protected int $idFilial;
    protected int $idUsuario;
    protected string $dataHoraImpressao;

    public function __construct(array $impressoes)
    {
        $this->setId($impressoes['id']);
        $this->setIdPromocao($impressoes['id_promocao']);
        $this->setIdFilial($impressoes['id_filial']);
        $this->setIdUsuario($impressoes['id_usuario']);
        $this->setDataHoraImpressao($impressoes['data_hora_impressao']);

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

    public function getIdPromocao(): int
    {
        return $this->idPromocao;
    }

    private function setIdPromocao(int $idPromocao): self
    {
        $this->idPromocao = $idPromocao;

        return $this;
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
    
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    private function setIdUsuario(int $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getDataHoraImpressao(): string
    {
        return $this->dataHoraImpressao;
    }

    private function setDataHoraImpressao(string $dataHoraImpressao): self
    {
        $this->dataHoraImpressao = $dataHoraImpressao;

        return $this;
    }
}
