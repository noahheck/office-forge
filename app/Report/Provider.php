<?php


namespace App\Report;


use App\Report;
use App\User;

class Provider
{
    /**
     * @var Report
     */
    private $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function getReportsAccessibleByUser(User $user, $fileTypeId = null)
    {
        $reports = $this->report->ordered()->where('file_type_id', $fileTypeId)->get();

        $reports->load('teams');

        $reports = $reports->filter(function($report, $key) use ($user) {

            return $user->can('view', $report);
        });

        return $reports;
    }
}
