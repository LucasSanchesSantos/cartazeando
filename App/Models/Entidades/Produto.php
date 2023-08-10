<?php

namespace App\Models\Entidades;

use App\Abstractions\Entity;

class Produto extends Entity
{
    protected int $idFilial;
    protected int $idProduto;
    protected int $idGradeX;
    protected int $idGradeY;
    protected ?string $produto;
    protected ?string $cor;
    protected ?string $voltagem;
    protected ?string $codigoFabricante;
    protected ?int $idDepartamento;
    protected ?string $departamento;
    protected ?string $idSubDepartamento;
    protected ?string $subDepartamento;
    protected ?string $marca;
    protected ?float $precoVenda;
    protected ?int $estoque;
    protected ?int $idPromocao;
    protected ?string $promocao;
    protected ?string $dataInicial;
    protected ?string $dataFinal;
    protected ?int $prazoInicial;
    protected ?int $prazoFinal;
    protected ?float $precoPartida;
    protected ?float $precoAPrazo;
    protected ?string $tipoVendaPromocao;
    protected ?string $tipoPrazoPromocao;
    protected ?string $tipo;
    protected ?int $prioridade;
    protected ?int $idPromocaoProdutoGrade;
    protected ?float $jurosMes;
    protected ?float $jurosAno;
    protected ?int $idPromocaoCcg;
    protected ?string $promocaoCcg;
    protected ?int $ordem;
    protected ?int $idTipoVendaPromocao;
    protected ?float $juroComposto;
    protected ?int $isDepartamento;

