<?php
namespace ClimaTempo;

use ClimaTempo\ClimaTempo;
use ClimaTempo\Previsao\Previsao;

class PrevisaoTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfPrevisao()
    {
        $climaTempo = new ClimaTempo();
        $cidade = $climaTempo->busca("Belo Horizonte");
        $previsao = new Previsao($cidade, $climaTempo);

        $this->assertInstanceOf('ClimaTempo\Previsao\Previsao', $previsao);
    }
}