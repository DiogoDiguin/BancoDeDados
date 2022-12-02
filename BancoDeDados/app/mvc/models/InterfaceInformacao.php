<?php

interface Informacao{
    // Força a classe que estende ClasseAbstrata a definir esse método
        public function insert($valor);
        public function delete($valor1, $valor2);
    }
?>