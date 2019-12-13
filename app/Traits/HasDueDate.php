<?php


namespace App\Traits;


trait HasDueDate
{
    public function isOverdue()
    {
        if (!$this->due_date) {
            return null;
        }

        if ($this->completed) {
            return false;
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

        if ($this->completed) {
            return false;
        }

        $today = \Auth::user()->today();

        $dueDate = $this->due_date->setTime(12, 00, 00)->setTimezone($today->timezone)->setTime(23, 59, 59);

        \Debugbar::info($today);
        \Debugbar::info($dueDate);

        return $dueDate->isSameDay($today);
    }
}
