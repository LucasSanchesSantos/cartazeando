<?php

namespace App\Controllers;

use App\Abstractions\Controller;
use App\Lib\Sessao;
use App\Models\DAO\CorDAO;
use App\Models\DAO\ProdutoCadastroDAO;
use App\Models\DAO\VoltagemDAO;
use App\Models\Entidades\ProdutoCadastro;

class ProdutoCadastroController extends Controller
{
    public function index(): void
    {
        $produtoCadastroDAO = new ProdutoCadastroDAO();
        $corDAO = new CorDAO();
        $voltagemDAO = new VoltagemDAO();
        
        self::setViewParam('produtoCadastro', $produtoCadastroDAO->listar());
        self::setViewParam('cor', $corDAO->listar());
        self::setViewParam('voltagem', $voltagemDAO->listar());
        
        $this->render('produtoCadastro/index');
    }

    public function edicao(): void
    {
        $produtoCadastroDAO = new ProdutoCadastroDAO();
        $corDAO = new CorDAO();
        $voltagemDAO = new VoltagemDAO();

        self::setViewParam('produtoCadastro', $produtoCadastroDAO->getDadosProdutoCadastro($_GET['id']));
        self::setViewParam('cor', $corDAO->listar());
        self::setViewParam('voltagem', $voltagemDAO->listar());

        $this->render('produtoCadastro/editar');
    }

    public function cadastro(): void
    {
        $corDAO = new CorDAO();
        $voltagemDAO = new VoltagemDAO();

        self::setViewParam('cor', $corDAO->listar());
        self::setViewParam('voltagem', $voltagemDAO->listar());

        $this->render('produtoCadastro/cadastrar');
    }

        // if($extensao != 'png'  or  $extensao != 'jpg'){
        //     die(Sessao::gravaErro("Formato de imagem inválido! Insira um formato png, ou jpg."));
        // }

    public function cadastrar(): void
    {
        $arquivo = $_FILES['imagem'];

        if($arquivo['error']){
            die("Falha ao enviar arquivo.");
        }
        
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

        // if($extensao != 'png'  or  $extensao != 'jpg'){
        //     die(Sessao::gravaErro("Formato de imagem inválido! Insira um formato png, ou jpg."));
        // }

        $path = 'App/Views/ImagensProdutos/';
        $caminhoImagem = 'App/Views/ImagensProduto/' . $novoNomeDoArquivo . "." . $extensao;

        //move_uploaded_file($arquivo['tmp_name'],$path . $novoNomeDoArquivo . "." . $extensao);

        move_uploaded_file($arquivo['tmp_name'],$path . $novoNomeDoArquivo . "." . $extensao);

        $produtoCadastro = new ProdutoCadastro([
            'id' => 0,
            'id_produto' => intval($_POST['id_produto']),
            'id_cor' => intval($_POST['id_cor']),
            'id_voltagem' => intval($_POST['id_voltagem']),
            'produto' => strval($_POST['produto']),
            'preco_venda' => floatval($_POST['preco_venda']),
            'imagem' => strval($novoNomeDoArquivo),
            'caminho_imagem' => strval($caminhoImagem),
        ]);

        $produtoCadastroDAO = new ProdutoCadastroDAO();

        try {
            $produtoCadastroDAO->cadastrar($produtoCadastro);

            Sessao::gravaSucesso("Produto cadastrado com sucesso!");
            $this->redirect('produtoCadastro', 'index');
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao cadastrar produto. Contate o suporte.");
            $this->redirect('produtoCadastro', 'cadastro');
        }
    }

    public function editar(): void
    {
        $produtoCadastro = new ProdutoCadastro(
            $this->getDadosProdutoCadastro()
        );

        $produtoCadastroDAO = new ProdutoCadastroDAO();

        try {
            $produtoCadastroDAO->editar($produtoCadastro);

            Sessao::gravaSucesso("produto editado com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao editar produto.");
        }

        $this->redirect('produtoCadastro', "edicao?id={$produtoCadastro->getId()}");
    }

    private function getDadosProdutoCadastro(): array
    {
        return [
            'id' => intval($_POST['id']),
            'id_produto' => intval($_POST['id_produto']),
            'id_cor' => intval($_POST['id_cor']),
            'id_voltagem' => intval($_POST['id_voltagem']),
            'produto' => strval($_POST['produto']),
            'preco_venda' => floatval($_POST['preco_venda'])
        ];
    }

    public function deletar(): void
    {
        $id = $_GET['id'];
        $produtoCadastroDAO = new ProdutoCadastroDAO();

        try {
            $produtoCadastroDAO->deletar($id);

            Sessao::gravaSucesso("produto removido com sucesso!");
        } catch (\Exception $e) {
            Sessao::gravaErro("Erro ao remover produto.");
        }

        $this->redirect('produtoCadastro', "index");
    }
}
