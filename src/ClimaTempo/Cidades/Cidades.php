<?php
namespace ClimaTempo\Cidades;

use ClimaTempo\ClimaTempo;

class Cidades
{
    protected $estados;
    /**
     * @var ClimaTempo
     */
    protected $climaTempo;

    public function __construct(ClimaTempo $ct)
    {
        $this->estados = json_decode(file_get_contents(__DIR__ . "/../Resources/cidades.json"));
        $this->climaTempo = $ct;
    }

    /**
     * @param string $cidadeAPesquisar
     * @param int $limite = 10
     * @return Cidade|Cidade[]
     */
    public function busca($cidadeAPesquisar, $limite = 10)
    {
        $cidadeAPesquisar = $this->climaTempo['stringHelper']->clean($cidadeAPesquisar);
        $this->validateArgumentsForBusca($cidadeAPesquisar, $limite);

        $cidades = [];

        foreach ($this->estados as $estado) {
            foreach ($estado->cidades as $cidade) {
                if (false !== strpos(strtolower($this->climaTempo['stringHelper']->clean($cidade->nome)),
                        strtolower($cidadeAPesquisar))) {
                    $cidades[] = $this->climaTempo['cidadeFactory']->create($cidade->id, $cidade->nome, $estado->uf);
                }

                if (count($cidades) == $limite) {
                    break 2;
                }
            }
        }

        return count($cidades) == 1 ? $cidades[0] : $cidades;
    }

    /**
     * @param $cidadeId
     * @return Cidade|false
     */
    public function buscaPorId($cidadeId)
    {
        foreach ($this->estados as $estado) {
            foreach ($estado->cidades as $cidade) {
                if ($cidade->id == $cidadeId) {
                    return $this->climaTempo['cidadeFactory']->create($cidade->id, $cidade->nome, $estado->uf);
                }
            }
        }

        return false;
    }

    private function validateArgumentsForBusca($cidadeAPesquisar, $limite)
    {
        if (empty($cidadeAPesquisar)) {
            throw new \InvalidArgumentException("Não há cidade a pesquisar");
        }
        if (!is_int($limite)) {
            throw new \InvalidArgumentException("Limite deve ser inteiro");
        }
    }
} 