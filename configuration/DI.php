<?php

//Set DI container
use Temper\Models\OnBoardingDataInterface;
use Temper\Responses\OnboardingStatsApiResponse;
use Temper\Responses\ResponsableInterface;
use Temper\Services\CsvReaderService;
use function DI\get;

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->useAutowiring(true);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    ResponsableInterface::class => get(OnboardingStatsApiResponse::class),
    OnBoardingDataInterface::class => get(CsvReaderService::class),
]);
$this->container = $containerBuilder->build();