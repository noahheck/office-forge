<?php


namespace App\Interfaces;


interface Datasetable
{
    public function icon(array $withClasses = []);

    public function filterableFieldOptions();
}