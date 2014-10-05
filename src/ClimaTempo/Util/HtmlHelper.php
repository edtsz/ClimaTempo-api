<?php
namespace ClimaTempo\Util;

class HtmlHelper
{
    /**
     * @var \DOMDocument
     */
    protected $dom;

    /**
     * @return \DOMDocument
     */
    public function getDom()
    {
        if (!$this->dom instanceof \DOMDocument) {
            $this->dom = new \DOMDocument();
        }

        return $this->dom;
    }

    /**
     * @return \DOMDocument
     */
    public function resetDom()
    {
        $this->dom = new \DOMDocument();

        return $this->getDom();
    }

    public function google_curl($url) {
        $userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 2);

        $html = curl_exec($curl);

        $html = @mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');

        if (curl_errno($curl)) {
            throw new \Exception('error:' . curl_error($curl));
        }

        curl_close($curl);

        return $html;
    }

    public function get_all_by_class($tmp_dom, $class)
    {
        $finder2 = new \DomXPath($tmp_dom);
        $nodes2 = $finder2->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");

        return $nodes2;
    }

    public function get_one_by_class($node, $class)
    {
        // $node é do tipo DomElement, precisa de um tipo DomDocument pra usar a classe DomXPath
        $tmp_dom = new \DOMDocument();
        $tmp_dom->appendChild($tmp_dom->importNode($node, true));

        $finder2 = new \DomXPath($tmp_dom);
        $nodes2 = $finder2->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");
        foreach ($nodes2 as $node) {
            $firstNode = $node;
            break;
        }

        return $firstNode;
    }
} 