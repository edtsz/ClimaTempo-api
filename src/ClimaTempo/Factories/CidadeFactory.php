<?php
namespace ClimaTempo\Factories;

use ClimaTempo\Cidades\Cidade;

class CidadeFactory
{
    public function create($id = null, $nome = null, $uf = null)
    {
        $cidade = new Cidade();
        $cidade->setId($id)
            ->setNome($nome)
            ->setUf($uf)
        ;

        return $cidade;
    }
} 