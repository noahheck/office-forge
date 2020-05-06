<?php


namespace App\Traits\Form;


trait Field
{
    public function fieldName()
    {
        return 'field_' . $this->id;
    }

    public function selectOptions()
    {
        $select_options = optional($this->options)->select_options ?? [];

        return array_combine($select_options, $select_options);
    }

    public function decimalPlaces()
    {
        return optional($this->options)->decimal_places;
    }

    public function userTeam()
    {
        return optional($this->options)->user_team;
    }

    public function fileTypeId()
    {
        return optional($this->options)->file_type;
    }

    public function getFileTypeIdAttribute()
    {
        return $this->fileTypeId();
    }
}
