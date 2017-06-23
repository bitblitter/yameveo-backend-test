<?php
use PHPUnit\Framework\TestCase;
use yameveo\news\Item;


final class JSONSerializerTest extends TestCase {

    private function getItemData() {
        return array(
            'id' => 'item-id',
            'name' => 'fake item',
            'tags' => array('just','a', 'few', 'tags')
        );
    }

    private function getMockItem() {
        $itemData = $this->getItemData();
        $item = $this->createMock(Item::class);
        $item->method('asArray')
            ->willReturn($itemData);
    }

    public function testSerializeItem() {
        $mockItem = $this->getMockItem();
    }
}
