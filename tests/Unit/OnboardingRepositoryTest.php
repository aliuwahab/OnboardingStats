<?php
namespace Test;

use League\Csv\MapIterator;
use Temper\Repositories\OnboardingRepository;
use Test\TemperTest;
use Tightenco\Collect\Support\Collection;

class OnboardingRepositoryTest extends TemperTest
{

    function testReadValidCSV(){

        $onboardingRepository = new OnboardingRepository();
        $data = $onboardingRepository->readCSVFile();
        $this->assertInstanceOf(MapIterator::class, $data);
    }

    function testReadInvalidCSV(){
        $onboardingRepository = new OnboardingRepository();
        $data = $onboardingRepository->readCSVFile('invalidCSV');
        $this->assertNull($data);
    }


    function testGetAllRecords(){
        $onboardingRepository = new OnboardingRepository();
        $data = $onboardingRepository->getAllRecords();
        $this->assertInstanceOf(Collection::class, $data);
    }


    function testOrganisedData()
    {
        $rawData = [1,2,3, 4,5];
        $onboardingRepository = new OnboardingRepository();
        $data = $onboardingRepository->organisedData($rawData);
        $this->assertInstanceOf(Collection::class, $data);
    }



    function testgetStepsPercentages()
    {
        $onboardingRepository = new OnboardingRepository();
        $data = $onboardingRepository->getStepsPercentages();
        $this->assertInstanceOf(Collection::class, $data);
    }


}