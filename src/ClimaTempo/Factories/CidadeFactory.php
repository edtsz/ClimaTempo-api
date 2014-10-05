<?php
namespace ClimaTempo\Factories;

use ClimaTempo\ClimaTempo;
use ClimaTempo\Cidades\Cidade;

class CidadeFactory
{
    /**
     * @var ClimaTempo
     */
    protected $ct;

    public function __construct(ClimaTempo $ct)
    {
        $this->ct = $ct;
    }

    public function create($id = null, $nome = null, $uf = null)
    {
        $cidade = new Cidade($this->ct);
        $cidade->setId($id)
            ->setNome($nome)
            ->setUf($uf)
        ;

        return $cidade;
    }
} 