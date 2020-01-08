<?php


namespace App\Navigation\LocationBar\Link;


use App\Navigation\LocationBar\Link;

class Home extends Link
{
    public function __construct()
    {
        parent::__construct(route('home'), '', 'fas fa-home');
    }
}
