<?php

namespace App\Traits;

trait GetsInitialsFromName
{
    public function getInitials()
    {
        $nonInitialableParts = collect([
            'and', 'of', 'the',
        ]);

        $nameParts = explode(' ', $this->name);

        return array_reduce($nameParts, function ($initials, $namePart) use ($nonInitialableParts) {
            if ($nonInitialableParts->contains($namePart) || preg_match("/^\W/", $namePart)) {

                return $initials;
            }

            return $initials . substr($namePart, 0, 1);
        }, '');
    }

    public function getInitialsAttribute()
    {
        return $this->getInitials();
    }
}
