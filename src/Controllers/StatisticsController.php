<?php


namespace Temper\Controllers;


use Temper\Presenters\OnBoardingPresenter;
use Temper\Repositories\OnboardingRepository;
use Temper\Responses\ResponsableInterface;

/**
 * Class StatisticsController
 * @package Temper\Controllers
 */
class StatisticsController
{
    public $onboardingRepository;
    public $onboardingPresenter;
    public $onboardingApiResponse;

    /**
     * StatisticsController constructor.
     * @param OnboardingRepository $onboardingRepository
     * @param OnBoardingPresenter $onboardingPresenter
     * @param ResponsableInterface $onboardingStatsApiResponseInterface
     */
    public function __construct(OnboardingRepository $onboardingRepository, OnBoardingPresenter $onboardingPresenter, ResponsableInterface $onboardingStatsApiResponseInterface)
    {
        $this->onboardingRepository = $onboardingRepository;
        $this->onboardingPresenter = $onboardingPresenter;
        $this->onboardingApiResponse = $onboardingStatsApiResponseInterface;
    }


    /**
     * This get data for onboardingStats api
     */
    public function getData()
    {
        $steps = $this->onboardingRepository->getStepsPercentages()->pluck('step');
        $data = $this->onboardingRepository->getAllRecords();
        $transformData = $this->onboardingPresenter->transformData($data);
        $apiData = ['series' => $transformData, 'categories' => $steps];
        return $this->onboardingApiResponse->response($apiData);
    }

}