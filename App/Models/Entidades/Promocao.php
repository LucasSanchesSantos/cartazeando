<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Promocao extends Entity
{
    protected int $id;
    protected string $descricao;
    protected ?string $dataCadastro;
    protected int $idProduto;
    protected int $idCor;
    protected int $idVoltagem;
    protected int $idFilial;
    protected float $valorPromocao;
    protected string $dataInicio;
    protected string $dataFim;
    protected int $idTipoPagamento;
    protected int $parcelaInicio;
    protected int $parcelaFim;
    protected int $idSituacao;
    
    public function __construct(array $promocao){
        $this->setId($promocao['id']);
        $this->setDescricao($promocao['descricao']);
        $this->setDataCadastro($promocao['data_cadastro']);
        $this->setIdProduto($promocao['id_produto']);
        $this->setIdCor($promocao['id_cor']);
        $this->setIdVoltagem($promocao['id_voltagem']);
        $this->setIdFilial($promocao['id_filial']);
        $this->setValorPromocao(round(floatval($promocao['valor_promocao']), 2));
        $this->setDataInicio($promocao['data_inicio']);
		$this->setDataFim($promocao['data_fim']);
        $this->setIdTipoPagamento($promocao['id_tipo_pagamento']);
        $this->setParcelaInicio($promocao['parcela_inicio']);
        $this->setParcelaFim($promocao['parcela_fim']);
        $this->setIdSituacao($promocao['id_situacao']);
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

    public function getDataCadastro(): ?string
    {
        return $this->dataCadastro;
    }

    private function setDataCadastro(?string $dataCadastro): self
    {
        $this->dataCadastro = $dataCadastro;

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

    public function getIdCor(): int
    {
        return $this->idCor;
    }

    private function setIdCor(int $idCor): self
    {
        $this->idCor = $idCor;

        return $this;
    }

    public function getIdVoltagem(): int
    {
        return $this->idVoltagem;
    }

    private function setIdVoltagem(int $idVoltagem): self
    {
        $this->idVoltagem = $idVoltagem;

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

    public function getValorPromocao(): float
    {
        return $this->valorPromocao;
    }

    private function setValorPromocao(float $valorPromocao): self
    {
        $this->valorPromocao = $valorPromocao;

        return $this;
    }

    public function getDataInicio(): string
    {
        return $this->dataInicio;
    }

    private function setDataInicio(string $dataInicio): self
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    public function getDataFim(): string
    {
        return $this->dataFim;
    }

    private function setDataFim(string $dataFim): self
    {
        $this->dataFim = $dataFim;

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

    public function getParcelaInicio(): int
    {
        return $this->parcelaInicio;
    }

    private function setParcelaInicio(int $parcelaInicio): self
    {
        $this->parcelaInicio = $parcelaInicio;

        return $this;
    }

    public function getParcelaFim(): int
    {
        return $this->parcelaFim;
    }

    private function setParcelaFim(int $parcelaFim): self
    {
        $this->parcelaFim = $parcelaFim;

        return $this;
    }

    public function getIdSituacao(): int
    {
        return $this->idSituacao;
    }

    private function setIdSituacao(int $idSituacao): self
    {
        $this->idSituacao = $idSituacao;

        return $this;
    }
}