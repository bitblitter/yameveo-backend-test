<?php

namespace yameveo\news\serializer;

use PHPUnit\Framework\TestCase;
use yameveo\news\Item;

class CSVSerializerTest extends TestCase
{
    private function getItemData() {
        return array(
            'id' => 'item-id',
            'name' => 'fake item',
            'tags' => array('just','a', 'few', 'tags')
        );
    }

    /**
     * @return Item
     */
    private function getMockItem() {
        $itemData = $this->getItemData();
        $item = $this->createMock(Item::class);
        $item->method('asArray')
            ->willReturn($itemData);
        return $item;
    }

    public function testSerializeItem()
    {
        $mockItem = $this->getMockItem();
        $serializer = new CSVSerializer();

        $expectedValue = "id,name,tags\n"
            . 'item-id,"fake item","just,a,few,tags"'."\n";
        $givenValue = $serializer->serializeItem($mockItem);

        $this->assertEquals($expectedValue, $givenValue);
    }
}
