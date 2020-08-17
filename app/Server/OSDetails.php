<?php


namespace App\Server;


class OSDetails
{
    public function __construct()
    {

    }

    public function getDetails()
    {
        $details = [];

        $lines = file("/etc/os-release");

        foreach ($lines as $line) {
            list($name, $value) = explode("=", $line);

            $details[$name] = trim($value, "'\"\n");
        }

        return $details;
    }
}
