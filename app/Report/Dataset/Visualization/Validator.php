<?php


namespace App\Report\Dataset\Visualization;


use App\Report\Dataset;
use App\Report\Dataset\Visualization;

class Validator
{
    public function getValidValuesForVisualizationForDataset(Dataset $dataset, $request)
    {
        $visualizationType = $request->type;

        if (!$visualizationType || !Visualization::visualizationTypeOptions()->keys()->contains($visualizationType)) {

            return $this->response(false, null, null);
        }

        $fieldAccessor = '';

        switch ($visualizationType):

            case Visualization::VISUALIZATION_TYPE_TOTAL_RECORDS_COUNT:

                return $this->response(true, $visualizationType, null);

            case Visualization::VISUALIZATION_TYPE_FIELD_VALUE_AVERAGE: // Expected fall through
            case Visualization::VISUALIZATION_TYPE_FIELD_VALUE_SUM:

                $fieldAccessor = 'sum_average_field_id';
                break;

            case Visualization::VISUALIZATION_TYPE_SINGLE_FIELD_AGGREGATE:

                $fieldAccessor = 'aggregate_field_id';
                break;

            case Visualization::VISUALIZATION_TYPE_RANGE_FIELD_AVERAGE:

                $fieldAccessor = 'range_field_average_id';
                break;

            case Visualization::VISUALIZATION_TYPE_MULTI_RANGE_FIELD_AVERAGE:

                $fieldAccessor = 'multi_range_field_average_id';
                break;

            case Visualization::VISUALIZATION_TYPE_MULTI_FIELD_TREND_WITH_AVERAGE:

                $fieldAccessor = 'multi_field_trend_with_average_id';
                break;

        endswitch;

        if (!$fieldAccessor) {

            return $this->response(false, null, null);
        }

        $fieldId = $request->$fieldAccessor;

        if (!$fieldId) {

            return $this->response(false, null, null);
        }

        return $this->response(true, $visualizationType, $request->$fieldAccessor);
    }

    private function response(bool $success, $type,  $field_id = '')
    {
        return [
            'success' => $success,
            'type' => $type,
            'field_id' => $field_id,
        ];
    }
}
