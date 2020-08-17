<?php


namespace App\Server;


class DatabaseDetails
{
    public function getDetails()
    {
        $details = [];

        $dbConfig = config('database');

        if ($config = $dbConfig['connections'][$dbConfig['default']]) {
            $details = $config;

            $details['password'] = '***';
        }

        return $details;
    }
}
