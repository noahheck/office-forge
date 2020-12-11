<?php


namespace App\Report\ResultSet\Record;


class Field
{
    public $id;
    public $value;
    public $label;

    public function __construct($id, $value, $label)
    {
        $this->id = $id;
        $this->value = $value;
        $this->label = $label;
    }
}
