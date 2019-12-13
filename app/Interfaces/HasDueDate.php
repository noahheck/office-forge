<?php


namespace App\Interfaces;


interface HasDueDate
{
    public function isOverdue();

    public function isDueToday();
}
