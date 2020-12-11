<?php


namespace App\Report;


use App\Report;
use Illuminate\Support\Collection;

class CompiledReport
{
    private $report;

    private $properties = [
        'name' => '',
        'description' => '',
    ];

    /**
     * @var Collection
     */
    private $resultSets;

    public function __construct(Report $report)
    {
        $this->report = $report;

        $this->properties['name'] = $report->name;
        $this->properties['description'] = $report->description;

        $this->resultSets = collect([]);
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
        if ($this->properties[$name] ?? false) {

            return $this->properties[$name];
        }

        throw new \InvalidArgumentException("Trying to access non-existent property {$name}");
    }
}