    public function __construct(array $produto, int $idFilial)
    {
        $this->setIdFilial($idFilial);
        $this->setIdProduto($produto['idproduto']);
        $this->setIdGradeX($produto['idgradex']);
        $this->setIdGradeY($produto['idgradey']);
        $this->setProduto($produto['produto']);
        $this->setCor($produto['cor']);
        $this->setVoltagem($produto['voltagem']);
        $this->setCodigoFabricante($produto['codigofabricante']);
        $this->setIdDepartamento($produto['iddepartamento']);
        $this->setDepartamento($produto['departamento']);
        $this->setIdSubDepartamento($produto['idsubdepartamento']);
        $this->setSubDepartamento($produto['subdepartamento']);
        $this->setMarca($produto['marca']);
        $this->setPrecoVenda(round(floatval($produto['precovenda']), 2));
        $this->setEstoque(intval($produto['estoque']));
        $this->setIdPromocao($produto['idpromocao']);
        $this->setPromocao($produto['promocao']);
        $this->setDataInicial($produto['datainicial']);
        $this->setDataFinal($produto['datafinal']);
        $this->setPrazoInicial($produto['prazoinicial']);
        $this->setPrazoFinal($produto['prazofinal']);
        $this->setPrecoPartida(round(floatval($produto['precopartida']), 2));
        $this->setPrecoAPrazo(round(floatval($produto['precoaprazo']), 2));
        $this->setTipoVendaPromocao($produto['tipovendapromocao']);
        $this->setTipoPrazoPromocao($produto['tipoprazopromocao']);
        $this->setTipo($produto['tipo']);
        $this->setPrioridade($produto['prioridade']);
        $this->setIdPromocaoProdutoGrade($produto['idpromocaoprodutograde']);
        $this->setJurosMes(round(floatval($produto['juromes']), 2));
        $this->setJurosAno(round(floatval($produto['jurosano']), 2));
        $this->setIdPromocaoCcg($produto['idpromocaoccg']);
        $this->setPromocaoCcg($produto['promocaoccg']);
        $this->setOrdem($produto['ordem']);
        $this->setIdTipoVendaPromocao($produto['idtipovendapromocao']);
        $this->setJuroComposto(round(floatval($produto['jurocomposto']), 2));
        $this->setIsDepartamento($produto['isdepartamento']);
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

    public function getProduto(): ?string
    {
        return $this->produto;
    }

    private function setProduto(?string $produto): self
    {
        $this->produto = $produto;

        return $this;
    }

    public function getCor(): ?string
    {
        return $this->cor;
    }

    private function setCor(?string $cor): self
    {
        $this->cor = $cor;

        return $this;
    }

    public function getVoltagem(): ?string
    {
        return $this->voltagem;
    }

    private function setVoltagem(?string $voltagem): self
    {
        $this->voltagem = $voltagem;

        return $this;
    }

    public function getCodigoFabricante(): ?string
    {
        return $this->codigoFabricante;
    }

    private function setCodigoFabricante(?string $codigoFabricante): self
    {
        $this->codigoFabricante = $codigoFabricante;

        return $this;
    }

    public function getIdDepartamento(): ?int
    {
        return $this->idDepartamento;
    }

    private function setIdDepartamento(?int $idDepartamento): self
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    public function getDepartamento(): ?string
    {
        return $this->departamento;
    }

    private function setDepartamento(?string $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function getIdSubDepartamento(): ?string
    {
        return $this->idSubDepartamento;
    }

    private function setIdSubDepartamento(?string $idSubDepartamento): self
    {
        $this->idSubDepartamento = $idSubDepartamento;

        return $this;
    }

    public function getSubDepartamento(): ?string
    {
        return $this->subDepartamento;
    }

    private function setSubDepartamento(?string $subDepartamento): self
    {
        $this->subDepartamento = $subDepartamento;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    private function setMarca(?string $marca): self
    {
        $this->marca = $marca;

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

    public function getEstoque(): ?int
    {
        return $this->estoque;
    }

    private function setEstoque(?int $estoque): self
    {
        $this->estoque = $estoque;

        return $this;
    }

    public function getIdPromocao(): ?int
    {
        return $this->idPromocao;
    }

    private function setIdPromocao(?int $idPromocao): self
    {
        $this->idPromocao = $idPromocao;

        return $this;
    }

    public function getPromocao(): ?string
    {
        return $this->promocao;
    }

    private function setPromocao(?string $promocao): self
    {
        $this->promocao = $promocao;

        return $this;
    }

    public function getDataInicial(): ?string
    {
        return $this->dataInicial;
    }

    private function setDataInicial(?string $dataInicial): self
    {
        $this->dataInicial = $dataInicial;

        return $this;
    }

    public function getDataFinal(): ?string
    {
        return $this->dataFinal;
    }

    private function setDataFinal(?string $dataFinal): self
    {
        $this->dataFinal = $dataFinal;

        return $this;
    }

    public function getPrazoInicial(): ?int
    {
        return $this->prazoInicial;
    }

    private function setPrazoInicial(?int $prazoInicial): self
    {
        $this->prazoInicial = $prazoInicial;

        return $this;
    }

    public function getPrazoFinal(): ?int
    {
        return $this->prazoFinal;
    }

    private function setPrazoFinal(?int $prazoFinal): self
    {
        $this->prazoFinal = $prazoFinal;

        return $this;
    }

    public function getPrecoPartida(): ?float
    {
        return $this->precoPartida;
    }

    private function setPrecoPartida(?float $precoPartida): self
    {
        $this->precoPartida = $precoPartida;

        return $this;
    }

    public function getPrecoAPrazo(): ?float
    {
        return $this->precoAPrazo;
    }

    private function setPrecoAPrazo(?float $precoAPrazo): self
    {
        $this->precoAPrazo = $precoAPrazo;

        return $this;
    }

    public function getTipoVendaPromocao(): ?string
    {
        return $this->tipoVendaPromocao;
    }

    private function setTipoVendaPromocao(?string $tipoVendaPromocao): self
    {
        $this->tipoVendaPromocao = $tipoVendaPromocao;

        return $this;
    }

    public function getTipoPrazoPromocao(): ?string
    {
        return $this->tipoPrazoPromocao;
    }

    private function setTipoPrazoPromocao(?string $tipoPrazoPromocao): self
    {
        $this->tipoPrazoPromocao = $tipoPrazoPromocao;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    private function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getPrioridade(): ?int
    {
        return $this->prioridade;
    }

    private function setPrioridade(?int $prioridade): self
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    public function getIdPromocaoProdutoGrade(): ?int
    {
        return $this->idPromocaoProdutoGrade;
    }

    private function setIdPromocaoProdutoGrade(?int $idPromocaoProdutoGrade): self
    {
        $this->idPromocaoProdutoGrade = $idPromocaoProdutoGrade;

        return $this;
    }

    public function getJurosMes(): ?float
    {
        return $this->jurosMes;
    }

    private function setJurosMes(?float $jurosMes): self
    {
        $this->jurosMes = $jurosMes;

        return $this;
    }

    public function getJurosAno(): ?float
    {
        return $this->jurosAno;
    }

    private function setJurosAno(?float $jurosAno): self
    {
        $this->jurosAno = $jurosAno;

        return $this;
    }

    public function getIdPromocaoCcg(): ?int
    {
        return $this->idPromocaoCcg;
    }

    private function setIdPromocaoCcg(?int $idPromocaoCcg): self
    {
        $this->idPromocaoCcg = $idPromocaoCcg;

        return $this;
    }

    public function getPromocaoCcg(): ?string
    {
        return $this->promocaoCcg;
    }

    private function setPromocaoCcg(?string $promocaoCcg): self
    {
        $this->promocaoCcg = $promocaoCcg;

        return $this;
    }

    public function getOrdem(): ?int
    {
        return $this->ordem;
    }

    private function setOrdem(?int $ordem): self
    {
        $this->ordem = $ordem;

        return $this;
    }

    public function getIdTipoVendaPromocao(): ?int
    {
        return $this->idTipoVendaPromocao;
    }

    private function setIdTipoVendaPromocao(?int $idTipoVendaPromocao): self
    {
        $this->idTipoVendaPromocao = $idTipoVendaPromocao;

        return $this;
    }

    public function getJuroComposto(): ?float
    {
        return $this->juroComposto;
    }

    private function setJuroComposto(?float $juroComposto): self
    {
        $this->juroComposto = $juroComposto;

        return $this;
    }

    public function getIsDepartamento(): ?int
    {
        return $this->isDepartamento;
    }

    private function setIsDepartamento(?int $isDepartamento): self
    {
        $this->isDepartamento = $isDepartamento;

        return $this;
    }
}
