<?php
namespace yameveo\news;
use yameveo\news\Item;

interface ItemRepository {
    /**
     * Save an item
     *
     * @param Item $item
     */
    public function save(Item $item);

}
