<?php

namespace Temper\Repositories;

use League\Csv\Exception as CSVException;
use League\Csv\Reader;
use Tightenco\Collect\Support\Collection;

class OnboardingRepository implements RepositoryInterface
{

    public function getAllRecords()
    {
        $data = $this->readCSVFile();
        $organisedData = $this->organisedData($data);

        return $organisedData;
    }


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



    /**
     * The steps and their percentages.
     * This could be reading from a database, to make it easy to add more steps or change the flow points
     * @return Collection
     */
    public function getStepsPercentages()
    {
        return collect([
            ['name' => 'Create account', 'step' => 0, 'percentage' => 0],
            ['name' => 'Activate account ', 'step' => 1, 'percentage' => 20],
            ['name' => 'Provide profile Information', 'step' => 2, 'percentage' => 40],
            ['name' => 'Jobs Interested In', 'step' => 3, 'percentage' => 50],
            ['name' => 'Relevant Experience', 'step' => 4, 'percentage' => 70],
            ['name' => 'Are you a Freelancer', 'step' => 5, 'percentage' => 90],
            ['name' => 'Waiting for Approval', 'step' => 6, 'percentage' => 99],
            ['name' => 'Approval', 'step' => 7, 'percentage' => 100],
        ]);
    }


}