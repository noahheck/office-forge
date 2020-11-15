<?php


namespace App\Navigation\Link\Admin\Reports\Datasets\Fields;


use App\Navigation\Link;
use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Field;

class Show extends Link
{
    public function __construct(Report $report, Dataset $dataset, Field $field)
    {
        parent::__construct(route('admin.reports.datasets.fields.show', [$report, $dataset, $field]), $field->label);
    }
}
