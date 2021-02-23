<?php


namespace App\Report;


use App\Report;
use function App\format_datetime;

class Descriptor
{
    public function __construct()
    {

    }

    public function headers(CompiledReport $compiledReport)
    {
        $filters = [];

        $report = $compiledReport->getReport();
        $values = $compiledReport->getRuntimeValues();

        switch ($report->filter_date):

            case Report::REPORT_FILTER_DATE_DATE:
                $filters[] = '<strong>' . __('app.date') . ':</strong> ' . e($values->date);
                break;

            case Report::REPORT_FILTER_DATE_RANGE:
                $filters[] = '<strong>' . __('app.dateRange') . ':</strong> ' . e($values->date_from) . ' - ' .
                    e($values->date_to);
                break;

        endswitch;

        if ($report->filter_user) {
            $filters[] = '<strong>' . __('app.user') . ':</strong> ' . e($values->user->name);
        }

        $filters[] = '<strong>' . __('report.generated') . ':</strong> ' . format_datetime($values->time);

        return implode('&nbsp;&nbsp;', $filters);
    }
}
