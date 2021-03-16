<?php


namespace App\Report;


use App\Report\ResultSet\Record;
use Illuminate\Support\Collection;

class ResultSet
{
    private $dataset;

    private $properties = [
        'dataset' => '',
        'name' => '',
    ];

    private $visualizations;

    /**
     * @var Collection
     */
    private $records;

    public function __construct(Dataset $dataset)
    {
        $this->dataset = $dataset;

        $this->properties['dataset'] = $dataset;
        $this->properties['name'] = $dataset->name;

        $this->visualizations = $dataset->visualizations;

        $this->records = collect([]);
    }

    public function visualizations()
    {
        return $this->visualizations;
    }

    public function addRecord(Record $record)
    {
        $this->records->push($record);

        return $this;
    }

    public function headers()
    {
        $headers = [
            $this->dataset->datasetable->name
        ];

        foreach ($this->dataset->fields as $field) {
            $headers[] = $field->label;
        }

        return $headers;
    }

    public function fieldDetails($fieldId)
    {
        return $this->dataset->fields->firstWhere('id', $fieldId);
    }

    public function records()
    {
        return $this->records;
    }

    public function __get($name)
    {
        if ($this->properties[$name] ?? false) {

            return $this->properties[$name];
        }

        throw new \InvalidArgumentException("Trying to access non-existent property {$name}");
    }
}
