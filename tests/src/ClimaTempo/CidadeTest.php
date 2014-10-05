<?php
namespace ClimaTempo;

use ClimaTempo\ClimaTempo;
use ClimaTempo\Cidades\Cidade;

class CidadeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cidade
     */
    private $cidade;

    public function setUp()
    {
        $this->cidade = new Cidade(new ClimaTempo());
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
    public function testIdException()
    {
        $this->cidade->setId("invalido");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNomeException()
    {
        $this->cidade->setNome(123);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUfException1()
    {
        $this->cidade->setUf(123);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUfException2()
    {
        $this->cidade->setUf("A");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUfException3()
    {
        $this->cidade->setUf("ABC");
    }

    public function testSettersAndGetters()
    {
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade->setId(123));
        $this->assertEquals(123, $this->cidade->getId());

        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade->setNome("Nome da Cidade"));
        $this->assertEquals("Nome da Cidade", $this->cidade->getNome());

        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->cidade->setUf("UF"));
        $this->assertEquals("UF", $this->cidade->getUf());
    }
}