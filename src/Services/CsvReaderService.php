<?php


namespace Temper\Services;


use League\Csv\Exception as CSVException;
use League\Csv\Reader;
use Temper\Models\OnBoardingDataInterface;
use Tightenco\Collect\Support\Collection;

class CsvReaderService implements OnBoardingDataInterface
{

    /**
     * @return Collection
     */
    public function data(){
        $data = $this->readCSVFile();
        $organisedData = $this->organisedData($data);
        return $organisedData;
    }


    /**
     * @param string $csvPath
     * @return mixed
     */
    public function readCSVFile($csvPath = '/../../files/export.csv'){
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        try {
            $reader = Reader::createFromPath( __DIR__ . $csvPath, 'r');
            $reader->setDelimiter(';');
            $reader->setHeaderOffset(0);
            $records = $reader->getRecords();
            return $records;
        } catch (CSVException $e) {
            echo $e->getMessage(), PHP_EOL;
        }

    }



    /**
     * @param $data
     * @return Collection
     */
    public function organisedData($data)
    {
        $organisedData = [];

        foreach ($data as $offset => $record) {
            $organisedData[] = $record;
        }

        return collect($organisedData);
    }

}