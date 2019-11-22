<?php

namespace Temper\Presenters;

use Tightenco\Collect\Support\Collection;

interface PresenterInterface
{
    /**
     * @param $data
     * @return Collection
     */
    public function transformData($data):array;

}