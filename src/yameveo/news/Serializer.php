<?php
namespace yameveo\news;

/**
 * News serializer
 */
interface Serializer {
    /**
     * Serialize a news item.
     *
     * @param Item $newsItem
     * @return string
     */
    public function serializeItem($newsItem);
}
