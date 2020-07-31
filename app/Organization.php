<?php


namespace App;


class Organization
{
    const NAME_OPTION = 'organization.name';
    const PHONE_OPTION = 'organization.phone';

    public $id = 1;

    private $name;
    private $phone;

    private $options;
    private $initialized = false;

    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    public function __get($name)
    {
        $this->init();

        if (!property_exists($this, $name)) {

            throw new \InvalidArgumentException("Non-existent Organization property: {$name}");
        }

        return $this->$name;
    }

    private function init()
    {
        if ($this->initialized) {

            return;
        }

        $this->name = $this->options->get(self::NAME_OPTION);
        $this->phone = $this->options->get(self::PHONE_OPTION);
    }
}
