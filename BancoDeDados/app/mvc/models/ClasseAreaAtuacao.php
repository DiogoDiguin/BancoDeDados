<?php

class AreaAtuacao {

    private $idCient;
    private $idArea;

    public function __construct($idCient, $idArea)
    {
        $this->idCient   = $idCient;
        $this->idArea    = $idArea;
    }

    function getIdCient()
    {
        return $this->idCient;
    }

    function getIdArea()
    {
        return $this->idArea;
    }
}

?>