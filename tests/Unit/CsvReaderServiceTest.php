<?php


namespace Test;


use League\Csv\MapIterator;
use Temper\Services\CsvReaderService;

class CsvReaderServiceTest extends TemperTest
{
    function testReadValidCSV(){
        $csvReaderService = $this->container->get(CsvReaderService::class);
        $data = $csvReaderService->readCSVFile();
        $this->assertInstanceOf(MapIterator::class, $data);
    }

    function testReadInvalidCSV(){

        $csvReaderService = $this->container->get(CsvReaderService::class);
        $data = $csvReaderService->readCSVFile('invalidCSV');
        $this->assertNull($data);
    }

}