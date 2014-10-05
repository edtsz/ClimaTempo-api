<?php
namespace ClimaTempo;

use ClimaTempo\Cidades\Cidade;

class CidadeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cidade
     */
    private $cidade;

    public function setUp()
    {
        $this->cidade = new Cidade();
    }

    public function tearDown()
    {
        $this->cidade = null;
    }

    public function testInstanceOfCidade()
    {
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettersAndGetters()
    {
        $this->cidade->setId("invalido"); // throws exception
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade->setId(123));
        $this->assertEquals(123, $this->cidade->getId());

        $this->cidade->setNome(123); // throws exception
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade->setNome("Nome da Cidade"));
        $this->assertEquals("Nome da Cidade", $this->cidade->getNome());

        $this->cidade->setUf(123); // throws exception
        $this->cidade->setUf("A"); // throws exception
        $this->cidade->setUf("ABC"); // throws exception
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade->setUf("UF"));
        $this->assertEquals("UF", $this->cidade->getUf());
    }
}