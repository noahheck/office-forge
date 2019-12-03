<?php

namespace Tests\Mocks;

use Illuminate\Contracts\Hashing\Hasher as BaseHasher;

class Hasher implements BaseHasher
{
    private $providedString;

    public function make($string, $options = [])
    {
        $this->providedString = $string;

        return str_rot13($string);
    }

    public function getProvidedString()
    {
        return $this->providedString;
    }

    public function needsRehash($hashedValue, $options = [])
    {

    }

    public function check($value, $hashedValue, $options = [])
    {

    }

    public function info($hashedValue)
    {

    }
}
