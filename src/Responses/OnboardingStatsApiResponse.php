<?php


namespace Temper\Responses;


class OnboardingStatsApiResponse implements ResponsableInterface
{


    public function response($data, $responseCode = '200', $meta = null)
    {
        header('Content-type: application/json');
        http_response_code ((int)  $responseCode);
        echo json_encode( ['data' => $data, "meta" => $meta] );
    }
}