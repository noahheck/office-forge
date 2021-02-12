<?php


namespace App\Interfaces;


interface Datasetable
{
    public function icon(array $withClasses = []);

    public function filterableFieldOptions();

    public function reportableFieldOptions();

    public function datasetableInstances();

    public function instanceFieldValueRelationshipIdentifier();

    public function instanceFieldValueFieldIdentifier();

    public function instanceFieldRecordIdentifier();
}
