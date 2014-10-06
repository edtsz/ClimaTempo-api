# API Climatempo

API em PHP para extrair dados do site [ClimaTempo](http://www.climatempo.com.br)
# Instalação
	git clone git@github.com:brunowerneck/ClimaTempo-api.git
	cd ClimaTempo-api
	composer install
# Utilização
	<?php
    require_once(__DIR__ . "/../vendor/autoload.php");
    
    use ClimaTempo\ClimaTempo;
    
    $climatempo = new ClimaTempo();
    
    // Achar Cidade
    $cid = $climatempo->busca("belo hori"); // Belo Horizonte
    
    echo $cid[0]->getNome() . "<br>";
    print_r($cid[0]->getPrevisao()->hoje());
    print_r($cid[0]->getPrevisao()->amanha());
    
    // Mostrar todos os dados da previsão
    print_r($cid[0]->getPrevisao()->previsaoCompleta());
    
    
    // Achar todas as Cidades que contêm "belo" no nome (em qualquer posição)
    $cidades = $climatempo->busca("belo");
    foreach ($cidades as $cidade) {
        echo "{$cidade->getNome()} - {$cidade->getUf()}<br>\n";
        echo $cidade->getPrevisao()->hoje()["dia"] . "<br>\n";
        echo $cidade->getPrevisao()->hoje()["tempMax"] . "<br>\n";
        echo $cidade->getPrevisao()->hoje()["resumo"] . "<hr>\n\n";
    }

# TODO

- Corrigir testes unitários