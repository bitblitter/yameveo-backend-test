<?php
namespace yameveo\news\reader;
use yameveo\news\Reader;
use yameveo\news\item\NewsItem;

class JSONReader implements Reader {
    private $source;
    private $data = null;

    private function read() {
        $contents = file_get_contents($this->source);
        $data = ($contents ? json_decode($contents, true) : array());
        if(isset($data['news'])){
            $data = $data['news'];
        }
        $this->data = $data;
    }

    public function setSource($source) {
        $this->source = $source;
        $this->read();
    }

    public function readId($id) {
        $item = null;
        foreach($this->data as $currentItem){
            if(isset($currentItem['id']) && $currentItem['id'] === $id){
                $item = new NewsItem($currentItem);
                break;
            }
        }

        if($item === null){
            throw new \Exception("no item found with id: $id");
        }
        return $item;
    }
}
