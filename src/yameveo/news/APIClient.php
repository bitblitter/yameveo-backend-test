<?php
namespace yameveo\news;
use yameveo\news\Item;

interface APIClient {
    public function publish(Item $item, $format);
}

