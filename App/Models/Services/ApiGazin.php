<?php

namespace App\Models\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ApiGazin
{
    protected Client $client;
    protected string $url;
    protected string $token;

    protected string $uriRelatorioProdutos = 'varejo/relatorio/produtos';
    protected string $uriRelatorioProdutosPromocoes = 'varejo/relatorio/promocoes';

    public function __construct()
    {
        $this->client = new Client();
        $this->url = URL_API_GAZIN;
        $this->token = TOKEN_API_GAZIN;
    }

    public function relatorioProdutosPorFilial(int $idFilial): array
    {
        $dataAtual = date('Y-m-d');

        $urlCompleta = "{$this->url}{$this->uriRelatorioProdutos}";

        $parametros = [
            'idfilial' => $idFilial,
            'feirao' => 0,
            'datapromocao' => $dataAtual
        ];

        try {
            $resposta = $this->client->get($urlCompleta, $this->getOpcoes($parametros));

            return json_decode($resposta->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function relatorioProdutosPromocoesPorFilial(int $idFilial): array
    {
        $dataAtual = date('Y-m-d');

        $urlCompleta = "{$this->url}{$this->uriRelatorioProdutosPromocoes}";

        $parametros = [
            'idfilial' => $idFilial,
            'datapromocao' => $dataAtual
        ];

        try {
            $resposta = $this->client->get($urlCompleta, $this->getOpcoes($parametros));

            return json_decode($resposta->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    private function getOpcoes(array $parametros = []): array
    {
        return [
            RequestOptions::HEADERS => [
                'Authorization' => "Bearer {$this->token}"
            ],
            RequestOptions::QUERY => $parametros
        ];
    }
}
