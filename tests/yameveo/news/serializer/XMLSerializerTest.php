<?php
namespace yameveo\news\serializer;

use PHPUnit\Framework\TestCase;
use yameveo\news\Item;

class XMLSerializerTest extends TestCase
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
        $serializer = new XMLSerializer();

        $expectedValue = <<<EOX
<?xml version="1.0"?>
<root>
    <id>item-id</id>
    <name>fake item</name>
    <tags>
        <element>just</element>
        <element>a</element>
        <element>few</element>
        <element>tags</element>
    </tags>
</root>
EOX;
        $expectedValue = preg_replace('/\s/', '', $expectedValue);
        $givenValue = preg_replace('/\s/', '', $serializer->serializeItem($mockItem));

        $this->assertEquals($expectedValue, $givenValue);
    }
}
