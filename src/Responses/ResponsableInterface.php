<?php
namespace Temper\Responses;

interface ResponsableInterface
{
    public function response($data, $responseCode, $meta);
}