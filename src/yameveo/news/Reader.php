<?php
namespace yameveo\news;

interface Reader {
    /**
     * Set the source of the reader
     */
    public function setSource($source);

    /**
     * Read an item with a specific ID
     * @param string $id
     * @return Item|null
     */
    public function readId($id);
}
