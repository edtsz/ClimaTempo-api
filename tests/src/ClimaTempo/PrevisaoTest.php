<?php
namespace ClimaTempo;

use ClimaTempo\Cidades\Cidade;
use ClimaTempo\ClimaTempo;
use ClimaTempo\Previsao\Previsao;

class PrevisaoTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfPrevisao()
    {
        $cidade = $this->getMock('ClimaTempo\Cidades\Cidade');
        $climaTempo = $this->getMock('ClimaTempo\ClimaTempo');
        $previsao = new Previsao($cidade, $climaTempo);

        $this->assertInstanceOf('ClimaTempo\Previsao\Previsao', $previsao);
    }

    public function testFunctionalTests()
    {
        $climaTempo = new ClimaTempo();
        $cidade = $climaTempo->busca("Belo Horizonte");

        $this->assertInstanceOf('ClimaTempo\Previsao\Previsao', new Previsao($cidade, $climaTempo));
    }
}