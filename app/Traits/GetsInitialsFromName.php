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

        $allInitials = array_reduce($nameParts, function ($initials, $namePart) use ($nonInitialableParts) {
            if ($nonInitialableParts->contains($namePart) || preg_match("/^\W/", $namePart)) {

                return $initials;
            }

            return $initials . substr($namePart, 0, 1);
        }, '');

        return (strlen($allInitials) > 1) ? substr($allInitials, 0, 1) . substr($allInitials, -1) : $allInitials;
    }

    public function getInitialsAttribute()
    {
        return $this->getInitials();
    }
}
