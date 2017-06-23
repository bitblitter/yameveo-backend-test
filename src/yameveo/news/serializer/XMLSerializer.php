<?php
namespace yameveo\news\serializer;
use yameveo\news\Serializer;

/**
 * News XML Serializer
 */
class XMLSerializer implements Serializer {

    public function serializeItem($newsItem) {
        $xml = new \SimpleXMLElement('<root/>');
        $data = $newsItem->asArray();
        foreach($data as $key => $value){
            if(is_array($value)){
                $child = $xml->addChild($key);
                foreach($value as $valueItem){
                    $child->addChild('element', $valueItem);
                }
            } else {
                $xml->addChild($key, $value);
            }
        }
        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        return $dom->saveXML();
    }
}
