<?php


namespace Temper\Controllers;


use Carbon\Carbon;
use Temper\Presenters\OnBoardingPresenter;
use Temper\Repositories\OnboardingRepository;
use Temper\Responses\OnboardingStatsApiResponse;
use Tightenco\Collect\Support\Collection;

class StatisticsController
{

    public $onboardingRepository;

    public $onboardingPresenter;

    public $onboardingApiResponse;

    public function __construct(OnboardingRepository $onboardingRepository, OnBoardingPresenter $onboardingPresenter, OnboardingStatsApiResponse $onboardingStatsApiResponse)
    {
        $this->onboardingRepository = $onboardingRepository;
        $this->onboardingPresenter = $onboardingPresenter;
        $this->onboardingApiResponse = $onboardingStatsApiResponse;
    }


    public function index()
    {
        return view('dashboard');
    }


    public function getData()
    {
        $steps = $this->onboardingRepository->getStepsPercentages()->pluck('step');

        $data = $this->onboardingRepository->getAllRecords();

        $transformData = $this->onboardingPresenter->transformData($data);


        $apiData = ['series' => $transformData, 'categories' => $steps];
        return $this->onboardingApiResponse->response($apiData);
    }




}