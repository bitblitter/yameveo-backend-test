<?php
namespace yameveo\news\serializer;
use yameveo\news\Serializer;

/**
 * News CSV Serializer
 */
class CSVSerializer implements Serializer {

    public function serializeItem($newsItem) {
        $data = $this->prepareData($newsItem->asArray());
        return $this->getCSVFor($data);
    }

    private function prepareData($data){
        $result = array();

        foreach($data as $key => $value){
            if(is_array($value)){
                $value = implode(',', $value);
            }
            $result[$key] = $value;
        }

        return $result;
    }

    private function getCSVFor($data){
        $dataLine = array_values($data);
        $dataColumns = array_keys($data);
        $result = array();
        $result[] = $this->outputCSV($dataColumns);
        $result[] = $this->outputCSV($dataLine);

        return implode("", $result);
    }

    private function outputCSV($array){
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $array);
        rewind($fp);
        $csv = fgets($fp);
        fclose($fp);
        return $csv;
    }
}
