<?php


namespace App\Chart;


class Table
{
    private $title;

    private $headers;

    private $records;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function addRecord($record)
    {
        $this->records[] = $record;
    }

    public function getRecords()
    {
        return $this->records;
    }
}
