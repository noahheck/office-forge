<?php


namespace App\Html\LocationBar;


class Link
{
    protected $href;

    protected $text;

    protected $icon;

    public function __construct($href, $text = '', $icon = '')
    {
        $this->href = $href;
        $this->text = $text;
        $this->icon = $icon;
    }

    public function getHref()
    {
        return $this->href;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getIcon()
    {
        return $this->icon;
    }
}
