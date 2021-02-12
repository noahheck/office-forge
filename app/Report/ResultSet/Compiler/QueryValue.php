<?php


namespace App\Report\ResultSet\Compiler;


use App\Report\Dataset\Filter;
use App\Report\RuntimeValues;
use Carbon\Carbon;

class QueryValue
{
    public function __construct()
    {

    }

    public function queryValueForFilter(Filter $filter, RuntimeValues $runtimeValues)
    {
        $value = '';

        // User options
        if ($filter->value_1 === Filter::FILTER_VALUE_USER_GENERATING_REPORT) {

            return $runtimeValues->generatingUser->id;
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_USER_REPORT_FILTERED_USER) {

            return optional($runtimeValues->user)->id;
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_USER_SPECIFIC_USER) {

            return $filter->value_2;
        }

        // Date options

        // Special rules because created_at is unix time, and we need to convert it to user's timezone
        if (in_array($filter->field_id, ['created_date'])) {

            $userTimezone = $runtimeValues->generatingUser->timezone;

            if ($filter->value_1 === Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {
                $dateFrom = new Carbon($filter->value_2, $userTimezone);
                $dateTo   = new Carbon($filter->value_2, $userTimezone);
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {
                $dateFrom = new Carbon($runtimeValues->date_from, $userTimezone);
                $dateTo = new Carbon($runtimeValues->date_to, $userTimezone);
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {
                $dateFrom = new Carbon($runtimeValues->date, $userTimezone);
                $dateTo = new Carbon($runtimeValues->date, $userTimezone);
            }

            $dateFrom->setTime(0, 0, 0)->setTimezone(config('app.timezone'));
            $dateTo->setTime(23, 59, 59)->setTimezone(config('app.timezone'));

            return [$dateFrom, $dateTo];
        }

        if (in_array($filter->field_id, ['date'])) {
            if ($filter->value_1 === Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {
                $dateFrom = $filter->value_2;
                $dateTo   = $filter->value_2;
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {
                $dateFrom = $runtimeValues->date_from;
                $dateTo   = $runtimeValues->date_to;
            } elseif ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {
                $dateFrom = $runtimeValues->date;
                $dateTo   = $runtimeValues->date;
            }

            return [
                date('Y-m-d', strtotime($dateFrom)),
                date('Y-m-d', strtotime($dateTo)),
            ];
        }


        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {

            if ($filter->operator === Filter::FILTER_OPERATOR_BETWEEN) {

                return [
                    date('Y-m-d', strtotime($filter->value_2)),
                    date('Y-m-d', strtotime($filter->value_3)),
                ];
            }

            return date('Y-m-d', strtotime($filter->value_2));
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {

            return  [
                date('Y-m-d', strtotime($runtimeValues->date_from)),
                date('Y-m-d', strtotime($runtimeValues->date_to)),
            ];
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {

            return date('Y-m-d', strtotime($runtimeValues->date));
        }




        switch ($filter->operator):

            case Filter::FILTER_OPERATOR_HAS_VALUE:
            case Filter::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE:
                $value = null;
                break;

            case Filter::FILTER_OPERATOR_CHECKED:
            case Filter::FILTER_OPERATOR_NOT_CHECKED:
                $value = 1;
                break;

            case Filter::FILTER_OPERATOR_EQUALS:
            case Filter::FILTER_OPERATOR_NOT_EQUALS:
            case Filter::FILTER_OPERATOR_GREATER_THAN:
            case Filter::FILTER_OPERATOR_GREATER_THAN_EQUALS:
            case Filter::FILTER_OPERATOR_LESS_THAN:
            case Filter::FILTER_OPERATOR_LESS_THAN_EQUALS:

                $value = $filter->value_1;
                break;

            case Filter::FILTER_OPERATOR_BETWEEN:
                $value = [$filter->value_1, $filter->value_2];
                break;

        endswitch;

        return $value;
    }
}
