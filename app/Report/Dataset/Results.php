<?php


namespace App\Report\Dataset;


use App\Report\Dataset;

class Results
{
    private $dataset;
    private $headers = false;
    private $records = false;

    public function setDataset(Dataset $dataset)
    {
        $this->dataset = $dataset;
    }

    public function headers()
    {
        if ($this->headers) {

            return $this->headers;
        }

        $headers = [
            $this->dataset->datasetable->name
        ];

        foreach ($this->dataset->fields as $field) {
            $headers[] = $field->label;
        }

        $this->headers = $headers;

        return $this->headers;
    }

    public function records()
    {
        if ($this->records) {

            return $this->records;
        }

        $records = [];

        $query = $this->dataset->datasetable->instances();

        \Debugbar::info($query);

        $this->records = $records;

        return $this->records;
    }
}
