<?php


namespace Temper\Controllers;


use Carbon\Carbon;
use Exception;
use League\Csv\Exception as CSVException;
use League\Csv\Reader;
use League\Csv\Statement;
use Tightenco\Collect\Support\Collection;

class StatisticsController
{

    public function getData()
    {
        $data = $this->readCSVFile();
        $transformData = $this->transformData($data);
        $chatData = $this->buildDataForChart($transformData);
        return $this->apiResponse($chatData);
    }



    public function buildDataForChart(Collection $data)
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
            return $statsForSteps [$key] = $this->buildStatsForEachStep($weeklyData);
        });

        return $statsForSteps;
    }


    /**
     * This takes a collection and put determine the stats for each step
     * @param Collection $weeklyData
     * @return array
     */
    public function buildStatsForEachStep(Collection $weeklyData)
    {
        $steps = $this->stepsPercentages();
        $stepsStats = [];

        $steps->each(function ($item, $key) use(&$weeklyData, &$stepsStats){
            $stepsStats[$item['step']] = $weeklyData->where('onboarding_percentage', '>=', $item['percentage'])->count();
        });

        return $stepsStats;
    }


    /**
     * The steps and their percentages.
     * This could be reading from a database, to make it easy to add more steps or change the flow points
     * @return Collection
     */
    public function stepsPercentages()
    {
        return collect([
                ['name' => 'Create account', 'step' => 1, 'percentage' => 0],
                ['name' => 'Activate account ', 'step' => 2, 'percentage' => 20],
                ['name' => 'Provide profile Information', 'step' => 3, 'percentage' => 40],
                ['name' => 'Jobs Interested In', 'step' => 4, 'percentage' => 50],
                ['name' => 'Relevant Experience', 'step' => 5, 'percentage' => 70],
                ['name' => 'Are you a Freelancer', 'step' => 6, 'percentage' => 90],
                ['name' => 'Waiting for Approval', 'step' => 7, 'percentage' => 99],
                ['name' => 'Approval', 'step' => 8, 'percentage' => 100],
            ]);
    }

    /**
     * @param $data
     * @return Collection
     */
    public function transformData($data){

        $organisedData = [];

        foreach ($data as $offset => $record) {
            $organisedData[] = $record;
        }

        return collect($organisedData);
    }



    public function readCSVFile(){
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        try {
            $reader = Reader::createFromPath( __DIR__ . '/../../files/export.csv', 'r');
            $reader->setDelimiter(';');
            $reader->setHeaderOffset(0);
            $records = $reader->getRecords();
            return $records;
        } catch (CSVException $e) {
            echo $e->getMessage(), PHP_EOL;
        }

    }



    public function apiResponse($data, $response_code = 200)
    {
        header('Content-type: application/json');
        http_response_code ((int)  $response_code );
        echo json_encode( ['data' => $data] );
    }

}