<?php
namespace ClimaTempo\Previsao;

use ClimaTempo\Cidades\Cidade;
use ClimaTempo\Util\HtmlHelper;
use ClimaTempo\Util\StringHelper;

class Previsao
{
    protected $url = "http://www.climatempo.com.br/previsao-do-tempo/cidade/";
    protected $strHelper;
    protected $htmlHelper;
    protected $results = [];
    protected $tempos = [
        "Ensolarado", "Nublado", "Chuvisco", "Chuvas Isoladas", "Chuvoso", "Chuva com trovoadas",
        "Ensolarado", "Neve", "Sol com poucas nuvens"
    ];

    public function __construct(Cidade $cidade)
    {
        $this->strHelper = new StringHelper();
        $this->htmlHelper = new HtmlHelper();

        $cidade_nome = $this->strHelper->clean($cidade->getNome());
        $cidade_uf = strtolower($cidade->getUf());

        $this->url .= "{$cidade->getId()}/{$cidade_nome}-{$cidade_uf}";

        $html = $this->htmlHelper->google_curl($this->url);

        // TODO: Tratar os erros html que retornam na função abaixo
        @$this->htmlHelper->getDom()->loadHTML($html);

        $wrapperDivs = $this->htmlHelper->get_all_by_class($this->htmlHelper->getDom(), "box-prev-completa");

        foreach ($wrapperDivs as $node) {
            $this->results[] = [
                "dia"     => trim($this->htmlHelper->get_one_by_class($node, "data-prev")->nodeValue),
                "tempo"   => $this->get_previsao_horarios($node),
                "tempMax" => trim($this->htmlHelper->get_one_by_class($node, "max")->nodeValue),
                "tempMin" => trim($this->htmlHelper->get_one_by_class($node, "min")->nodeValue),
                "resumo"  => trim($this->htmlHelper->get_one_by_class($node, "fraseologia-prev")->nodeValue)
            ];
        }
    }

    public function hoje()
    {
       return isset($this->results[0]) ? $this->results[0] : "Dados indisponíveis";
    }

    public function amanha()
    {
        return isset($this->results[1]) ? $this->results[1] : "Dados indisponíveis";
    }

    public function depoisDeAmanha()
    {
        return isset($this->results[2]) ? $this->results[2] : "Dados indisponíveis";
    }

    private function get_previsao_horarios($node)
    {
        $prevs = [];

        $tmp_dom = $this->htmlHelper->resetDom();
        $tmp_dom->appendChild($tmp_dom->importNode($node, true));

        $previsoes = $this->htmlHelper->get_all_by_class($tmp_dom, "ico-sprite-prev-span");

        $i = 0;
        $tipos = ["Manhã", "Tarde", "Noite"];

        foreach ($previsoes as $previsao) {
            $classes = explode(" ", $previsao->getAttribute("class"));
            $codigo = str_replace("sprite-prev-45px-", "", $classes[2]);

            // O codigo vem com um "n" quando é à noite, transforma em int
            $codigo = intval($codigo);

            $prevs[] = [
                "horario" => $tipos[$i],
                "tempo"   => $this->codigoTempo($codigo)
            ];

            $i++;
        }

        return $prevs;
    }

    private function codigoTempo($codigo)
    {
        return $this->tempos[$codigo - 1];
    }
} 