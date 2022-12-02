<?php

class Formacao {

    private $idCient;
    private $idTitulacao;
    private $dti;
    private $dtt;

    public function __construct($idCient, $idTitulacao, $dti, $dtt)
    {
        $this->idCient      = $idCient;
        $this->idTitulacao  = $idTitulacao;
        $this->dti          = $dti;
        $this->dtt          = $dtt;
    }

    function getIdCient()
    {
        return $this->idCient;
    }

    function getIdTitulacao()
    {
        return $this->idTitulacao;
    }

    function getDti()
    {
        return $this->dti;
    }

    function getDtt()
    {
        return $this->dtt;
    }
}

?>