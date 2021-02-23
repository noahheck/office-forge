<?php


namespace App\Utility;


class Counter
{
    private $count;

    public function __construct()
    {
        $this->count = 0;
    }

    public function add($number = 1)
    {
        $this->count += $number;

        return $this;
    }

    public function sub($number = 1)
    {
        $this->count -= $number;

        return $this;
    }

    public function isEven()
    {
        return ($this->count % 2) === 0;
    }

    public function isOdd()
    {
        return ($this->count % 2) === 1;
    }

    public function count()
    {
        return $this->count;
    }
}
