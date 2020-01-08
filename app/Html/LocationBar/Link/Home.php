<?php


namespace App\Html\LocationBar\Link;


use App\Html\LocationBar\Link;

class Home extends Link
{
    public function __construct()
    {
        parent::__construct(route('home'), '', 'fas fa-home');
    }
}
