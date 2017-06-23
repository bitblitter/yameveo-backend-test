<?php
namespace yameveo;
use yameveo\news\reader\JSONReader;
use yameveo\news\Item;
use yameveo\news\apiclient\FakeAPIClient;
use yameveo\news\persistence\MySQLItemRepository;

class App {
    // An array of available readers for different formats.
    private $readers;

    // Default format to use for reading when not specified.
    private $defaultReader;

    // Data source directory
    private $dataDir;

    // Data source file name
    private $dataFile;

    // API Client settings
    private $clientSettings;

    // Item Repository settings
    private $repositorySettings;

    // API Client instance
    private $apiClient;

    // Local DB item repository
    private $itemRepository;

    /**
     * The constructor receives settings as an associative
     * array with property names and their values.
     * If the property doesn't exist, it won't be set.
     */
    public function __construct($settings) {
        foreach($settings as $key => $value){
            if(property_exists(__CLASS__, $key)){
                $this->$key = $value;
            }
        }
    }

    /**
     * Publish a news item.
     *
     * @param string $itemId ID of the news item to publish.
     * @param string $readFormat format to use for reading.
     * @param string $writeFormat format to use for publishing.
     */
    public function publish($itemId = null, $readFormat = null, $writeFormat = null) {
        $readFormat = ($readFormat === null ? $this->defaultReader : $readFormat);
        $dataSource = $this->getDataSource();
        $this->checkDataSource($dataSource);
        $this->checkArguments($itemId);
        $item = $this->read($itemId, $dataSource, $readFormat);
        $this->showStatus($itemId, $writeFormat);
        $apiClient = $this->getAPIClient();
        $apiClient->publish($item, $writeFormat);
        $this->saveLocal($item);
    }

    public function saveLocal(Item $item) {
        $repository = $this->getItemRepository();
        $repository->save($item);
    }

    public function getItemRepository() {
        if($this->itemRepository === null){
            $this->itemRepository = new MySQLItemRepository($this->repositorySettings);
        }
        return $this->itemRepository;
    }

    /**
     * Get the configured API Client instance.
     */
    private function getAPIClient() {
        if($this->apiClient === null){
            $this->apiClient = new FakeAPIClient($this->clientSettings);
        }
        return $this->apiClient;
    }

    /**
     * Read a news item from the specified source and format.
     *
     * @param string $id
     * @param string $source where to read from
     * @param string $format specify in which format the source is.
     */
    private function read($id, $source, $format = null) {
        if($format === null) $format = $this->defaultReader;
        if(!isset($this->readers[$format])){
            throw new \Exception('unable to find a reader for the specified format: '.$format);
        }
        $readerClass = $this->readers[$format];
        $reader = new $readerClass();
        $reader->setSource($source);

        return $reader->readId($id);
    }

    private function showStatus($itemId) {
        echo "Publishing '$itemId':\n";
    }

    private function checkArguments($itemId){
        if($itemId == null){
            throw new \Exception('Item ID not specified');
        }
    }

    private function getDataSource() {
        return $this->dataDir.'/'.$this->dataFile;
    }

    /**
     * Check if the source file exists and its location is valid.
     */
    private function checkDataSource($source){
        $finalPath = realpath($source);
        if ($finalPath === false || strncmp($finalPath, $this->dataDir, strlen($this->dataDir)) !== 0){
            throw new \Exception('Data file not found, or not in the data location ('.$this->dataDir.')');
        }
    }
}
