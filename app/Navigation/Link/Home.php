<?php


namespace App\Navigation\Link;


use App\Navigation\Link;

class Home extends Link
{
    public function __construct()
    {
        parent::__construct(route('home'), '', 'fas fa-home');
    }
}
