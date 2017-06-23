<?php
namespace yameveo\news;

interface Item {

    /**
     * @return array
     */
    public function asArray();

    /**
     * @param array $data
     */
    public function fromArray(array $data);

    /**
     * @return string
     */
    public function getId();
}
