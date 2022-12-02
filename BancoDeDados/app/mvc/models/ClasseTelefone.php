<?php

class Telefone {

    private $idCient;
    private $ddd;
    private $telefone;

    public function __construct($id, $ddd, $te)
    {
        $this->idCient   = $id;
        $this->ddd       = $ddd;
        $this->telefone  = $te;
    }

    function getId()
    {
        return $this->idCient;
    }

    function getDDD()
    {
        return $this->ddd;
    }

    function getTelefone()
    {
        return $this->telefone;
    }
}

?>