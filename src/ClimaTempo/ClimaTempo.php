<?php
namespace ClimaTempo;

use ClimaTempo\Cidades\Cidades;

class ClimaTempo
{
    /**
     * @var Cidades
     */
    protected $cidades;

    public function __construct()
    {
        $this->cidades = new Cidades();
    }

    public function getCidades()
    {
        return $this->cidades;
    }

    /**
     * @param     $cidade
     * @param int $limite
     * @return Cidade[]
     */
    public function busca($cidade, $limite = 10)
    {
        return $this->cidades->busca($cidade, $limite);
    }
} 