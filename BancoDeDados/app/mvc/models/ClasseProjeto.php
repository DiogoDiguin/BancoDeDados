<?php

class Projeto {

    private $idCientista;
    private $tituloProjeto;
    private $resumoProjeto;
    private $dtInicioPr;
    private $dtFimPr;
    private $tipoPublicacao;

    public function __construct($c, $t, $r, $dti, $dtf, $tp)
    {
        $this->idCientista    = $c;
        $this->tituloProjeto  = $t;
        $this->resumoProjeto  = $r;
        $this->dtInicioPr     = $dti;
        $this->dtFimPr        = $dtf;
        $this->tipoPublicacao = $tp;
    }

    function getCientista()
    {
        return $this->idCientista;
    }

    function getTitulo()
    {
        return $this->tituloProjeto;
    }

    function getResumoProjeto()
    {
        return $this->resumoProjeto;
    }

    function getDtInicio()
    {
        return $this->dtInicioPr;
    }

    function getDtFim()
    {
        return $this->dtFimPr;
    }

    function getTipoPublicao()
    {
        return $this->tipoPublicacao;
    }
}

?>