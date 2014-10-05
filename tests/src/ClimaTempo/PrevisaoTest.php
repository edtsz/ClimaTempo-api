<?php
namespace ClimaTempo;

use ClimaTempo\ClimaTempo;
use ClimaTempo\Previsao\Previsao;

class PrevisaoTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfPrevisao()
    {
        $cidade = $this->getMock('ClimaTempo\Cidades\Cidade');
        $previsao = new Previsao($cidade, new ClimaTempo());

        $this->assertInstanceOf('ClimaTempo\Previsao\Previsao', $previsao);
    }
}