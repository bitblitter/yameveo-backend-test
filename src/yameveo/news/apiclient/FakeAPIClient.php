<?php
namespace yameveo\news\apiclient;
use yameveo\news\Item;
use yameveo\news\APIClient;

class FakeAPIClient implements APIClient {
    private $serializers;
    private $defaultSerializer;

    public function __construct($settings) {
        foreach($settings as $key => $value){
            if(property_exists(__CLASS__, $key)){
                $this->$key = $value;
            }
        }
    }

    public function publish(Item $item, $format = null) {
        $format = ($format == null ? $this->defaultSerializer : $format);
        echo "Publishing to $format API: \n";
        echo $this->serializeData($item, $format)."\n";
        return true;
    }

    private function serializeData(Item $item, $format) {
        $serializerClass = $this->serializers[$format];
        $serializer = new $serializerClass();
        return $serializer->serializeItem($item);
    }
}
