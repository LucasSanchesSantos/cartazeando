<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Impressoes extends Entity
{
    protected int $id;
    protected string $idPromocao;
    protected int $idProduto;
    protected int $idGradeX;
    protected int $idGradeY;
    protected int $idTipoPagamento;
    protected float $precoAPrazo;
    protected int $idFilial;
    protected int $idUsuario;
    protected string $dataHoraImpressao;

    public function __construct(array $impressoes)
    {
        $this->setId($impressoes['id']);
        $this->setIdPromocao($impressoes['id_promocao']);
        $this->setIdProduto($impressoes['id_produto']);
        $this->setIdGradeX($impressoes['id_grade_x']);
        $this->setIdGradeY($impressoes['id_grade_y']);
        $this->setIdTipoPagamento($impressoes['id_tipo_pagamento']);
        $this->setPrecoAPrazo($impressoes['preco_a_prazo']);
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

    public function getIdProduto(): int
    {
        return $this->idProduto;
    }

    private function setIdProduto(int $idProduto): self
    {
        $this->idProduto = $idProduto;

        return $this;
    }
    
    public function getIdGradeX(): int
    {
        return $this->idGradeX;
    }

    private function setIdGradeX(int $idGradeX): self
    {
        $this->idGradeX = $idGradeX;

        return $this;
    }
    
    public function getIdGradeY(): int
    {
        return $this->idGradeY;
    }

    private function setIdGradeY(int $idGradeY): self
    {
        $this->idGradeY = $idGradeY;

        return $this;
    }
    
    public function getIdTipoPagamento(): int
    {
        return $this->idTipoPagamento;
    }

    private function setIdTipoPagamento(int $idTipoPagamento): self
    {
        $this->idTipoPagamento = $idTipoPagamento;

        return $this;
    }
    
    public function getPrecoAPrazo(): float
    {
        return $this->precoAPrazo;
    }

    private function setPrecoAPrazo(float $precoAPrazo): self
    {
        $this->precoAPrazo = $precoAPrazo;

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
