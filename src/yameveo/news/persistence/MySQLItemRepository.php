<?php
namespace yameveo\news\persistence;
use yameveo\news\ItemRepository;
use yameveo\news\Item;

class MySQLItemRepository implements ItemRepository {

    public function __construct($settings) {
    }

    public function save(Item $item) {
        printf("Stored new item (%s) into local DB.", $item->getId());
    }
}
