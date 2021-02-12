<?php


namespace App\Report\ResultSet;


use App\File;
use App\FormDoc;
use App\Report\ResultSet\Record\Field;
use Illuminate\Support\Collection;

class Record
{
    /**
     * @var FormDoc|File - Resource this record represents
     */
    private $resource;

    /**
     * @var Collection
     */
    private $fields;

    private $properties = [
        'resource' => '',
    ];

    public function __construct($resource)
    {
        $this->resource = $resource;
        $this->properties['resource'] = $resource;

        $this->fields = collect([]);
    }

    public function addField(Field $field)
    {
        $this->fields->push($field);

        return $this;
    }

    public function fields()
    {
        return $this->fields;
    }

    public function __get($name)
    {
        if ($this->properties[$name] ?? false) {

            return $this->properties[$name];
        }

        throw new \InvalidArgumentException("Trying to access non-existent property {$name}");
    }
}
