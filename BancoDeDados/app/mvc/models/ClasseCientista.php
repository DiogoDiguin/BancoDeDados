<?php

class Cientista {

    private $nome;
    private $cpf;
    private $dataNascimento;
    private $email;
    private $email02;
    private $lattes;
    private $senha;
    private $cidade;

    public function __construct($n, $c, $d, $e, $e02, $l, $s, $ci)
    {
        $this->nome = $n;
        $this->cpf = $c;
        $this->dataNascimento = $d;
        $this->email = $e;
        $this->email02 = $e02;
        $this->lattes = $l;
        $this->senha = $s;
        $this->cidade = $ci;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getEmail02()
    {
        return $this->email02;
    }

    function getLattes()
    {
        return $this->lattes;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getCidade()
    {
        return $this->cidade;
    }
}

?>