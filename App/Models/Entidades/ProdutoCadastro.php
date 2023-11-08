<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class ProdutoCadastro extends Entity
{
    protected int $id;
    protected int $idProduto;
    protected int $idCor;
    protected int $idVoltagem;
    protected string $produto;
    protected float $precoVenda;    
    protected string $imagem;
    protected string $caminhoImagem;


    public function __construct(array $produto)
    {
        $this->setId($produto['id']);
        $this->setIdProduto($produto['id_produto']);
        $this->setIdCor($produto['id_cor']);
        $this->setIdVoltagem($produto['id_voltagem']);
        $this->setProduto($produto['produto']);
        $this->setPrecoVenda(round(floatval($produto['preco_venda']), 2));
        $this->setImagem($produto['imagem']);
        $this->setCaminhoImagem($produto['caminho_imagem']);

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

    public function getProduto(): ?string
    {
        return $this->produto;
    }

    private function setProduto(?string $produto): self
    {
        $this->produto = $produto;

        return $this;
    }

    public function getPrecoVenda(): ?float
    {
        return $this->precoVenda;
    }

    private function setPrecoVenda(?float $precoVenda): self
    {
        $this->precoVenda = $precoVenda;

        return $this;
    }

    public function getImagem(): ?string
    {
        return $this->imagem;
    }

    private function setImagem(?string $imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }

    public function getCaminhoImagem(): ?string
    {
        return $this->caminhoImagem;
    }

    private function setCaminhoImagem(?string $caminhoImagem): self
    {
        $this->caminhoImagem = $caminhoImagem;

        return $this;
    }
}
