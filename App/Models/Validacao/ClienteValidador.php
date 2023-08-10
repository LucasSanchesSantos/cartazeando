<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Cliente;
use App\Models\DAO\ClienteDAO;

class ClienteValidador
{

    public function validar(Cliente $cliente)
    {
        $resultadoValidacao = new ResultadoValidacao();
        if (empty($cliente->getCpf())) {
            $resultadoValidacao->addErro('cpf', "Cpf: este campo não pode ser vazio");
        }

        if (empty($cliente->getNome())) {
            $resultadoValidacao->addErro('nome', "Nome: este campo não pode ser vazio");
        }

        if (empty($cliente->getEmail())) {
            $resultadoValidacao->addErro('email', "E-mail: este campo não pode ser vazio");
        }

        if (empty($cliente->getTelefone())) {
            $resultadoValidacao->addErro('telefone', "Telefone: este campo não pode ser vazio");
        }

        if (empty($cliente->getLogin())) {
            $resultadoValidacao->addErro('login', "Login: este campo não pode ser vazio");
        }

        if (empty($cliente->getSenha())) {
            $resultadoValidacao->addErro('senha', "Senha: este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }

    public function validarLogin(Cliente $cliente)
    {

        $resultadoValidacao = new ResultadoValidacao();

        if (empty($cliente->getLogin()) || empty($cliente->getSenha())) {
            if (empty($cliente->getLogin()) && !empty($cliente->getSenha())) {
                $resultadoValidacao->addErro('login', "Login: Este campo não pode ser vazio");
            } else if (empty($cliente->getSenha()) && !empty($cliente->getLogin())) {
                $resultadoValidacao->addErro('senha', "Senha: Este campo não pode ser vazio");
            } else if (empty($cliente->getLogin()) && empty($cliente->getSenha())) {
                $resultadoValidacao->addErro('login', "Login: Este campo não pode ser vazio");
                $resultadoValidacao->addErro('senha', "Senha: Este campo não pode ser vazio");
            }
        }

        return $resultadoValidacao;
    }

    public function validarCpf(Cliente $cliente)
    {
        $resultadoValidacao = new ResultadoValidacao();

        $clienteDAO = new ClienteDAO();

        if (!empty($clienteDAO->listar($cliente->getCpf()))) {
            $resultadoValidacao->addErro('cpf', "CPF já existe na base de dados.");
        }

        if ($clienteDAO->listarLogin($cliente->getLogin()) <> 0) {
            $resultadoValidacao->addErro('login', "Login já existe na base de dados.");
        }

        return $resultadoValidacao;
    }
}
