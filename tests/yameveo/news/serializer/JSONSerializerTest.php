<?php
use PHPUnit\Framework\TestCase;
use yameveo\news\Item;
use yameveo\news\serializer\JSONSerializer;


final class JSONSerializerTest extends TestCase {

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

    public function testSerializeItem() {
        $mockItem = $this->getMockItem();
        $serializer = new JSONSerializer();

        $expectedValue = json_encode($this->getItemData(), JSON_PRETTY_PRINT);
        $givenValue = $serializer->serializeItem($mockItem);

        $this->assertEquals($expectedValue, $givenValue);
    }
}
