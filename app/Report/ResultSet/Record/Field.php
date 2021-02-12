<?php


namespace App\Report\ResultSet\Record;


class Field
{
    public $datasetFieldId;
    public $id;
    public $value;
    public $label;

    public function __construct($datasetFieldId, $id, $value, $label)
    {
        $this->datasetFieldId = $datasetFieldId;
        $this->id = $id;
        $this->value = $value;
        $this->label = $label;
    }
}
