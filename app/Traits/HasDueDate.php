<?php


namespace App\Traits;


trait HasDueDate
{
    protected function getDueDate()
    {
        $today = \Auth::user()->today();

        $dueDate = $today->setDateFrom($this->due_date)->setTime(23, 59, 59);

        return $dueDate;
    }

    public function isOverdue()
    {
        if (!$this->due_date) {
            return null;
        }

        if ($this->completed) {
            return false;
        }

        $today = \Auth::user()->today();

        $dueDate = $this->getDueDate();

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

        $dueDate = $this->getDueDate();

        return $dueDate->isSameDay($today);
    }
}
