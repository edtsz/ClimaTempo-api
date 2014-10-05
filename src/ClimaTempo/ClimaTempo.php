<?php
namespace ClimaTempo;

use Pimple;
use ClimaTempo\Util\HtmlHelper;
use ClimaTempo\Util\StringHelper;
use ClimaTempo\Cidades\Cidade;
use ClimaTempo\Cidades\Cidades;
use ClimaTempo\Factories\CidadeFactory;

class ClimaTempo extends Pimple
{
    public function __construct()
    {
        $this['cidades'] = $this->share(function() {
            return new Cidades($this);
        });
        $this['stringHelper'] = $this->share(function() {
            return new StringHelper();
        });
        $this['htmlHelper'] = $this->share(function() {
            return new HtmlHelper();
        });
        $this['cidadeFactory'] = $this->share(function() {
            return new CidadeFactory($this);
        });
    }

    /**
     * @return Cidades
     */
    public function getCidades()
    {
        return $this['cidades'];
    }

    /**
     * @param     $cidade
     * @param int $limite
     * @return Cidade[]
     */
    public function busca($cidade, $limite = 10)
    {
        return $this->getCidades()->busca($cidade, $limite);
    }
} 