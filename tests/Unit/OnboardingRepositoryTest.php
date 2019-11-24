<?php
namespace Test;

use Temper\Repositories\OnboardingRepository;
use Tightenco\Collect\Support\Collection;

class OnboardingRepositoryTest extends TemperTest
{

    function testGetAllRecords(){
        $onboardingRepository = $this->container->get(OnboardingRepository::class);
        $data = $onboardingRepository->getAllRecords();
        $this->assertInstanceOf(Collection::class, $data);
    }

    function testgetStepsPercentages()
    {
        $onboardingRepository = $this->container->get(OnboardingRepository::class);
        $data = $onboardingRepository->getStepsPercentages();
        $this->assertInstanceOf(Collection::class, $data);
    }


}