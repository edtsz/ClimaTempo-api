<?php
namespace ClimaTempo;

use ClimaTempo\ClimaTempo;
use ClimaTempo\Previsao\Previsao;

class PrevisaoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Previsao
     */
    private $previsao;

    public function setUp()
    {
        $climaTempo = new ClimaTempo();
        $cidade = $climaTempo->busca("Belo Horizonte");
        $this->previsao = new Previsao($cidade, $climaTempo);
    }

    public function tearDown()
    {
        $this->previsao = null;
    }

    public function testInstanceOfPrevisao()
    {
        $this->assertInstanceOf('ClimaTempo\Previsao\Previsao', $this->previsao);
    }

    public function testPrevisoes()
    {
        $this->assertTrue(is_array($this->previsao->hoje()));
        $this->assertTrue(is_array($this->previsao->amanha()));
        $this->assertTrue(is_array($this->previsao->depoisDeAmanha()));
        $this->assertTrue(is_array($this->previsao->previsaoCompleta()));
    }
}