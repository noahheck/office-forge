<?php


namespace App\Traits;


trait HasDueDate
{
    public function isOverdue()
    {
        if (!$this->due_date) {
            return null;
        }

        $today = \Auth::user()->today();

        $dueDate = $this->due_date->setTime(23, 59, 59)->setTimezone($today->timezone);

        return $dueDate->lessThan($today);
    }

    public function isDueToday()
    {
        if (!$this->due_date) {
            return null;
        }

        $today = \Auth::user()->today();

        $dueDate = $this->due_date->setTime(23, 59, 59)->setTimezone($today->timezone);

        return $dueDate->isSameDay($today);
    }
}
