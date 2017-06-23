<?php
namespace yameveo\news\serializer;
use yameveo\news\Serializer;

/**
 * News JSON Serializer
 */
class JSONSerializer implements Serializer {

    public function serializeItem($newsItem) {
        return json_encode($newsItem->asArray(), JSON_PRETTY_PRINT);
    }

}

