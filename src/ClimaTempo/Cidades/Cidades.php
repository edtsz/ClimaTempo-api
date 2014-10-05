<?php
namespace ClimaTempo\Cidades;

use ClimaTempo\Factories\CidadeFactory;
use ClimaTempo\Cidades\Cidade;
use ClimaTempo\Util\StringHelper;

class Cidades
{
    protected $estados;
    /**
     * @var StringHeper
     */
    protected $strHelper;
    /**
     * @var CidadeFactory
     */
    protected $cidadeFactory;

    public function __construct()
    {
        $this->estados = json_decode(file_get_contents(__DIR__ . "/../Resources/cidades.json"));
        $this->strHelper = new StringHelper();
        $this->cidadeFactory = new CidadeFactory();
    }

    /**
     * @param string $cidadeAPesquisar
     * @param int $limite = 10
     * @return Cidade[]
     */
    public function busca($cidadeAPesquisar, $limite = 10)
    {
        $cidadeAPesquisar = $this->strHelper->clean($cidadeAPesquisar);
        $this->validateArgumentsForBusca($cidadeAPesquisar, $limite);

        $cidades = [];

        foreach ($this->estados as $estado) {
            foreach ($estado->cidades as $cidade) {
                if (false !== strpos(strtolower($this->strHelper->clean($cidade->nome)),
                        strtolower($cidadeAPesquisar))) {
                    $cidades[] = $this->cidadeFactory->create($cidade->id, $cidade->nome, $estado->uf);
                }

                if (count($cidades) == $limite) {
                    break 2;
                }
            }
        }

        return $cidades;
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
                    return $this->cidadeFactory->create($cidade->id, $cidade->nome, $estado->uf);
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