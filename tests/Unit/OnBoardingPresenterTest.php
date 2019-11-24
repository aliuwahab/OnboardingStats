<?php


namespace Test;


use Temper\Presenters\OnBoardingPresenter;

class OnBoardingPresenterTest extends TemperTest
{

    function testbuildStatsForEachStep(){

//        $onboardingPresenter = $this->container->get(OnBoardingPresenter::class);


        $onboardingPresenter = $this->container->get(OnBoardingPresenter::class);
        $data = $this->invokeMethod($onboardingPresenter, 'buildStatsForEachStep', array(collect([])));

//        $data = $onboardingPresenter->buildStatsForEachStep(collect([]));
        $this->assertIsArray($data);
    }


    function testOnboardingStepsAreEight()
    {
        $onboardingPresenter = $this->container->get(OnBoardingPresenter::class);
        $data = $this->invokeMethod($onboardingPresenter, 'buildStatsForEachStep', array(collect([])));
        $this->assertCount(8,$data);
    }



    function testChartSeriesDataIsReturnsAnArray(){

        $dataPassed = collect([
            ["user_id" => "3121", "created_at" => "2016-07-19", "onboarding_percentage" => "40", "count_applications" => "0", "count_accepted_applications" => "0"],
            ["user_id" => "3122", "created_at" => "2016-07-19", "onboarding_percentage" => "40", "count_applications" => "0", "count_accepted_applications" => "0"],
            ["user_id" => "3123", "created_at" => "2016-07-19", "onboarding_percentage" => "40", "count_applications" => "0", "count_accepted_applications" => "0"]
        ]);

        $onboardingPresenter = $this->container->get(OnBoardingPresenter::class);
        $data = $onboardingPresenter->buildChartSeriesData($dataPassed);
        $this->assertIsArray($data);
    }


    function testChartSeriesDataIsValid(){

        $dataPassed = collect([
            ["user_id" => "3121", "created_at" => "2016-07-19", "onboarding_percentage" => "40", "count_applications" => "0", "count_accepted_applications" => "0"],
            ["user_id" => "3122", "created_at" => "2016-07-19", "onboarding_percentage" => "40", "count_applications" => "0", "count_accepted_applications" => "0"],
            ["user_id" => "3123", "created_at" => "2016-07-19", "onboarding_percentage" => "40", "count_applications" => "0", "count_accepted_applications" => "0"]
        ]);
        $onboardingPresenter = $this->container->get(OnBoardingPresenter::class);
        $data = $onboardingPresenter->buildChartSeriesData($dataPassed);
        $this->assertIsObject($data[0]);
        $this->assertObjectHasAttribute('name', $data[0]);
        $this->assertObjectHasAttribute('data', $data[0]);
    }


    function testTransformDataIsValid(){
        $onboardingPresenter = $this->container->get(OnBoardingPresenter::class);
        $data = $onboardingPresenter->transformData(collect([]));
        $this->assertIsArray($data);
    }


}