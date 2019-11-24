<?php


namespace Test;


use League\Csv\MapIterator;
use Temper\Services\CsvReaderService;
use Tightenco\Collect\Support\Collection;

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

    function testValidDataReturned(){

        $csvReaderService = $this->container->get(CsvReaderService::class);
        $data = $csvReaderService->data();
        $this->assertInstanceOf(Collection::class, $data);
    }

}