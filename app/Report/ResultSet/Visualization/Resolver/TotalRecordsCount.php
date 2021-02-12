<?php


namespace App\Report\ResultSet\Visualization\Resolver;


use App\Report\Dataset\Visualization;
use App\Report\ResultSet;

class TotalRecordsCount
{
    public function __construct()
    {

    }

    public function resolve(ResultSet $resultSet, Visualization $visualization)
    {
        return $resultSet->records()->count();
    }
}
