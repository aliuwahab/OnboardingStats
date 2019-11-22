<?php

namespace Temper\Presenters;

use Carbon\Carbon;
use Temper\Repositories\OnboardingRepository;
use Tightenco\Collect\Support\Collection;

class OnBoardingPresenter implements PresenterInterface
{

    public $onboadingRepository;

    public function __construct(OnboardingRepository $onboardingRepository)
    {
        $this->onboadingRepository = $onboardingRepository;
    }

    /**
     * @param $data
     * @return Collection
     */
    public function transformData($data): array {
        $chartSeriesData = $this->buildChartSeriesData($data);
        return $chartSeriesData;
    }



    /**
     * @param Collection $data
     * @return array
     */
    private function buildChartSeriesData(Collection $data)
    {
        // This will loop through the collection of data and put them into weeks
        $groupDataIntoWeeks =  $data->groupBy(function ($userRegistrationDetails){
            return Carbon::parse($userRegistrationDetails['created_at'])->format('W');
        })->keyBy(function(Collection $items, $index){
            $date = Carbon::parse($items->first()['created_at']);
            return $date->startOfWeek()->format('d-m-Y');
        });

        $statsForSteps = [];
        $groupDataIntoWeeks->each(function ($weeklyData, $key) use(&$statsForSteps){
            $statsForSteps [] = (object)['name' => $key, 'data' => $this->buildStatsForEachStep($weeklyData)];
            return $statsForSteps;
        });

        return $statsForSteps;
    }



    /**
     * This takes a collection and put determine the stats for each step
     * @param Collection $weeklyData
     * @return array
     */
    private function buildStatsForEachStep(Collection $weeklyData)
    {
        $steps = $this->onboadingRepository->getStepsPercentages();
        $stepsStats = [];
        $steps->each(function ($item, $key) use(&$weeklyData, &$stepsStats){
            $stepsStats[] = round((($weeklyData->where('onboarding_percentage', '>=', $item['percentage'])->count() / $weeklyData->count()) * 100));
        });
        return $stepsStats;
    }




}