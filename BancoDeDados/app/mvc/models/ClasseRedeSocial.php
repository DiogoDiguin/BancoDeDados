<?php

class RedeSocial {

    private $idCient;
    private $endereco;
    private $tipo;

    public function __construct($id, $e, $t)
    {
        $this->idCient     = $id;
        $this->endereco    = $e;
        $this->tipo        = $t;
    }

    function getId()
    {
        return $this->idCient;
    }

    function getEndereco()
    {
        return $this->endereco;
    }

    function getTipo()
    {
        return $this->tipo;
    }
}

?>