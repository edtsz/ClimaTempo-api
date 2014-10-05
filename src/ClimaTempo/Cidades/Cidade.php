<?php
namespace ClimaTempo\Cidades;

use ClimaTempo\Previsao\Previsao;

class Cidade
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $nome;
    /**
     * @var string
     */
    protected $uf;
    /**
     * @var Previsao
     */
    protected $previsao;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Cidade
     */
    public function setId($id)
    {
        if (!is_int($id)) {
            throw new \InvalidArgumentException("ID deve ser inteiro");
        }
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Cidade
     */
    public function setNome($nome)
    {
        if (!is_string($nome)) {
            throw new \InvalidArgumentException("Nome da Cidade deve ser string");
        }
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     * @return Cidade
     */
    public function setUf($uf)
    {
        if (!is_string($uf)) {
            throw new \InvalidArgumentException("UF deve ser string");
        }
        if (strlen($uf) < 2 || strlen($uf) > 2) {
            throw new \InvalidArgumentException("UF só pode ter duas letras");
        }
        $this->uf = $uf;

        return $this;
    }

    /**
     * @return Previsao
     */
    public function getPrevisao()
    {
        if (!$this->previsao instanceof Previsao) {
            $this->previsao = new Previsao($this);
        }

        return $this->previsao;
    }

} 