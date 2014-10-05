<?php
namespace ClimaTempo;

use ClimaTempo\Factories\CidadeFactory;

class CidadeFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CidadeFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new CidadeFactory();
    }

    public function tearDown()
    {
        $this->factory = null;
    }

    public function testInstanceOfCidadeFactory()
    {
        $this->assertInstanceOf('ClimaTempo\Factories\CidadeFactory', $this->factory);
    }

    public function testFunctionalTests()
    {
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->factory->create());
        $this->assertInstanceOf('ClimaTempo\Cidades\Cidade', $this->factory->create(123, "nome da cidade", "uf"));
    }
}