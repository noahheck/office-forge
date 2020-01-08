<?php


namespace App\Navigation;


use App\Navigation\LocationBar\Link;
use App\Navigation\LocationBar\Link\Home as HomeLink;

class LocationBar
{
    /**
     * @var string
     */
    private $currentLocation = '';

    private $links = [];

    public function __construct(string $currentLocation = '')
    {
        $this->links[] = new HomeLink();
        $this->currentLocation = $currentLocation;
    }

    public function setCurrentLocation(string $currentLocation)
    {
        $this->currentLocation = $currentLocation;

        return $this;
    }

    public function getCurrentLocation(): string
    {
        return $this->currentLocation;
    }

    public function addLink(Link $link)
    {
        $this->links[] = $link;

        return $this;
    }

    public function getPath()
    {
        $return = [];

        foreach ($this->links as $link) {
            $return[] = [
                'href' => $link->getHref(),
                'icon' => $link->getIcon(),
                'text' => $link->getText(),
            ];
        }

        return $return;
    }
}
