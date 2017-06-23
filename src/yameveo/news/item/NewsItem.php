<?php
namespace yameveo\news\item;
use yameveo\news\Item;

class NewsItem implements Item {
    private $id;
    private $name;
    private $text;
    private $html;
    private $tags;

    public function __construct(array $data = array()) {
        $this->fromArray($data);
    }

    public function asArray() {
        return get_object_vars($this);
    }

    public function fromArray(array $data) {
        foreach($data as $field => $value){
            if(property_exists(__CLASS__, $field)){
                $this->$field = $value;
            }
        }
    }

    public function getId() {
        return $this->id;
    }

}
