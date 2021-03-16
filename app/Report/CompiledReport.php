<?php


namespace App\Report;


use App\Report;
use Illuminate\Support\Collection;

class CompiledReport
{
    private $report;

    private $runtimeValues;

    private $properties = [
        'name' => '',
        'description' => '',
        'title' => '',
    ];

    /**
     * @var Collection
     */
    private $resultSets;

    public function __construct(Report $report, RuntimeValues $runtimeValues)
    {
        $this->report = $report;
        $this->runtimeValues = $runtimeValues;

        $title = $report->name;
        if ($runtimeValues->file) {
            $title .= ' - ' . $runtimeValues->file->name;
        }

        $this->properties['name'] = $report->name;
        $this->properties['description'] = $report->description;
        $this->properties['title'] = $title;

        $this->resultSets = collect([]);
    }

    public function getReport(): Report
    {
        return $this->report;
    }

    public function getRuntimeValues(): RuntimeValues
    {
        return $this->runtimeValues;
    }

    public function addResultSet(ResultSet $resultSet)
    {
        $this->resultSets->push($resultSet);

        return $this;
    }

    public function resultSets()
    {
        return $this->resultSets;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {

            return $this->properties[$name];
        }

        throw new \InvalidArgumentException("Trying to access non-existent property {$name}");
    }
}
