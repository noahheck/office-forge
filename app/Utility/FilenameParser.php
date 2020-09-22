<?php


namespace App\Utility;


class FilenameParser
{
    public function parseFilenameParts($filename)
    {
        $parts = explode('.', $filename);

        $extension = array_pop($parts);

        $name = implode('.', $parts);

        if (!$name) {
            $name = $extension;
            $extension = '';
        }

        return [
            'filename' => $name,
            'extension' => $extension,
        ];
    }
}
